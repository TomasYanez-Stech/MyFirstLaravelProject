<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    // return view('welcome');
    $nombre = "Tomás";

    $params = [
        "nombre" => $nombre
    ];

    // return view('test_contactos', compact("nombre"));
    // return view('test_contactos', $params);
    // return view('test_contactos')->with("nombre", $nombre);
    // return view('test_contactos')->with(compact("nombre"));
    return view('test_contactos')->with($params);
})->name("home");
 */

/*  DB::listen(function($query) {
    dump($query->sql);
 }); */


Route::view("/", "home")->name("home");
Route::view("/about", "about")->name("about");

Route::view("/contact", "contact")->name("contact");
Route::post("/contact", [ContactController::class, "store"])->name("contact.store");

// Route::view("/portfolio", "portfolio", compact("nombre", "portfolio"))->name("portfolio");
// Route::get("/portfolio", PortfolioController::class)->name("portfolio");
// Route::get("/projects/{id}", [ProjectController::class, "show"])->name("projects.show");

/* Route::get("/projects", [ProjectController::class, "index"])->name("projects.index");
Route::get("/projects/create", [ProjectController::class, "create"])->name("projects.create");
Route::post("/projects", [ProjectController::class, "store"])->name("projects.store");
Route::get("/projects/{project}", [ProjectController::class, "show"])->name("projects.show");
Route::get("/projects/{project}/edit", [ProjectController::class, "edit"])->name("projects.edit");
Route::patch("/projects/{project}", [ProjectController::class, "update"])->name("projects.update");
Route::delete("/projects/{project}", [ProjectController::class, "destroy"])->name("projects.destroy"); */

Route::resource('portfolio', ProjectController::class)
        ->names("projects")
        ->parameter("portfolio", "project");

Route::patch('portfolio/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
Route::delete('portfolio/{project}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');
        
Route::get("categories/{category}", [CategoryController::class, 'show'])->name("categories.show");

// Route::resource("/portfolio", PortfolioController::class)->name("index", "portfolio");
// Route::resource("/portfolio", PortfolioController::class)->name("index", "portfolio"); // genera todos los métodos. TODO: Investigar que hace exactamente.
// Route::resource("/portfolio", PortfolioController::class)->only("index", "show");
// Route::resource("/portfolio", PortfolioController::class)->except(["destroy", "show"]);
// Route::resource("/portfolio", PortfolioController::class)->only(["index", "show"]);
// Route::apiResource("/portfolio", PortfolioController::class);



// Route::get('/saludo/{nombre}', function($nombre) { return "Saludos $nombre"; });

// Route::get("/contactanos", function() { return "Sección de Contactos"; })->name("contactos");
// Route::get("/servicios", function() { return "Sección de Servicios"; });

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes(["register" => false]); // Same same but disables routes marked with "false"
Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
