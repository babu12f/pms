<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\File;
use App\Comment;
use App\Collaboration;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Project::personal()->get();

        return view('projects.index')->withProject($projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('projects.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|min:3',
            'due-date' => 'required|date|after:today',
            'notes'    => 'required|min:10',
            'status'   => 'required'
        ]);

        $project = new Project;
        $project->project_name   = $request->input('name');
        $project->project_status = $request->input('status');
        $project->due_date       = $request->input('due-date');
        $project->project_notes  = $request->input('notes');
        $project->user_id        = Auth::user()->id;

        $project->save();

        return redirect()->route('projects.index')
                         ->with('info','Your Project has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $project       = Project::find($id);
        $tasks         = $project->tasks;
        $files         = $project->files;
        $comments      = $project->comments;
        $collaborators = $project->collaborations;

        return view('projects.show')
            ->withProject($project)
            ->withTasks($tasks)
            ->withFiles($files)
            ->withComments($comments)
            ->withCollaborators($collaborators);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('projects.edit')->withProject($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $this->validate($request, [
            'name'     => 'required|min:3',
            'due-date' => 'required|date|after:today',
            'notes'    => 'required|min:10',
            'status'   => 'required'
        ]);

        $project->project_name   = $request->input('name');
        $project->project_status = $request->input('status');
        $project->due_date       = $request->input('due-date');
        $project->project_notes  = $request->input('notes');

        $project->save();

        return redirect()->back()->with('info','Your Project has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return ['msg'=>'success', 'redirect'=>'/Prego/projects'];
    }

}
