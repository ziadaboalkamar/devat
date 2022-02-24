<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\AttachmentCategory;
use App\Models\BeneficiariesProject;
use App\Models\Beneficiary;
use App\Models\Branches;
use App\Models\CategoriesOfProject;
use App\Models\Currency;
use App\Models\Donor;
use App\Models\MainBranche;
use App\Models\Project;
use App\Models\ProjectAttachment;
use App\Models\ProjectBranchCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class ProjectController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $project = Project::all();

            return DataTables::of($project)
                ->addIndexColumn()

                ->editColumn('main_branch_id', function (Project $project) {
                    return $project->mainBranches->name;
                })
                 ->editColumn('category_id', function (Project $project) {

                    return $project->category->name;
                })

                ->editColumn('active', function (Project $project) {
                    return $project->getActive();

                })
                ->make(true);
        }


        return view('dashboard.pages.projects.index',[
            'projects' => Project::get(),
        ]);
    }


    public function create()
    {
        $categories = CategoriesOfProject::all();
        $currencies = Currency::all();
        $attachments = ProjectAttachment::all();
        $categories_attachment = AttachmentCategory::all();
        $mainBranches = MainBranche::all();
        $donors = Donor::all();

        return view('dashboard.pages.projects.create', compact('categories','donors','mainBranches','categories_attachment', 'attachments', 'currencies'));
    }

    public function store(ProjectRequest $request)
    {


        try {
            $project = Project::insertGetId([
                'main_branch_id' => $request->main_branch_id,
                'project_name' => $request->project_name,
                'grant_date' => $request->grant_date,
                'category_id' => $request->category_id,
                'grant_value' => $request->grant_value,
                'currency_id' => $request->currency_id,
                'exchange_amount' => $request->exchange_amount,
                'managerial_fees' => $request->managerial_fees,
                'start_date' => $request->start_date,
                'donor_id'=>$request->donor_id,
                'status' => 1
            ]);

            $attachment_array = $request->invoice;

            for ($i = 0; $i < count($attachment_array); $i++) {
                $file_attachment = null;
                if (isset($attachment_array[$i]['file'])) {
                    $file_attachment = $attachment_array[$i]['file'];
                     $file_attachment_path = $file_attachment->store('/Attachment_Project', 'assets');

                } else {
                    $file_attachment_path = null;
                }
                ProjectAttachment::create([
                    'project_id' => $project,
                    'category_id' => $attachment_array[$i]["category_attachment_id"],
                    'file' => $file_attachment_path,
                    'url' => $attachment_array[$i]["url"],
                    'add_by' => Auth::user()->id,

                ]);
            }

            toastr()->success(__('تم حفظ البيانات بنجاح'));
            return redirect()->route('projects.index');

        } catch (\Exception $ex) {

            return ($ex);
           // return redirect()->route('projects.index');
             }
    }

    public function edit($id)
    {
        $projects = Project::select()->find($id);
        $categories = CategoriesOfProject::all();
        $currencies = Currency::all();
        $attachments = ProjectAttachment::all();
        $categories_attachment = AttachmentCategory::all();
        $projectsAttachment = ProjectAttachment::select()->where('project_id', '=', $id)->get();
        $donors = Donor::all();
        $mainBranches = MainBranche::all();


        return view('dashboard.pages.projects.edit', compact('projects','donors','mainBranches', 'projectsAttachment', 'currencies', 'attachments', 'categories', 'categories_attachment'));
    }

    public function update($id,ProjectRequest $request)
    {

        try {
            $project = Project::select()->find($id);
            if (!$project){
                return redirect()->route('projects.index');
            }


            Project::where('id' , $id)->update([
                'main_branch_id' => $request->main_branch_id,
                'project_name' => $request->project_name,
                'grant_date' => $request->grant_date,
                'category_id' => $request->category_id,
                'grant_value' => $request->grant_value,
                'currency_id' => $request->currency_id,
                'exchange_amount' => $request->exchange_amount,
                'managerial_fees' => $request->managerial_fees,
                'start_date' => $request->start_date,
                'donor_id'=>$request->donor_id


            ]);

            $attachment_array = $request->invoice;
           if ($attachment_array[0]["category_attachment_id"] != null)
           {            for ($i = 0; $i < count($attachment_array); $i++) {
                $file_attachment = null;
                if (isset($attachment_array[$i]['file'])) {
                    $file_attachment = $attachment_array[$i]['file'];
                    $file_attachment_path = $file_attachment->store('/Attachment_Project', 'assets');

                } else {
                    $file_attachment_path = null;
                }
                ProjectAttachment::create([
                    'project_id' => $id,
                    'category_id' => $attachment_array[$i]["category_attachment_id"],
                    'file' => $file_attachment_path,
                    'url' => $attachment_array[$i]["url"],
                    'add_by' => Auth::user()->id,

                ]);
            }
           }
            toastr()->success(__('تم تحديث البيانات بنجاح'));
            return redirect()->route('projects.index');

        }
        catch (\Exception $exception){

            toastr()->error(__('يوجد خطاء ما'));
            return redirect()->route('projects.index');

        }
    }

    public function delete($id)
    {
        try {
            $project= Project::find($id);
       $benefactoryPoject = BeneficiariesProject::where('project_id','=',$id)->get();
            if (!$project){
                toastr()->error(__('يوجد خطاء ما'));
                return redirect()->route('projects.index');
            }
            if (count($benefactoryPoject)>0){
                toastr()->error(__('هذا المشروع يحتوي على مستفيدين لا يمكن حذفه'));
                return redirect()->route('projects.index');
            }
            $project ->delete();

            toastr()->success(__('تم حذف المشروع بنجاح'));
            return back();

        }catch (\Exception $ex){
            return $ex;
            toastr()->error(__('يوجد خطاء ما'));
            return back();
        }
    }
    public function deleteAttachment($id)
    {

     ProjectAttachment::find($id)->delete();

    }


    public function deleteaa()
    {

    }


    public function benefactoryPoject($id,Request $request){


            if($request->ajax()){
                $user = Auth::user()->branch_id;

                $beneficiariesProject = BeneficiariesProject::where('project_id','=',$id)->where('branch_id','=',$user)->get();


                return DataTables::of($beneficiariesProject)
                    ->addIndexColumn()
                    ->editColumn('created_at', function (BeneficiariesProject $beneficiariesProject) {
                        return $beneficiariesProject->created_at->format('Y-m-d');
                    })

                    ->editColumn('active', function (BeneficiariesProject $beneficiariesProject) {
                        return $beneficiariesProject->getActive();
                    })
                    ->editColumn('branch_name', function (BeneficiariesProject $beneficiariesProject) {
                        return $beneficiariesProject->branchs->name;
                    })
                    ->editColumn('beneficiary_name', function (BeneficiariesProject $beneficiariesProject) {
                        return $beneficiariesProject->beneficiaries->firstName.' ' .$beneficiariesProject->beneficiaries->lastName;
                    })
                    ->make(true);

            }

            return view('dashboard.pages.beneficiaries_projects.index',[
                'beneficiariesProjects' => BeneficiariesProject::where('project_id','=',$id)->get(),
                'project_id' => $id,
                'project' => Project::find($id)
            ]);
    }

    public function updateStatus(Request $request)
    {
       $b = Project::findorfail($request->id);
           $b->update([
               'status'=>$request->status
           ]);
       toastr()->success(__('تم تعديل البيانات بنجاح'));

       return redirect()->route('projects.index') ;

    }
    public function show($id){
        $projects = Project::select()->find($id);
        $categories = CategoriesOfProject::all();
        $currencies = Currency::all();
        $attachments = ProjectAttachment::all();
        $categories_attachment = AttachmentCategory::all();
        $projectsAttachment = ProjectAttachment::select()->where('project_id', '=', $id)->get();
        $donors = Donor::all();
        $mainBranches = MainBranche::all();


        return view('dashboard.pages.projects.show', compact('projects','donors','mainBranches', 'projectsAttachment', 'currencies', 'attachments', 'categories', 'categories_attachment'));

    }

    public function branchCount($id,Request $request){
        $branch = ProjectBranchCount::where("project_id","=",$id)->get();
        $project = Project::find($id);
        $project_id =$id;

        if($request->ajax()){
            $branch = ProjectBranchCount::where("project_id","=",$id)->get();

            return DataTables::of($branch)
                ->addIndexColumn()
                ->editColumn('branch_id', function (ProjectBranchCount $branchCount) {
                    return $branchCount->branches->name;
                })
                ->editColumn('active', function (ProjectBranchCount $branchCount) {
                    return $branchCount->getActive();
                })
                ->make(true);

        }

        return view('dashboard.pages.branch_count.index',compact('branch','project_id','project'));

    }
    public function storeBranchCount($id,Request $request){
        $branch = ProjectBranchCount::where("project_id","=",$id)->get();
        $project = Project::find($id);
        $project_id = $id;
        $attachment_array = $request->invoice;

        for ($i = 0; $i < count($attachment_array); $i++) {

            ProjectBranchCount::create([
                'branch_id' => $attachment_array[$i]["branch_id"],
                'beneficiaries_count' => $attachment_array[$i]["beneficiaries_count"],
                'count'=>$attachment_array[$i]["count"],
                'deadline_date'=>$attachment_array[$i]["deadline_date"],
                'project_id'=>$project_id,
                'status_id'=>1


            ]);
        }
        toastr()->success(__('تم تحديث البيانات بنجاح'));
        return redirect()->route('projects.branchCount.index',$project_id)->with([$project_id,$branch,$project]);

    }



}


