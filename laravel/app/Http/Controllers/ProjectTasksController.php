<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postNewTask(Request $request, $id, Task $task)
    {
        $this->validate($request, [
            'task_name' => 'required|min:5',
        ]);

        $task->task_name = $request->input('task_name');
        $task->project_id = $id;

        $task->save();

        return redirect()->back()->with('info', 'Task created successfully');
    }

    /**
     * Update One Project Task
     * @param  Request $request   [description]
     * @param  [type]  $projectId [description]
     * @param  [type]  $taskId    [description]
     * @return [type]             [description]
     */
    public function updateOneProjectTask(Request $request, $projectId, $taskId)
    {
        $this->validate($request, [
            'task_name'  => 'required|min:3',
        ]);

        DB::table('tasks')
            ->where('project_id', $projectId)
            ->where('id', $taskId)
            ->update(['task_name' => $request->input('task_name')]);

        return redirect()->back()->with('info','Your Task has been updated successfully');
    }

    /**
     *  Get just one task for a particular Project
     * @param  [type] $projectId [description]
     * @param  [type] $taskId    [description]
     * @return [type]            [description]
     */
    public function getOneProjectTask($projectId, $taskId)
    {
        $task = Task::where('project_id', $projectId)
            ->where('id', $taskId)
            ->first();
        return view('tasks.edit')->withTask($task)->with('projectId', $projectId);
    }

    /**
     * Delete One Project Task
     * @param  [type] $projectId [description]
     * @param  [type] $taskId    [description]
     * @return [type]            [description]
     */
    public function deleteOneProjectTask($projectId, $taskId)
    {
        Task::where('id', $taskId)->where('project_id', $projectId)->delete();

        return ['msg'=>'success'];
    }

}
