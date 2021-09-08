<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Laravel\Ui\Presets\React;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::search(request('search'))->orderBy('created_at', 'desc')->paginate();
        // dd($projects[0]->name);
        // dd($projects);
        // return ProjectResource::collection(
        //     Project::orderBy('created_at', 'desc')->paginate()
        // );
        return ProjectCollection::make($projects);
        // return $projects;
        // return ProjectResource::collection($projects);
    }

    public function show(Project $project)
    {
        return view('project', [
            'project' => $project,
            'user' => $project->user,
            'profile' => $project->user->profile
        ]);
    }

    public function project()
    {
        $user = auth()->user();
        $projects = $user->projects;
        return ProjectResource::collection($projects);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5'],
            'description' => ['required', 'min:10'],
        ]);
        $project = Project::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description
        ]);

        return ProjectResource::make($project);
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->all());
        return $project;
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return response(204);
    }
}
