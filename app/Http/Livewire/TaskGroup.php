<?php

namespace App\Http\Livewire;

use App\Models\ProjectWiseUserAccess;
use App\Models\ProjectWiseUserInfo;
use App\Models\TaskGroup as ModelsTaskGroup;
use App\Models\TaskGroupWiseUserList;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TaskGroup extends Component
{
    public $category, $search, $project, $users, $user, $group_id, $gt_id, $ind_group_info = null, 
    $task_group_id, $user_id, $notification = 2, $project_id_for_sql;

    public function mount()
    {
        $this->project = app()->get('s_active_project');
    }
    public function render()
    {
        $module_id = NULL;
        $access = null;
        $create = NULL;
        $read = NULL;
        $update = NULL;
        $delete = NULL;
        $access_permission = Auth::user()->type ?? null;
        $results2 = NULL;
        $results1 = NULL;
        $results2 = NULL;
        $results1 = NULL;
        $projects_reffer = [];
        $loggedin_id = Auth::user()->id;

        if ($access_permission == 'User' || $access_permission == 'Admin') {
            $access = ProjectWiseUserAccess::where('user_id', Auth::user()->id)->where('project_id', $this->project->id)->first();
        }


        return view('livewire.task-group', [
            'groups' => ModelsTaskGroup::where('project_id', $this->project->id)->when($this->search, function ($q) {
                $q->where('name', 'LIKE', "%$this->search%");
            })->get(),
            'project_users' => ProjectWiseUserInfo::where('project_id', $this->project->id)->get(),
            'access' => $access,
            'access_permission' => $access_permission
        ])->extends('layouts.app');
    }

    public function submit()
    {
        $this->validate([
            'category' => 'required|string|unique:task_groups,name',

        ]);

        ModelsTaskGroup::create([
            'name' => $this->category,
            'project_id' => $this->project->id,
        ]);
        $this->category = $this->users = null;
        $this->dispatchBrowserEvent('closeModal');

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully category created !']);

        // return redirect()->to(url()->current());


    }

    public function add_user()
    {
        $notification = 2;

        $this->validate([
            'gt_id' => 'required',
            'users' => 'required'
        ]);
        // dd(123);

        foreach ($this->users as $user_id => $selected_status) {
            if ($selected_status) {
                $user_check = TaskGroupWiseUserList::where('task_group_id', $this->gt_id)->where('user_id', $user_id)->first();

                if ($user_check) {
                    $this->dispatchBrowserEvent('alert', ['type' => 'warning', 'message' => "id: $user_id already exists!"]);
                    $notification = 1;
                } else {
                    TaskGroupWiseUserList::create([
                        'task_group_id' => $this->gt_id,
                        'user_id' => $user_id,
                        'project_id' => $this->project->id,
                        'status' => '1',
                        'created_by' => Auth::user()->id

                    ]);
                    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "id: $user_id Successfully Added Users"]);
                }
            }
        }

        if($notification == 2)
        {
            $this->gt_id = $this->users = null;
            $this->dispatchBrowserEvent('close_add_user_Modal');
        }

        
        



        // return redirect()->to(url()->current());


    }



    public function delete($todo_category_id)
    {
        ModelsTaskGroup::findOrFail($todo_category_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully category deleted !']);
        TaskGroupWiseUserList::where('task_group_id', $todo_category_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Terminate the users !']);
    }

    public function Remove_user($removable_user_id)
    {
        TaskGroupWiseUserList::findOrFail($removable_user_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully User Removed !']);
         }


    public function Open_add_user_modal(int $group_id)
    {
        $group = ModelsTaskGroup::findOrFail($group_id);

        if ($group) {
            $this->gt_id = $group->id;
            $this->category = $group->name;
            // $this->ind_group_info = ModelsTaskGroup::where('id', $group->id)->get();
            // ModelsTaskGroup::where('id', $group->id)->pluck('project_wise_user_info_ids')->toArray();
            // $this->ind_group_info = $group->id;

            $this->group_id =  $group_id;
            $this->project_id_for_sql =  $this->project->id;




        } else {
            return redirect()->to('/user');
        }
    }





    public function Edit_modal(int $group_id)
    {
        $group = ModelsTaskGroup::findOrFail($group_id);

        if ($group) {
            $this->gt_id = $group->id;
            $this->category = $group->name;
            // $this->ind_group_info = ModelsTaskGroup::where('id', $group->id)->get();
            // ModelsTaskGroup::where('id', $group->id)->pluck('project_wise_user_info_ids')->toArray();
            $this->ind_group_info = $group->id;
        } else {
            return redirect()->to('/user');
        }
    }


    public function update_modal()
    {
        $this->validate([
            'category' => 'required|string|unique:task_groups,name',

        ]);


        ModelsTaskGroup::where('id', $this->gt_id)->update([
            'name' => $this->category,
            'project_id' => $this->project->id,
        ]);
        $this->category = NULL;
        $this->dispatchBrowserEvent('close_update_Modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Updated!']);
    }
}
