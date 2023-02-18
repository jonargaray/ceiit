<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use App\Models\ProgLanguage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $branchCategoryClass = new BranchCategory; 
        $branchClass = new Branch;

        $branchCode = $request->branch_code ? $request->branch_code : Auth::user()->branch_code;
        $request->branch_code = $branchCode;

        return view('business-owner.category.index', [
            'request' => $request,
            'branches' => $branchClass->filterBySubscriber(),
            'categories' => $branchCategoryClass->PAGINATE_filterByBranch($branchCode, $request),
        ]);}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchClass = new Branch;
        $branchCategoryClass = new BranchCategory;
        
        $branch = $branchClass->findById(Auth::user()->branch_id);
        
        return view('business-owner.category.create',[
            'categories' => $branchCategoryClass->whereNotInBranch(Auth::user()->branch_id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        $categoryId = null;
        $branchClass = new Branch;
        $branchTableClass = new BranchTable;
        $branch = $branchClass->findById(Auth::user()->branch_id);

        $color = substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        
        if ($request->validated()) {

            DB::beginTransaction();

            try{

                $category = $category = Category::firstOrCreate([
                    'category' => ucwords(strtolower($request->input('new_category'))),
                    'branch_code' => Auth::user()->branch_code,
                    'subscriber_id' => $branch->subscriber_id   
                ], [
                    'description' => ucwords(strtolower($request->input('description'))),
                    'color' => '#'. $color,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                    'subscriber_code' => Auth::user()->subscriber_code,
                    'branch_code' => Auth::user()->branch_code,
                ]);

                if (!$category->wasRecentlyCreated) {
                    return redirect()->back()->withInput()->with(['warning' => 'Already exist.']);
                }
                
                $categoryId = $category->id;

                $branchCategory = BranchCategory::create([
                    'category_id' => $categoryId, 
                    'branch_id' => Auth::user()->branch_id,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                    'subscriber_code' => Auth::user()->subscriber_code,
                    'branch_code' => Auth::user()->branch_code,
                ]);
                 
                DB::commit();
                return redirect()->route('business-owner.categories.index')->with(['success' => 'Successfully Added.']);
            
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('business-owner.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $branchClass = new Branch;   
        $branchCategoryClass = new Category;
        $branchTableClass = new BranchTable;
        $subscriberId = $branchClass->subscriberId(Auth::user()->branch_id);   

        if ($request->validated()) {

            DB::beginTransaction();

            try{

                if ($branchCategoryClass->isExistOnUpdate($request, $category->id, $subscriberId)) {
                    return redirect()->back()->withInput()->with(['warning' => 'Already exist, please try again.']);
                }

                $category->update([
                    'category' => ucwords(strtolower($request->input('category'))),
                    'subscriber_id' => $subscriberId,
                    'description' => ucwords(strtolower($request->input('description'))),
                    'color' => $request->input('color'),
                    'updated_by' => Auth::user()->id,
                    'exported' => 0,
                ]);

                $branchTableClass->addToQueue(['categories']);

                DB::commit();
                return redirect()->route('business-owner.categories.index')->with(['success' => 'Successfully updated.']);
            
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
   public function destroy(Category $category)
    {
        $branchTableClass = new BranchTable;
        DB::beginTransaction();
        try{
            
            $category->delete();
            $category->update(['exported'=> 0]);
            $branchTableClass->addToQueue(['categories']);
            
            DB::commit();
            return redirect()->route('business-owner.categories.index')->with(['success' => 'Successfully deleted.']);
        
        }catch(\Exception $e){

            DB::rollBack();
            return '500 Internal Server Error';
            return $e;
        }

    }


    public function AJAX_delete(Category $category)
    {

        return view('business-owner.ajax.category.delete', [
            'category' => $category
        ]);

    }

    public function AJAX_createRestore(Category $category)
    {

        return view('business-owner.ajax.category.create-restore', [
            'category' => $category
        ]);

    }

    public function restore(Category $category)
    {
        $branchTableClass = new BranchTable;
        DB::beginTransaction();
        try{
            
            $category->restore();
            $category->update(['exported'=> 0]);
            $branchTableClass->addToQueue(['categories']);
            
            DB::commit();
            return redirect()->route('business-owner.categories.index')->with(['success' => 'Successfully restored.']);
        
        }catch(\Exception $e){

            DB::rollBack();
            return '500 Internal Server Error';
            return $e;
        }

    }


    public function AJAX_createExisting(Category $category)
    {
        $categoryClass = new Category;

        return view('business-owner.ajax.category.create-existing',[
            'category' => $categoryClass->findById($category->id),
        ]);
    }


    public function AJAX_createNew(Category $category)
    {
        $categoryClass = new Category;

        return view('business-owner.ajax.category.create-new');
    }


}
