<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\project_collaborator;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectCollaboratorController extends Controller
{
    /**
     * Get Collaborators
     */
    public function index(Request $request, $id)
    {
        return project_collaborator::where('project_id', $id)->get();
    }

    /**
     * Search users
     */
    public function showUsers(Request $request, $email)
    {
        return User::where('email', 'LIKE', '%'.$email.'%')->get();
    }
    
    /**
     * Add A collaborator
     */
    public function create(Request $request)
    {
        /**
         * Validation
         */

         $this->validate($request, [
             'project_id' => 'required',
             'user_id' => 'bail|required'
         ]);

         /**
          *  Check if user id is not project admin id
            * Checks If User is already a collaborator
          */

         if(project::where('id', $request->project_id)->where('user_id', '=',$request->user_id)->exists()){
             return response()->json([
                 'message' => 'User is the project author'
             ], 403);
         } else if(project_collaborator::where('project_id', $request->project_id)->where('user_id','=', $request->user_id)->exists()){
            return response()->json([
                'message' => 'User is already a collaborator'
            ], 403);
         } else {
            project_collaborator::create([
                'project_id' => $request->project_id,
                'user_id'   => $request->user_id
             ]);
         }       
        
    }

    /**
     * Remove a project collaborator
     */
    public function destroy(Request $request, $project_id,$user_id)
    {
        /**
          *  Check if user id is not project admin id
            * Checks If User is a collaborator
          */

          if(project::where('id', $request->project_id)->where('user_id', '=',$request->user_id)->exists()){
            return response()->json([
                'message' => 'User is the project author'
            ], 403);
        } else {
           project_collaborator::where('project_id', $project_id)->where('user_id', $user_id)->delete();
        }       
    }
}
