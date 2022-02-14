<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Vawtcher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VawtcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $vawtcher = Vawtcher::all();

            return DataTables::of($vawtcher)
                ->addIndexColumn()
                ->editColumn('created_at', function (Vawtcher $vawtcher) {
                    return $vawtcher->created_at->format('Y-m-d');
                })

                // ->editColumn('user_name', function (Vawtcher $vawtcher) {
                //     return $vawtcher->user->name;
                // })

                // ->editColumn('project_name', function (Vawtcher $vawtcher) {
                //     return $vawtcher->project->company_name;
                // })
                ->rawColumns(['record_select', 'actions'])
                ->make(true);
        }
        
        return view('dashboard.pages.vawtchers.index',[
            'vawtchers' => Vawtcher::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.vawtchers.create',[
            'users' => User::get(),
            'projects' => Project::get(),
        ]);
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
            'user_id' => 'nullable',
            'project_id' => 'nullable',
            'ammount' => 'required|numeric',
            'text' => 'required',
            'note' => 'required',
        ]);
        $data = [];
        $data['user_id'] = $request->user_id;
        $data['project_id'] = $request->project_id;
        $data['ammount'] = $request->ammount;
        $data['text'] = $request->text;
        $data['note'] = $request->note;
            
        Vawtcher::create($data);
        toastr()->success(__('تم حفظ البيانات بنجاح'));

        return redirect()->route('vawtchers.index') ;
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
    public function edit(Vawtcher $vawtcher)
    {
        return view('dashboard.pages.vawtchers.edit',[
            'users' => User::get(),
            'projects' => Project::get(),
            'vawtcher' => $vawtcher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vawtcher $vawtcher)
    {
        $request->validate([
            'user_id' => 'nullable',
            'project_id' => 'nullable',
            'ammount' => 'required|numeric',
            'text' => 'required',
            'note' => 'required',
        ]);
        $data = [];
        $data['user_id'] = $request->user_id;
        $data['project_id'] = $request->project_id;
        $data['ammount'] = $request->ammount;
        $data['text'] = $request->text;
        $data['note'] = $request->note;
            
        $vawtcher->update($data);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('vawtchers.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vawtcher $vawtcher)
    {
        $vawtcher->delete();
        toastr()->success(__('تم حذف البيانات بنجاح'));

        return redirect()->route('vawtchers.index') ;  
    }
}
