<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function __construct() {
        $this->middleware("auth")
                ->except("index", "show");// inverse is ->only(str)
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
        $projects = Project::latest("created_at")->paginate(8);
        
        // $projects = DB::table("project")->get();

        // $response = [
        //     "status" => 200,
        //     "message" => $projects
        // ];

        return view("projects.index")->with(compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("projects.create")->with([ "project" => new Project() ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProjectRequest $request)
    {
        // Project::create($request->all());
        // Project::create($request->validated()); // como all pero solo los validados
        // Project::create([
        //     "title" => request('title'),
        //     "slug" => request('slug'),
        //     "description" => $request->get('description')
        // ]);

        // $request->validate([
        //     "title" => "required",
        //     "slug" => "required",
        //     "description" => "required"
        // ]);

        // return dd($request->file("file"));
        
        
        $project = new Project($request->only("title", "slug", "description"));

        $project->image = $request->file("image")->store("images");
            
        $project->save();
        
        return redirect()->route("projects.index")->with("status", __("The project has been created successfully"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project/* string $id */)
    {
        // $project = Project::findOrFail($id);
        
        // return view("projects.show", [
        //     "project" => $project
        // ]);

        return view("projects.show", [
            "project" => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view("projects.edit")->with(compact("project"));
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(SaveProjectRequest $request, Project $project)
    {
        $project->image = $request->file("image")->store("images");
        
        $project->update($request->only("title", "slug", "description"));

        $status = __("The project has been edited successfully");

        return redirect()->route("projects.show", compact("project"))->with(compact("status"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("projects.index")->with("status", __("The project has been deleted successfully"));
    }
}
