<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$module_id = NULL;
$create = NULL;
$read = NULL;
$user_module = NULL;
$delete = NULL;
$Access_permission = NULL;
$results2 = NULL;
$results1 = NULL;
$projects_reffer = [];
$loggedin_id = Auth::user()->id;


$module_id_user = '0';
$create_user = '0';
$read_user = '0';
$module_id_todo = '0';
$create_todo = '0';
$read_todo = '0';
$module_id_taskgroup = '0';
$create_taskgroup = '0';
$read_taskgroup = '0';
$project_demo_id = '1';



if (Auth::user()->type == 'Super Admin') {
    $Access_permission = 'Super Admin';
}

if (Auth::user()->type == 'Admin') {
    $Access_permission = 'Admin';
}


// if (Auth::user()->type == 'User') {
//     // $user_module = DB::select('SELECT * FROM project_wise_user_accesses WHERE module_id = 5 && user_id = [$loggedin_id]');
//     $query_user = "SELECT * FROM project_wise_user_accesses WHERE module_id = 5 AND user_id = ?";
//     $user_module = DB::select($query_user, [$loggedin_id]);
//     foreach ($user_module as $r1_user) {
//         $module_id_user = $r1_user->module_id;
//         $create_user = $r1_user->create;
//         $read_user = $r1_user->read;
//     }
// }


// if (Auth::user()->type == 'User') {
//     // $todo_module = DB::select('SELECT * FROM project_wise_user_accesses WHERE module_id = 6 && user_id = $loggedin_id');
//     $query_todo = "SELECT * FROM project_wise_user_accesses WHERE module_id = 6 AND user_id = ?";
//     $todo_module = DB::select($query_todo, [$loggedin_id]);
//     foreach ($todo_module as $r1_todo) {
//         $module_id_todo = $r1_todo->module_id;
//         $create_todo = $r1_todo->create;
//         $read_todo = $r1_todo->read;
//     }
// }


// if (Auth::user()->type == 'User') {
//     // $taskgroup_module = DB::select('SELECT * FROM project_wise_user_accesses WHERE module_id = 7 && user_id = $loggedin_id');
//     $query_taskgroup = "SELECT * FROM project_wise_user_accesses WHERE module_id = 7 AND user_id = ?";
//     $taskgroup_module = DB::select($query_todo, [$loggedin_id]);
//     foreach ($taskgroup_module as $r1_taskgroup) {
//         $module_id_taskgroup = $r1_taskgroup->module_id;
//         $create_taskgroup = $r1_taskgroup->create;
//         $read_taskgroup = $r1_taskgroup->read;
//     }
// }




// dd($read_user, $read_todo, $read_taskgroup);




















// if (Auth::user()->type == 'Super Admin') {
//     $Access_permission = 'Super Admin';
// } else {
//     $Access_permission = NULL;
//     if (Auth::user()->type == 'Admin') {
//         $Access_permission = 'Admin';
//     } else {
//         if (Auth::user()->type == 'User') {
//             $results1 = DB::select('SELECT * FROM project_wise_user_accesses WHERE user_id = ?', [$loggedin_id]);
//             foreach ($results1 as $r1) {
//                 $module_id = $r1->module_id;
//                 $create = $r1->create;
//                 $read = $r1->read;
//                 $update = $r1->update;
//                 $delete = $r1->delete;
//             }

//             // dd($module_id,
//             // $create,
//             // $read,
//             // $update,
//             // $delete);
//         }
//     }
// }

// dd($Access_permission);


?>

