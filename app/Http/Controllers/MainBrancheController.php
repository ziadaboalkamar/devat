<?php

namespace App\Http\Controllers;

use App\Models\MainBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class MainBrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $mainBranche = MainBranche::all();

            return DataTables::of($mainBranche)
                ->addIndexColumn()
                ->editColumn('created_at', function (MainBranche $mainBranche) {
                    return $mainBranche->created_at->format('Y-m-d');
                })
                ->editColumn('logo', function ($data) {
                    $url = asset('storage/' . $data->logo);
                    return '<img src="' . $url . '" border="0" width="80" class="img-rounded" align="center" />';
                })
                ->rawColumns(['logo', 'actions'])
                ->make(true);
        }

        return view('dashboard.pages.main_branches.index', [
            'mainBranches' => MainBranche::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.main_branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string',
            'logo' => 'required|mimes:jpg,jpeg,png|max:2000',
        ],[
            'name.required' => 'هذا الحقل مطلوب',
            'name.string' => 'يجب ان يكون الحق نصي',
            'logo.required' => 'هذا الحقل مطلوب',
            'logo.mimes' => 'يجب ان تكون صيغة الملف jpg,jpeg,png ',
        ]);

        $data = [];
        $data['name'] = $request->name;
        $img_path = null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $img = $request->file('logo');
            $img_path = $img->store('MainBranches', 'public');
        }

        $data['logo'] = strip_tags($img_path,'<img>');
        MainBranche::create($data);
        toastr()->success(__('تم حفظ البيانات بنجاح'));

        return redirect()->route('main-branches.index');
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
    public function edit(MainBranche $main_branch)
    {
        return view('dashboard.pages.main_branches.edit', [
            'main_branch' => $main_branch,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainBranche $main_branch)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string',
            'logo' => 'sometimes|mimes:jpg,jpeg,png|max:2000',
        ],[
            'name.required' => 'هذا الحقل مطلوب',
            'name.string' => 'يجب ان يكون الحق نصي',
            'logo.required' => 'هذا الحقل مطلوب',
            'logo.mimes' => 'يجب ان تكون صيغة الملف jpg,jpeg,png ',
        ]);

        $data = [];
        $data['name'] = $request->name;
        
         $img_path = $main_branch->logo ?? null;
            
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                unlink('storage/' . $img_path);
                $imag = $request->file('logo');
               
                $img_path = $imag->store('MainBranches','public');
                
                $data['logo'] = $img_path;
            }
        

        $main_branch->update($data);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('main-branches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainBranche $main_branch)
    {

        if (File::exists('assets/' . $main_branch->logo)) {
            unlink('assets/' . $main_branch->logo);
        }

        if(count($main_branch->projects) > 0){
            toastr()->error(__('لايمكنك حذف هذه الجمعية'));
            return redirect()->route('main-branches.index') ;
        }else{
            $main_branch->delete();
            toastr()->success(__('تم حذف البيانات بنجاح'));

            return redirect()->route('main-branches.index');
        }



    }
}