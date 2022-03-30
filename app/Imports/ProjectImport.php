<?php

namespace App\Imports;

use App\Models\Project;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProjectImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collection)
    {
        
        if ($collection->count() > 0) {
            foreach ($collection->toArray() as $key => $value) {
                $insert_data[] = array(
                    'project_name'  => $value[1],
                    'grant_date'   => $value[2],
                    'category_id'   => $value[3],
                    'grant_value'    => $value[4],
                    'currency_id'  => $value[5],
                    'exchange_amount'   => $value[6],
                    'managerial_fees' => $value[7],
                    'status' => $value[8],
                    'start_date' => $value[9],
                    'main_branch_id' => $value[10],
                    'donor_id' => $value[11],
                    'setting_status' => $value[12],
                );
            //    echo $insert_data;
                // Project::create($insert_data)->toSql();

               if($key == 0){
                $project =new Project();
                $project->project_name = $value[1];
               $project->grant_date = date('d-m-Y' , strtotime($value[2]));
               $project->category_id = $value[3];
               $project->grant_value = $value[4];
               $project->currency_id = $value[5];
               $project->exchange_amount = $value[6];
               $project->managerial_fees = $value[7];
               $project->status = $value[8];
               $project->start_date = $value[9];
               $project->main_branch_id = $value[10];
               $project->donor_id = $value[11];
               $project->setting_status = $value[12];
            $project->save();

               }
            //    dd($value2);
                // Project::create([
                //     'project_name'  => 'tttttttttt',
                    
                //     'grant_date'   => '7/21/2000',
                //     'category_id'   => 3,
                //     'grant_value'    => 1,
                //     'currency_id'  => 10,
                //     'exchange_amount'   => 5,
                //     'managerial_fees' => 5,
                //     'status' => 1,
                //     'start_date' => '7/21/2000',
                //     'main_branch_id' => 2,
                //     'donor_id' => 0,
                //     'setting_status' => 1,
                // ]);
            }
        }
        return back()->with('success', 'Excel Data Imported successfully.');
    }
}