<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
        </div><a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="d-flex align-items-center py-3"><img class="me-2" src="{{ asset('assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="40" /><span class="font-sans-serif">{{ config('app.name') }}</span></div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    {{-- <a class="nav-link" href="{{ route('dashboard') }}" role="button">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-calendar-alt"></span></span><span class="nav-link-text ps-1">{{ __('Dashboard') }}</span></div>
                    </a> --}}
                    @if($Access_permission=='Super Admin')
                    <x-menu-divider text="Super Admin" />
                    <x-menu text="{{ __('Project Admin') }}" url="{{ route('admin') }}" />
                    <x-menu text="{{ __('Languages') }}" url="{{ url('languages') }}" />
                    <x-menu text="{{ __('module') }}" url="{{ url('module') }}" />
                    @endif

                    @if($Access_permission=='Super Admin' || $Access_permission=='Admin')
                    <x-menu-divider text="Admin" />
                    <x-menu text="{{ __('Access') }}" url="{{ route('access') }}" />
                    <x-menu text="{{ __('Role') }}" url="{{ route('role') }}" />
                    @endif


                    <x-menu-divider text="User" />
                    <x-menu text="{{ __('Project') }}" url="{{ route('project') }}" />
                    

                    @if (request()->is('project/*'))
                    <x-menu-divider text="Project" />
                    


                    <?php
                    print($s_active_project->id);
                    
                    


 

                    if (Auth::user()->type == 'User') {
                        // $user_module = DB::select('SELECT * FROM project_wise_user_accesses WHERE module_id = 5 && user_id = [$loggedin_id]');
                        $query_user = "SELECT * FROM project_wise_user_accesses WHERE module_id = 5 AND user_id = ? AND project_id =?";
                        $user_module = DB::select($query_user, [$loggedin_id, $s_active_project -> id]);
                        foreach ($user_module as $r1_user) {
                            $module_id_user = $r1_user->module_id;
                            $create_user = $r1_user->create;
                            $read_user = $r1_user->read;
                        }
                    }


                    if (Auth::user()->type == 'User') {
                        // $todo_module = DB::select('SELECT * FROM project_wise_user_accesses WHERE module_id = 6 && user_id = $loggedin_id');
                        $query_todo = "SELECT * FROM project_wise_user_accesses WHERE module_id = 6 AND user_id = ? AND project_id =?";
                        $todo_module = DB::select($query_todo, [$loggedin_id, $s_active_project -> id]);
                        foreach ($todo_module as $r1_todo) {
                            $module_id_todo = $r1_todo->module_id;
                            $create_todo = $r1_todo->create;
                            $read_todo = $r1_todo->read;
                        }
                        
                        
                    }


                    if (Auth::user()->type == 'User') {
                        // $taskgroup_module = DB::select('SELECT * FROM project_wise_user_accesses WHERE module_id = 7 && user_id = $loggedin_id');
                        $query_taskgroup = "SELECT * FROM project_wise_user_accesses WHERE module_id = 7 AND user_id = ? AND project_id =?";
                        $taskgroup_module = DB::select($query_taskgroup, [$loggedin_id, $s_active_project -> id]);
                        foreach ($taskgroup_module as $r1_taskgroup) {
                            $module_id_taskgroup = $r1_taskgroup->module_id;
                            $create_taskgroup = $r1_taskgroup->create;
                            $read_taskgroup = $r1_taskgroup->read;
                        }
                    }
                    ?>

























                    @if($s_active_project && ($Access_permission=='Super Admin' || $Access_permission=='Admin' || $read_user == '1'))
                    <x-menu text="{{ __('User') }}" url="{{ route('project.user', $s_active_project) }}" />
                    @endif

                    
                    @if($s_active_project && ($Access_permission=='Super Admin' || $Access_permission=='Admin' || $read_todo == '1'))
                    <x-menu text="{{ __('To Do') }}" url="{{ route('project.todo', $s_active_project) }}" />
                    @endif


                    @if($s_active_project && ($Access_permission=='Super Admin' || $Access_permission=='Admin' || $read_taskgroup == '1'))
                    <x-menu text="{{ __('Task Group') }}" url="{{ route('project.task.group', $s_active_project) }}" />
                    @endif


                    @if($s_active_project && ($Access_permission=='Super Admin' || $Access_permission=='Admin' || ($module_id == '8' && $read =='1')))
                    <x-menu text="{{ __('Event') }}" url="#" />
                    @endif

                    <x-menu-divider text="Data Dashboard" />
                    @if($s_active_project && ($Access_permission=='Super Admin' || $Access_permission=='Admin' || $read_user == '1'))
                    <x-menu text="{{ __('Dashboard') }}" url="{{ route('project.dashboard', $s_active_project) }}" />
                    @endif


                    @endif




                    {{-- <x-menu text="{{ __('Chatting') }} {{ $s_active_project }}" url="{{ route('project.chatting', $s_active_project) }}"/> --}}
                </li>
            </ul>
            @if (request()->is('project/*'))
            <div class="settings mb-3">
                <div class="card shadow-none">
                    <div class="card-body alert mb-0" role="alert">
                        <div class="btn-close-falcon-container"></div>
                        <div class="text-left">
                            <table class="fs--2 mt-2 table table-sm">
                                <tr>
                                    <td>Project</td>
                                    <td>{{ $s_active_project->name ?? null }}</td>
                                </tr>
                                <tr>
                                    <td>User</td>
                                    <td>{{ $s_active_user->username ?? null }}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>{{ $s_active_user->role ?? null }}</td>
                                </tr>
                            </table>
                            <div class="d-grid"><a class="btn btn-sm btn-purchase" href="{{ route('project') }}" target="">Change Project</a></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</nav>