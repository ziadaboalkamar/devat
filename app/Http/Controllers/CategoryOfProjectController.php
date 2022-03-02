<?php

namespace App\Http\Controllers;

use App\Models\CategoriesOfProject;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryOfProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $categoriesOfProject = CategoriesOfProject::all();

            return DataTables::of($categoriesOfProject)
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.pages.category_of_projects.index',[
            'categoriesOfProjects' => CategoriesOfProject::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.category_of_projects.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ],[
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $data = [];
        $data['name'] = $request->name;
        CategoriesOfProject::create($data);
        toastr()->success(__('تم حفظ البيانات بنجاح'));
        return redirect()->route('category-of-projects.index') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriesOfProject $category_of_project)
    {
        return view('dashboard.pages.category_of_projects.edit',[
            'category_of_project' => $category_of_project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriesOfProject $category_of_project)
    {
        $request->validate([
            'name' => 'required|string',
        ],[
            'name.required' => 'هذا الحقل مطلوب',
        ]);

        $data = [];
        $data['name'] = $request->name;
        $category_of_project->update($data);
        toastr()->success(__('تم تعديل البيانات بنجاح'));
        return redirect()->route('category-of-projects.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriesOfProject $category_of_project)
    {
        if(count($category_of_project->projects) > 0){
            toastr()->error(__('لايمكنك حذف هذا القسم'));
            return redirect()->route('category-of-projects.index') ;
        }else{
            $category_of_project->delete();
        toastr()->success(__('تم حذف البيانات بنجاح'));

        return redirect()->route('category-of-projects.index') ;
        }

    }
}
