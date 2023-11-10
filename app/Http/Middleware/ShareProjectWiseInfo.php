<?php

namespace App\Http\Middleware;

use App\Models\Project;
use App\Models\ProjectWiseUserInfo;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;



class ShareProjectWiseInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!request()->route('project_id')) {
            return redirect()->back();
        }

        $project = Project::find(request()->route('project_id'));
        View::share([
            's_active_project' => $project,
            's_active_user' => ProjectWiseUserInfo::where(['user_id' => auth()->user()->id, 'project_id' => request()->route('project_id')])->first(),
        ]);

        App::instance('s_active_project', $project);

        return $next($request); 
    }
}
