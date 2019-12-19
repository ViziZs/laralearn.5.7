<?php

namespace App\Http\Controllers;

use App\Mail\ProjectCreated;
use App\Project;
use Illuminate\Support\Facades\Mail;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('projects.index', [
            'projects' => auth()->user()->projects
        ]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $attributes = $this->validateProject();

        $attributes['owner_id'] = auth()->id();

        $project = Project::create($attributes);

        /*Mail::to($project->owner->email)->send(
            new ProjectCreated($project)
        );*/

        event(new \App\Events\ProjectCreated($project));

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }

    protected function validateProject()
    {
        return request()->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required'
        ]);
    }
}
