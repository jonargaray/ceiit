<?php

namespace App\Http\Services;

use DB;
use Auth;
use Schema;
use Cache;  
use Storage;
use Session;
use Carbon\Carbon;
use App\Models\SyncHistory;
use App\Models\BranchTable;

class DataSync
{   

    private $connected;
    private $cacheLife = 36000;
    private static $totalCacheSize = 0;

    public function __construct()
    {
        $this->testConnection();
    }

    public function testConnection()
    {
        $connection = @fsockopen("www.google.com", 80); 

        if ($connection){

            $this->connected = true;
            fclose($connection);

        }else{

            $this->connected = false;
        }
    }

    public static function realtimeSync($tables = array())
    {

        DB::beginTransaction();
        try{

            if ((new self)->connected) {
                
                foreach ($tables as $tableName=>$data) 
                { 
                    $arrayData = (new self)->singleTableToArray($tableName, $data);  
                    DB::connection('mysql_online')->table($tableName)->insert($arrayData);

                    DB::table($tableName)
                        ->where('id', $data->id)
                        ->update([
                            'exported' => 1
                    ]);
                }
            } 

            DB::commit();

        }catch(\Exception $e){

            DB::rollBack();
            return $e;
        }
    }

  public static function cache()
    {

        try{

            if ((new self)->connected) {
                (new self)->saveToCache();
            } 

            return Self::$totalCacheSize;

        }catch(\Exception $e){

            return $e;
        }
    }  

    public static function sync()
    {
        DB::connection('mysql_online')->beginTransaction();
        try{

            if ((new self)->connected) {
                (new self)->uploadDataOnline();
            } 

            DB::connection('mysql_online')->commit();
            return true;

        }catch(\Exception $e){

            DB::connection('mysql_online')->rollBack();
            return $e;
        }
    }

    public static function verify()
    {
        DB::beginTransaction();
        try{

            (new self)->updateLocal();

            DB::commit();
            return true;

        }catch(\Exception $e){

            DB::rollBack();
            return $e;
        }
    }

    public function saveToCache()
    {
        $branchTableClass = new BranchTable;
        $branchCode = Auth::user()->branch_code;
        $subscriberCode = Auth::user()->subscriber_code;
        $exceptions = ['tables', 'audits', 'branch_tables'];

        $tables = $branchTableClass->filterByBranch($branchCode, 'Queue');
        $exportedData = [];

        Cache::forget('tables');
        Cache::remember('tables', $this->cacheLife, function() use ($tables) { return $tables; });

        foreach ($tables as $table)
        {
            if (!in_array($table->table_name, $exceptions)) {

                $data = DB::table($table->table_name)->where('exported', 0)->get();
                Cache::forget($table->table_name);
                if (count($data) > 0) {
                    Self::$totalCacheSize = Self::$totalCacheSize + round((mb_strlen(serialize((array) $data), '8bit')/1024), 2);
                    Cache::remember($table->table_name, $this->cacheLife, function() use ($data) { return $data; });
                }
            }
        }
    }

    public function uploadDataOnline()
    {   
        $branchTableClass = new BranchTable;
        $exceptions = ['tables', 'audits', 'branch_tables'];
        $exportedTables = [];

        $tables = Cache::get('tables');

        foreach ($tables as $table)
        {
            if (!in_array($table->table_name, $exceptions)) {

                if (Cache::get($table->table_name)) {
                    $this->importToOnlineDatabase($table->table_name);
                }
            }
        }
    }

    public function importToOnlineDatabase($tableName)
    {
        $finalData = $this->cacheToArray($tableName);  

        if ($this->deleteExistingData($tableName, $finalData->toOveride, Auth::user()->branch_code)) {
            
            if (DB::connection('mysql_online')->table($tableName)->insert($finalData->collected)) {
                Cache::forget($tableName);

                $this->importReferencesSaveToCache($tableName, $finalData->toOveride);

                return true;
            }

        }
    }

    public function updateLocal()
    {
        $tables = Cache::get('tables');

        foreach ($tables as $table) {
            
            if ($reference = Cache::get('import_reference_'. $table->table_name)) {
                
                DB::table($table->table_name)
                    ->whereIn('id', $reference->importedIds)
                    ->update([
                        'exported' => 1
                    ]);
            }
        }
    }


    public function importReferencesSaveToCache($tableName, $importedIds)
    {
        $reference = (object) [
            'tableName' => $tableName,
            'importedIds' => $importedIds,
        ];

        Cache::forget('import_reference_'.$tableName);
        Cache::remember('import_reference_'.$tableName, $this->cacheLife, function() use ($reference) { return $reference; });

    }

    public function deleteExistingData($tableName, $toOveride, $branchCode)
    {      
        $tableName == 'subscribers' || $tableName == 'subscriptions' || $tableName == 'subscription_payments' 
                ? DB::connection('mysql_online')->table($tableName)->whereIn('id', $toOveride)->delete()
                : DB::connection('mysql_online')->table($tableName)->whereIn('id', $toOveride)->where('branch_code', $branchCode)->delete();

        return true;
    }

    public function cacheToArray($tableName)
    {
        $cache = Cache::get($tableName);
        $fields = Schema::getColumnListing($tableName);
        $rowData = [];
        $collected = [];
        $toOveride = [];

        foreach ($cache as $data) {
            
            foreach ($fields as $field) {

                if ($field == 'id') {
                    $toOveride[] =  $data->$field;
                }

                if ($field != 'exported') {
                   $rowData = array_merge($rowData, [$field => $data->$field]);
                }
            }

            $collected[] = $rowData;
        }

        return (object) [
            'collected' => $collected,
            'toOveride' => $toOveride,
        ];
    }

    public function singleTableToArray($tableName, $data, $exceptions=[])
    {
        $fields = Schema::getColumnListing($tableName);
        $rowData = [];

        foreach ($fields as $field) {

            if ($field == 'id') {
                $toOveride[] =  $data->$field;
            }

            if ($field != 'exported' && !in_array($field, $exceptions) ) {
               $rowData = array_merge($rowData, [$field => $data->$field]);
            }

        }
        
        return $rowData;
    }


    public static function storeHistory()
    {
        $data = [[
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'branch_code' => Auth::user()->branch_code,
            'subscriber_code' => Auth::user()->subscriber_code,
        ]];

        DB::table('sync_histories')->insert($data);
        DB::connection('mysql_online')->table('sync_histories')->insert($data);
    } 

}
