<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\AttachmentCategory;
use App\Models\CategoriesOfProject;
use App\Models\Currency;
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
                ->make(true);
        }

        return view('dashboard.pages.projects.index');
    }


    public function create()
    {
        $categories = CategoriesOfProject::all();
        $currencies = Currency::all();
        $attachments = ProjectAttachment::all();
        $categories_attachment = AttachmentCategory::all();
        $mainBranches = MainBranche::all();

        return view('dashboard.pages.projects.create', compact('categories', 'mainBranches', 'categories_attachment', 'attachments', 'currencies'));
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
            toastr()->error(__('يوجد خطاء ما'));
            return redirect()->route('projects.index');        }
    }

    public function edit($id)
    {
        $projects = Project::select()->find($id);
        $categories = CategoriesOfProject::all();
        $currencies = Currency::all();
        $attachments = ProjectAttachment::all();
        $categories_attachment = AttachmentCategory::all();
        $projectsAttachment = ProjectAttachment::select()->where('project_id', '=', $id)->get();

        $mainBranches = MainBranche::all();


        return view('dashboard.pages.projects.edit', compact('projects','mainBranches', 'projectsAttachment', 'currencies', 'attachments', 'categories', 'categories_attachment'));
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
                    'project_id' => $id,
                    'category_id' => $attachment_array[$i]["category_attachment_id"],
                    'file' => $file_attachment_path,
                    'url' => $attachment_array[$i]["url"],
                    'add_by' => Auth::user()->id,

                ]);
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
            if (!$project){
                toastr()->error(__('يوجد خطاء ما'));
                return redirect()->route('user.index');
            }
            $project ->delete();

            toastr()->success(__('تم تحديث البيانات بنجاح'));
            return back();

        }catch (\Exception $ex){
            toastr()->error(__('يوجد خطاء ما'));
            return back();
        }
    }
    public function deleteAttachment($id)
    {
        try {
            $projectAttachment= ProjectAttachment::find($id);
            if (!$projectAttachment){
                toastr()->error(__('يوجد خطاء ما'));
                return redirect()->route('user.index');
            }
            $projectAttachment ->delete();

            toastr()->success(__('تم تحديث البيانات بنجاح'));
            return back();

        }catch (\Exception $ex){
            toastr()->error(__('يوجد خطاء ما'));
            return back();
        }
    }
}
