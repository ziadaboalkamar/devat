<?php

namespace App\Http\Controllers;

use App\Models\ProjectBranchCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProjectManagmentController extends Controller
{

    public function index(Request $request){
        $user = Auth::user()->branch_id	;

        $branch = ProjectBranchCount::where("branch_id","=",$user)->get();



        if($request->ajax()){
            $branch = ProjectBranchCount::where("branch_id","=",$user)->get();

            return DataTables::of($branch)
                ->addIndexColumn()

                ->editColumn('active', function (ProjectBranchCount $branchCount) {
                    return $branchCount->getActive();
                })
                ->editColumn('project_id', function (ProjectBranchCount $branchCount) {
                    return $branchCount->projects->project_name;
                })
                ->addColumn('project_name', function (ProjectBranchCount $branchCount) {
                    return $branchCount->project_id;
                })
                ->editColumn('deadline_date', function (ProjectBranchCount $branchCount) {
                    return $branchCount->deadline_date;
                })
                ->addColumn('date', function (ProjectBranchCount $branchCount) {
                    return Carbon::now();
                })
                ->make(true);

        }

        return view('dashboard.pages.project_managment.index',compact('branch'));
    }
    public function updateStatus(Request $request)
    {

//        $b = ProjectBranchCount::findorfail($request->id);
//        $project_id =  $b->project_id;
//        $project = Project::find($project_id);
//        $branch = ProjectBranchCount::where("project_id","=",$project_id)->get();
//        $b->update([
//            'status_id'=>$request->status
//        ]);
//        toastr()->success(__('تم تعديل البيانات بنجاح'));
//
//        return redirect()->route('projects.branchCount.index',$project_id)->with([$project_id,$branch,$project]);

    }

}
