<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\Project;
use App\Models\ProjectBranchCount;
use Illuminate\Http\Request;

class BranchCountController extends Controller
{
    public function create(Request $request){
        $project_id = $request->project_name;
        $branches = Branches::all();

        return view('dashboard.pages.branch_count.create',compact('branches','project_id'));
    }

    public function edit(Request $request,$id){

        $branchesCount = ProjectBranchCount::find($id);
        $branches = Branches::all();

        return view('dashboard.pages.branch_count.edit',compact('branches','branchesCount'));
    }
    public function update(Request $request,$id){

        $branchesCount = ProjectBranchCount::find($id);
        $project_id=  $branchesCount->project_id;
         $project = Project::find($project_id);
        $branch = ProjectBranchCount::where("project_id","=",$project_id)->get();

        $attachment_array = $request->invoice;

        for ($i = 0; $i < count($attachment_array); $i++) {

            ProjectBranchCount::where('id' , $id)->update([
                'branch_id' => $attachment_array[$i]["branch_id"],
                'beneficiaries_count' => $attachment_array[$i]["beneficiaries_count"],
                'count'=>$attachment_array[$i]["count"],
                'deadline_date'=>$attachment_array[$i]["deadline_date"],
                'project_id'=>$project_id,



            ]);
        }
        toastr()->success(__('تم تحديث البيانات بنجاح'));
        return redirect()->route('projects.branchCount.index',$project_id)->with([$project_id,$branch,$project]);


    }

    public function updateStatus(Request $request)
    {

        $b = ProjectBranchCount::findorfail($request->id);
        $project_id =  $b->project_id;
        $project = Project::find($project_id);
        $branch = ProjectBranchCount::where("project_id","=",$project_id)->get();
        $b->update([
            'status_id'=>$request->status
        ]);
        toastr()->success(__('تم تعديل البيانات بنجاح'));

        return redirect()->route('projects.branchCount.index',$project_id)->with([$project_id,$branch,$project]);

    }
}
