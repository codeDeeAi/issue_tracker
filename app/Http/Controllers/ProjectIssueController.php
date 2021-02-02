<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\project_issue;
use Illuminate\Http\Request;

class ProjectIssueController extends Controller
{
    /**
     * Get All Project issues
     */
   public function index(Request $request, $id)
   {
    
        return project_issue::where('project_id', $id)->orderBy('id', 'desc')->get();

   }

   /**
    * Get Project Author
    */
   public function showAuthor(Request $request, $id)
   {
       return project::where('id', $id)->get();
   }

   /**
    *  Create new project issue
    */
    public function create(Request $request)
    {
        /**
         * Validate
         */

         $this->validate($request,[
             'project_id' => 'required'
         ]);

         project_issue::create([
             'project_id' => $request->project_id
         ]);
    }

    /**
     * 
     *  UPDATING FIELDS
     * 
     */
    /** Update Module */
    public function updateModule(Request $request)
    {
       $this->validate($request, [
           'id' => 'required',
           'value' => 'bail|required'
       ]);

       project_issue::where('id', $request->id)->update([
            'module' => $request->value
       ]);
    }

    /** Update Issue */
    public function updateIssue(Request $request)
    {
       $this->validate($request, [
           'id' => 'required',
           'value' => 'bail|required'
       ]);

       project_issue::where('id', $request->id)->update([
            'issue' => $request->value
       ]);
    }
    
     /** Update QA Status */
     public function updateQaStat(Request $request)
     {
        $this->validate($request, [
            'id' => 'required',
            'value' => 'bail|required'
        ]);
 
        project_issue::where('id', $request->id)->update([
             'qa_status' => $request->value
        ]);
     }
      /** Update Dev Status */
    public function updateDevStat(Request $request)
    {
       $this->validate($request, [
           'id' => 'required',
           'value' => 'bail|required'
       ]);

       project_issue::where('id', $request->id)->update([
            'dev_status' => $request->value
       ]);
    }
    /** Update QA User */
    public function updateQaUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'value' => 'bail|required'
        ]);
 
        project_issue::where('id', $request->id)->update([
             'qa_id' => $request->value
        ]);
    }
    
    /** Update QA User */
    public function updateDevUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'value' => 'bail|required'
        ]);
 
        project_issue::where('id', $request->id)->update([
             'dev_id' => $request->value
        ]);
    }

     /** Update Date Logged  */
     public function updateDateLogged(Request $request)
     {
         $this->validate($request, [
             'id' => 'required',
             'value' => 'bail|required'
         ]);
  
         project_issue::where('id', $request->id)->update([
              'date_logged' => $request->value
         ]);
     }

      /** Update Date Fixed */
    public function updateDateFixed(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'value' => 'bail|required'
        ]);
 
        project_issue::where('id', $request->id)->update([
             'date_fixed' => $request->value
        ]);
    }
}
