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
        //Validate Input Colaborator Username
        $this->validate($request, [
            'collaborator'     => 'required|min:5',
        ]);

        /*
         *  Extrect Collaborator Username From Input
         *  Input @usernarm Remove '@' from input
         *
         * */
        $collaborator_username           = substr(trim($request->input('collaborator')),1);

        //Find User For Collabortor
        $collaborator = User::getCollaborator( $collaborator_username );

        if( !$collaborator )
        {
            return redirect()->back()->with('warning', 'This user does not exist');
        }

        //Check If User Allredy Collaborate This project
        $collaborate = Collaboration::isCollaborator($id, $collaborator->id);
        if( $collaborate )
        {
            return redirect()->back()->with('warning', 'This user is already a collaborator on this project');
        }

        //Store Collaborator To Session Sending Email To Collabrator
        session(['project_name' => $this->getProjectName($id),
            'user_email' => $collaborator->email
        ]);

        //Add Apropiat Data To Collaboration
        $collaboration->collaborator_id  = $collaborator->id;
        $collaboration->project_id       = $id;

        //Save The Collaboration
        $collaboration->save();

        return redirect()->back()->with('info', "{$collaborator_username} has been added to your project successfully");
    }

    public function deleteCollaborator($projectId, $collaborationId)
    {
        //DB::enableQueryLog();
        //dd(DB::getQueryLog());

        Collaboration::where('id', $collaborationId)->where('project_id', $projectId)->delete();

        //return redirect()->route('projects.show')->with('info', 'Comment deleted successfully');

        return ['msg'=>'success'];
    }

    /**
     * Get the Project Name for use in sending email for Collaboration
     * @param  int $id
     * @return string
     */
    private function getProjectName($id)
    {
        return Project::where('id', $id)->first()->project_name;
    }

}
