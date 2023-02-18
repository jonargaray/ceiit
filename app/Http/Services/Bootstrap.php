<?php

namespace App\Http\Services;

use Mail;
use DB;
use Auth;
use Schema;
use Cache;  
use Storage;
use Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Table;
use App\Models\Branch;
use App\Models\Subscriber;
use App\Models\Category;
use App\Models\BranchCategory;
use App\Models\Activation;
use App\Models\BranchTable;
use App\Http\Services\CustomFunction;

class Bootstrap
{   

    public static $subscriberCode;
    public static $branchCode;
    public static $subscriberId;
    public static $branchId;

    public function __construct($data = [])
    {
        Self::$subscriberCode = $data->subscriberCode;
        Self::$branchCode = $data->branchCode;
        Self::$subscriberId = $data->subscriberId;
        Self::$branchId = $data->branchId;

        Self::defaultData();

    }

    public static function defaultData()
    {
        DB::beginTransaction();
        try{

            // Self::tables();
            Self::branchTables();
            Self::units();
            Self::category();
            Self::activations();
            Self::defaultMenus();
        
            DB::commit();


        }catch(\Exception $e){
            DB::rollBack();
            return $e;
        }
    }

    public static function tables()
    {
        DB::table('tables')->insert(Self::tablesArray());        
    }

    
    public static function units()
    {
        $customFunctionClass = new CustomFunction;
        $branchTableClass = new BranchTable;

        foreach ($customFunctionClass->units() as $defaultUnit) {
            $unitsArray[] = [
                'common' => 1,
                'unit' => $defaultUnit->unit,
                'symbol' => $defaultUnit->symbol,
                'subscriber_id' => Self::$subscriberId,
                'subscriber_code' => Self::$subscriberCode,
                'branch_code' => Self::$branchCode,
            ];
        }

        DB::table('units')->insert($unitsArray);
    }

    public static function tablesArray()
    {
        $customFunctionClass = new CustomFunction;
        $tables = array();

        foreach ($customFunctionClass->tables() as $table) {
            $tables[] = [
                'table_name' => $table
            ];
        }

        return $tables;
    }

    public static function branchTables()
    {
        $tables = DB::table('tables')->get();

        foreach ($tables as $table) {
            $tablesArray[] = [
                'table_id' => $table->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'subscriber_code' => Self::$subscriberCode,
                'branch_code' => Self::$branchCode,
            ];
        }

        DB::table('branch_tables')->insert($tablesArray);
    }  


    public static function category()
    {
        $category = Category::create([
            'category' => 'Others',
            'description' => 'Materials',
            'color' => '#67636a',
            'subscriber_id' => Self::$subscriberId,
            'subscriber_code' => Self::$subscriberCode,
            'branch_code' => Self::$branchCode,
        ]);

        $branchCategory = BranchCategory::create([
            'category_id' => $category->id, 
            'branch_id' => Self::$branchId,
            'subscriber_code' => Self::$subscriberCode,
            'branch_code' => Self::$branchCode,
        ]);
    }

    public static function defaultMenus()
    {

        $customFunctionClass = new CustomFunction;
        $userTypes = $customFunctionClass->userTypes();
        $menus = $customFunctionClass->arrayToString($customFunctionClass->menus()); 
        $data = [];

        foreach ($userTypes as $userType) {
            $data[] = [
                'user_type' => $userType,
                'menus' => $menus,
                'subscriber_code' => Self::$subscriberCode,
                'branch_code' => Self::$branchCode,
            ];
        }

        DB::table('default_menus')->insert($data);

    }

    public static function activations()
    {
        $MAC =  exec('getmac');
        $MAC = strtok($MAC, ' ');
    
        $array = [];

        for ($i=1; $i<=10; $i++) {
            $array[] = [
                'code' => Str::random(10),
                'mac_address' => $MAC,
                'subscriber_code' => Self::$subscriberCode,
            ];
        }

        if (DB::table('activations')->insert($array)) {
            $activations = (new Activation)->getAll(Self::$subscriberCode);
        }

        // Send email
        $email = 'sicsDOST2022@gmail.com';
        $full_name = 'Subscriber';

        $connected = @fsockopen("www.google.com", 80); 

        if ($connected){

            $sent_email = Mail::send('mail-template.code-notification', [
                'emaildata' => ['codes' =>  $activations ]
              ], function($message) use ($email, $full_name){
                  $message->to($email, $full_name)->subject('--');
              });
              
            fclose($connected);
        }

        

        return true;
    }

}

