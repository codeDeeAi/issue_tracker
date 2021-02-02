<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request, $id)
    {
        /**
         * Find project name from id
         */
        $project = project::where('id', $id)->get('name');

        /**
         * Pass parameters and return view
         */
        return view('project')->with(['name'=>$project[0]->name,'id'=> $id]);
    }


    public function create(Request $request)
    {
        /**
         * Get User
         */
        $user = Auth::user();

        if(!Auth::check()){
            Auth::logout();
            return response()->json([
                'message' => 'not allowed'
            ]);
        }
        /**
         * Validate request
         */
        $this->validate($request, [
            'name' => 'required',
            'description' => 'bail|required'
        ]);

        /**
         *  Create Project
         */

        $project = project::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description
         ]);

        /**
         * Return success
         */
        if($project){
            return response()->json(['message' => 'success'], 200);            
        } else {
            return response()->json(['message' => 'failed'], 401);
        }
    }

    /**
     *  Show my projects
     */
    public function show(Request $request)
    {
        /**
         * Get User
         */
        $user = Auth::user();

        if(!Auth::check()){
            Auth::logout();
            return response()->json([
                'message' => 'not allowed'
            ]);
        }

        return project::where('user_id', $user->id)->select()->paginate(5);
    }

    /**
     *  Show other projects
     */
    public function showOthers(Request $request)
    {
        /**
         * Get User
         */
        $user = Auth::user();

        if(!Auth::check()){
            Auth::logout();
            return response()->json([
                'message' => 'not allowed'
            ]);
        }

        return project::WhereHas('collaborators', function($q) use($user){
                    $q->where('user_id', $user->id);
                })->orderBy('id', 'desc')->select()->paginate(6);
    }

    /**
     * Delete Project
     */
    public function destroy(Request $request, $project_id)
    {
        /**
         * Get User
         */
        $user = Auth::user();

        /**
         * Check if user is the project author
         */
        if(project::where('id', $project_id)->where('user_id', '=',$user->id)->exists()){
            // Use DB Transaction to delete
        } else {
            return response()->json([
                'message' => 'Only a project author is authorized to perform this action'
            ], 403);
        }
    }
}
