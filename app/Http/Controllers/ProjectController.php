<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;



class ProjectController extends Controller
{
    public function index(){
        $projects = Project::where('is_completed',false)
                            ->orderBy('created_at','desc')
                            ->withCount(['tasks'=>function($query){
                                $query->where('is_completed',false);
                            }])
                            ->get();

        return $projects->toJson();
    }      
    
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'description'=> 'required',
        ]);

        $project = Project::create([
            'name'=>$validatedData['name'],
            'description'=>$validatedData['description'],
        ]);

        return response()->json('Project Created');
    }


    public function show($id)
    {
        $project = Project::with(['tasks'=>function($query){
            $query->where('is_completed',false);
        }])->find($id);

        return $project->toJson();
    }


    public function markAsCompleted(Project $project)
    {
        $project->is_completed = true;
        $tasks = Task::with('tasks')->where('project_id',$project->id);
        $project->delete();
        $tasks->delete();
        
        return response()->json('Project Updated');
    }

}
