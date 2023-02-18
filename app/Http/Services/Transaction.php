<?php

namespace App\Http\Services;

use DB;
use Auth;
use Schema;
use Cache;  
use Storage;
use Session;
use Carbon\Carbon;
use App\Models\BranchTable;
use App\Models\PosHistory;
use App\Http\Services\CustomFunction;

class Transaction
{   

    public function __construct()
    {
        

    }

    public static function newSession()
    {
         // if (!session()->get('pos_history')) {

            $posHistoryClass = new PosHistory;
            
            PosHistory::firstOrCreate([
                'session_date' => date('Y-m-d'),
                'branch_code' => Auth::user()->branch_code,
                'subscriber_code' => Auth::user()->subscriber_code
            ], [
                'user_id' => Auth::user()->id, 
                'pos' => 'Locked',  
            ]);

            $posHistory = $posHistoryClass->findByDate(date('Y-m-d'), Auth::user()->branch_code);
            session(['pos_history' => $posHistory]);

        // }
    }

}
