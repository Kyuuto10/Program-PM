<?php
  
namespace App\Http\Controllers;
 
use App\Models\Project;
use Illuminate\Http\Request;
  
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $projects = Project::all();
        return view('home.welcome',compact('projects'));
    } 

    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('home.welcome');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */    
}