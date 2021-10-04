<?php

namespace App\Http\Controllers;

use App\Rules\Slug;
use App\Models\Images;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProjectCollection;

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
            'profile' => $project->user->profile,
            'image' => $project->images
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
            'slug' => ['required', new Slug, 'alpha_dash', 'unique:projects'],
            'repository' => ['required'],
            'link' => ['required'],
            'files' => ['required']
        ]);
        $project = Project::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $request->slug,
            'repository' => $request->repository,
            'link' => $request->link,
        ]);

        foreach ($request->file('files') as $file) {
            $image = $file->store('public/image');
            $fileUrl = Storage::url($image);
            Images::create([
                'images' => $fileUrl,
                'project_id' => $project->id
            ]);

            // $fileName = Str::random(10) . $file->getClientOriginalName();
            // $fileUrl = storage_path() . '\app\public\image/' . $fileName;
            // Image::make($file)
            //     ->resize(1200, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save($fileUrl);
            // Images::create([
            //     'images' => '/storage/image/' . $fileName,
            //     'project_id' => $project->id
            // ]);
        }

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
