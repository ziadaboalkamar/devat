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
                    $url = asset('assets/' . $data->logo);
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
        ]);

        $data = [];
        $data['name'] = $request->name;
        $img_path = null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $img = $request->file('logo');
            $img_path = $img->store('/MainBranches', 'assets');
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
        $request->validate([
            'name' => 'required|string',
            'logo' => 'required|mimes:jpg,jpeg,png|max:2000',

        ]);

        $data = [];
        $data['name'] = $request->name;
        $img_path = null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $imag = $request->file('logo');
            if ($main_branch->logo && Storage::disk('assets')->exists($main_branch->logo)) {
                $img_path = $imag->storeAs('/MainBranches', basename($main_branch->logo), 'assets');
            } else {
                $img_path = $imag->store('/MainBranches', 'assets');
            }
            $data['logo'] = strip_tags($img_path,'<img>');
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
        if (count($main_branch->project)>0){
            toastr()->error(__('لا يمكن حذف جمعية الرئيسية'));

            return redirect()->route('main-branches.index');
        }
        $main_branch->delete();
        toastr()->success(__('تم حذف البيانات بنجاح'));

        return redirect()->route('main-branches.index');
    }
}
