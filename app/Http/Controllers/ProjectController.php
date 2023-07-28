<?php

namespace App\Http\Controllers;

use App\Events\ProjectSaved;
use App\Http\Requests\SaveProjectRequest;
use App\Models\Category;
use App\Models\Project;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
        $newProject = new Project();
        $projects = Project::/* withTrashed()-> */with("category")->latest("created_at")->paginate(8);
        $deletedProjects = Project::onlyTrashed()->get();
        
        // $projects = DB::table("project")->get();

        // $response = [
        //     "status" => 200,
        //     "message" => $projects
        // ];

        Debugbar::log(request()->user());

        return view("projects.index")->with(compact("projects", "newProject", "deletedProjects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows("create", $project = new Project())) {
            return back()->with(["status" => "403 - No autorizado"]);
            // abort(403);
        }
        
        return view("projects.create")->with([
            "project" => $project,
            "categories" => Category::pluck('name', 'id')
        ]);
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
        
        $project = new Project($request->only("title", "slug", "description", "category_id"));

        $project->image = $request->file("image")->store("images");
            
        $project->save();
        
        ProjectSaved::dispatch($project);
        
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
        $this->authorize('update', $project);
        $categories = Category::pluck('name', 'id');
        return view("projects.edit")->with(compact("project", "categories"));
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(SaveProjectRequest $request, Project $project)
    {
        
        // ddd( $request->only("title", "slug", "description", "image") );

        abort_unless(Gate::allows('update', $project), 403);
        
        if ($request->hasFile("image")) {

            $project->image && Storage::delete($project->image);

            $project->fill($request->only("title", "slug", "description", "category_id"));
            
            $project->image = $request->file("image")->store("images");
            
            $project->save();

            ProjectSaved::dispatch($project);
           
        } else {

            // $project->update(array_filter($request->validated())));

            $project->update($request->only("title", "slug", "description", "category_id"));
        }
        

        $status = __("The project has been edited successfully");

        return redirect()->route("projects.show", compact("project"))->with(compact("status"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize("delete", $project);
        $project->delete();
        return redirect()->route("projects.index")->with("status", __("The project has been deleted successfully"));
    }


    public function restore(string $projectSlug)
    {
        $project = Project::withTrashed()->whereSlug($projectSlug)->firstOrFail();
        $this->authorize("restore", $project);
        $project->restore();
        return back()->with([ 'status' => __("The project has been restored successfully") ]);
    }

    public function forceDelete(string $projectSlug)
    {
        $project = Project::withTrashed()->whereSlug($projectSlug)->firstOrFail();
        $this->authorize("forceDelete", $project);
        Storage::delete($project->image);
        $project->forceDelete();
        return back()->with([ 'status' => __("The project has been forcefully deleted successfully") ]);
    }
}
