<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Project $project)
    {
        $comments = $project->comments;
        return CommentResource::collection($comments);
    }
    public function store(Request $request, Project $project)
    {

        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'project_id' => $project->id,
            'body' => $request->body,
        ]);

        return CommentResource::make($comment);
    }
}
