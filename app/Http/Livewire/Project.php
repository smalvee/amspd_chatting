<?php

namespace App\Http\Livewire;

use App\Models\Project as ModelsProject;
use App\Models\ProjectWiseUserAccess;
use App\Models\ProjectWiseUserInfo;
use LDAP\Result;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Project extends Component
{
    public $en_name, $jp_name, $projects_reffer, $name, $updated_at, $created_at, $p_id;
    public $search;
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
            $access = ProjectWiseUserAccess::where('user_id', Auth::user()->id)->first();
        }




        if (Auth::user()->type == 'Super Admin') {

            return view('livewire.project', [
                'projects' => ModelsProject::all()
            ])->extends('layouts.app');
        } else {
            if (Auth::user()->type == 'Admin' || Auth::user()->type == 'User') {

                // $select_project = DB::select(
                //     '
                // SELECT projects.*
                // FROM project_wise_user_infos
                // INNER JOIN projects ON project_wise_user_infos.project_id = projects.id
                // WHERE project_wise_user_infos.user_id = ?',
                //     [Auth::user()->id]
                // );

                return view('livewire.project', [
                    // 'select_project' => $select_project,

                    'select_project' => ModelsProject::when(Auth::user()->status === 'Active', function ($query) {
                        $query->whereIn('id', auth()->user()->projectWiseUserInfos->where('status', 'Active')->pluck('project_id')->unique());
                    })->get(),

                    'access_permission' => $access_permission,
                    'access' => $access



                ])->extends('layouts.app');
            }
        }

        // return view('livewire.project',[
        //     'projects' => ModelsProject::when(!auth()->user()->access('User'), function($query){
        //         $query->whereIn('id', auth()->user()->projectWiseUserInfos->where('status', 'Active')->pluck('project_id')->unique());
        //     })->when($this->search, function($query){
        //         $query->where("name->".app()->getLocale(), 'LIKE', "%$this->search%");
        //     })->latest()->get()
        // ])->extends('layouts.app');
    }

    public function submit()
    {
        $this->validate([
            'en_name' => 'required|string',
            'jp_name' => 'required|string',
        ]);

        ModelsProject::create([
            'name' => [
                'en' => $this->en_name,
                'jp' => $this->jp_name,
            ]
        ]);
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Project successfully Created !']);
        $this->reset();
    }

    public function Edit_modal(int $project_id)
    {
        $projects_reffer = ModelsProject::findOrFail($project_id);

        // dd( $projects_reffer);
        if ($projects_reffer) {
            $this->p_id = $projects_reffer->id;
            $this->en_name = $projects_reffer->name;
            $this->jp_name = $projects_reffer->name;
            // $this->name = $project->name;
            // return view('livewire.project', compact((string) $projects_reffer));
        } else {
            return redirect()->to('/project');
        }
    }



    public function update_project_modal()
    {
        $result = ModelsProject::where('id', $this->p_id)->update([
            // 'username' => $this->en_name,
            // 'role' => $this->jp_name,

            'name' => [
                'en' => $this->en_name,
                'jp' => $this->jp_name,
            ]

        ]);
        if ($result) {

            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Edited!']);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'fail',  'message' => 'Failed']);
        }
    }


    public function delete($user_id)
    {
        ModelsProject::findOrFail($user_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Project deleted !']);
    }
}
