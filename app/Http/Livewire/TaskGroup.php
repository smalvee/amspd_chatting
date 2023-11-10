<?php

namespace App\Http\Livewire;

use App\Models\ProjectWiseUserAccess;
use App\Models\ProjectWiseUserInfo;
use App\Models\TaskGroup as ModelsTaskGroup;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TaskGroup extends Component
{
    public $category, $search, $project, $users;

    public function mount(){
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


        return view('livewire.task-group',[
            'groups' => ModelsTaskGroup::where('project_id', $this->project->id)->when($this->search, function($q){
                $q->where('name', 'LIKE', "%$this->search%");
            })->get(),
            'project_users' => ProjectWiseUserInfo::where('project_id', $this->project->id)->get(),
            'access' => $access,
            'access_permission' => $access_permission
        ])->extends('layouts.app');
    }

    public function submit(){
        $this->validate([
            'category' => 'required|string|unique:task_groups,name',
            'users' => 'required|array'
        ]);
        $user_ids = [];
        foreach($this->users as $user_id => $selected_status){
            if($selected_status){
                array_push($user_ids, $user_id);
            }
        }

        ModelsTaskGroup::create([
            'name' => $this->category,
            'project_id' => $this->project->id,
            'project_wise_user_info_ids' => json_encode($user_ids),
        ]);
        $this->category = $this->users = null;
        $this->dispatchBrowserEvent('closeModal');
        
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully category created !']);
        
        // return redirect()->to(url()->current());
        

    }

    public function delete($todo_category_id){
        ModelsTaskGroup::findOrFail($todo_category_id)->delete(); 
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully category deleted !']);
    }


    public function Edit_modal(int $group_id)
    {
        $group = ModelsTaskGroup::findOrFail($group_id);
        if ($group) {
            $this->gt_id = $group->id;
            $this->category = $group->name;
           $uservalue =  $this->user = $group->project_wise_user_info_ids;
           return $uservalue;
        //    dd($uservalue);
        } else {
            return redirect()->to('/user');
        }
    } 


    public function update_modal()
    {
        $this->validate([
            'category' => 'required|string|unique:task_groups,name',
            'users' => 'required|array'
        ]);

        $user_ids = [];
        foreach($this->users as $user_id => $selected_status){
            if($selected_status){
                array_push($user_ids, $user_id);
            }
        }

        ModelsTaskGroup::where('id', $this->gt_id)->update([
            'name' => $this->category,
            'project_id' => $this->project->id,
            'project_wise_user_info_ids' => json_encode($user_ids),
        ]);
        $this->category = NULL;
        $this->users = NULL;
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Edited!']);
          
        
    }




}
