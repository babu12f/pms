<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Project;
use App\Collaboration;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectCollaboratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function addCollaborator(Request $request, $id, Collaboration $collaboration)
    {
        $this->validate($request, [
            'collaborator'     => 'required|min:5',
        ]);

        $collaborator_username           = substr(trim($request->input('collaborator')),1);
        $collaboration->project_id       = $id;
        if( is_null($this->getId($collaborator_username)))
        {
            return redirect()->back()->with('warning', 'This user does not exist');
        }

        $collaborator = $this->isCollaborator($id, $this->getId($collaborator_username));
        if(! is_null($collaborator))
        {
            return redirect()->back()->with('warning', 'This user is already a collaborator on this project');
        }

        $collaboration->collaborator_id  = $this->getId($collaborator_username);
        $collaboration->save();

        return redirect()->back()->with('info', "{$collaborator_username} has been added to your project successfully");
    }

    /**
     * Get id of the user
     * @param  string $username
     * @return mixed  null | integer
     */
    private function getId($username)
    {
        $result = User::where('username', $username)->first();

        return (is_null($result)) ? null : $result->id;
    }

    /**
     * Check if the user about to be added as a collaborator is already one on the project
     * @param  int  $projectId
     * @param  int  $collaboratorId
     * @return boolean
     */
    private function isCollaborator($projectId, $collaboratorId)
    {
        return Collaboration::where('project_id', $projectId)
            ->where('collaborator_id', $collaboratorId)
            ->first();
    }

    public function deleteCollaborator($projectId, $collaborationId)
    {
        //DB::enableQueryLog();
        //dd('babor');
        Collaboration::where('id', $collaborationId)->where('project_id', $projectId)->delete();

        //dd(DB::getQueryLog());
            //->delete();

        //return redirect()->route('projects.show')->with('info', 'Comment deleted successfully');
        echo json_encode("success");
    }
}
