<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Unit;
use App\Models\Branch;
use App\Models\Subscriber;
use App\Models\BranchTable;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $unitClass = new Unit;
       $branchClass = new Branch; 

       $branchCode = $request->branch_code ? $request->branch_code : Auth::user()->branch_code;
       $request->branch_code = $branchCode;

        return view('business-owner.unit.index', [
            'request' => $request,
            'branches' => $branchClass->filterBySubscriber(),
            'units' => $unitClass->PAGINATE_filterByBranch($branchCode, $request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('business-owner.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitRequest $request)
    {
         $branchTableClass = new BranchTable;

         if ($request->validated()) {

            DB::beginTransaction();

            try{

                $branchClass = new Branch;
                $branch = $branchClass ->findById(Auth::user()->branch_id);

                $unit = Unit::firstOrCreate([
                    'unit' => ucwords(strtolower($request->input('unit'))),
                    'branch_code' => Auth::user()->branch_code,
                    'subscriber_id' => $branch->subscriber_id,
                    'symbol' => $request->input('symbol') ? $request->input('symbol') : $request->input('unit'),
                ], [
                    'subscriber_id'=> $branch->subscriber_id,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                    'subscriber_code' => Auth::user()->subscriber_code,
                ]);

                $branchTableClass->addToQueue(['units']);

                if (!$unit->wasRecentlyCreated) {
                    return redirect()->back()->withInput()->with(['warning' => 'Already exist.']);
                }

                DB::commit();

                return redirect()->route('business-owner.units.index')->with(['success' => 'Successfully Added.']);
            
            }catch(\Exception $e){

                DB::rollBack();
                return '500 Internal Server Error';
                return $e;
            
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
       return view('business-owner.unit.edit', [
            'unit' => $unit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unitClass = new Unit;
        $branchTableClass = new BranchTable;   
        $branchClass = new Branch;   
        $subscriberId = $branchClass->subscriberId(Auth::user()->branch_id);

        if ($request->validated()) {

            DB::beginTransaction();

            try{
                
                if ($unitClass->isExistOnUpdate($request, $unit->id, $subscriberId)) {
                    return redirect()->back()->withInput()->with(['warning' => 'Already exist, please try again.']);
                }

                $unit->update([
                    'unit' => ucwords(strtolower($request->input('unit'))),
                    'symbol' => $request->input('symbol'),
                    'updated_by' => Auth::user()->id,
                    'exported' => 0,
                ]);

                $branchTableClass->addToQueue(['units']);

                DB::commit();

                return redirect()->route('business-owner.units.index')->with(['success' => 'Successfully updated.']);
            
            }catch(\Exception $e){

                DB::rollBack();
                return '500 Internal Server Error';
                return $e;
            
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $branchTableClass = new BranchTable;
        try{
                
            $unit->delete();
            $branchTableClass->addToQueue(['units']);
            
            DB::commit();
            return redirect()->route('business-owner.units.index')->with(['success' => 'Successfully deleted.']);
        
        }catch(\Exception $e){

            DB::rollBack();
            return '500 Internal Server Error';
            return $e;
        }

    }

    public function AJAX_delete(Unit $unit)
    {

        return view('business-owner.ajax.unit.delete', [
            'unit' => $unit
        ]);

    }

    public function AJAX_createRestore(Unit $unit)
    {

        return view('business-owner.ajax.unit.create-restore', [
            'unit' => $unit
        ]);

    }

    public function restore(Unit $unit)
    {
        $branchTableClass = new BranchTable;
        try{
                
            $unit->restore();
            $branchTableClass->addToQueue(['units']);
            
            DB::commit();
            return redirect()->route('business-owner.units.index')->with(['success' => 'Successfully restored.']);
        
        }catch(\Exception $e){

            DB::rollBack();
            return '500 Internal Server Error';
            return $e;
        }

    }
}
