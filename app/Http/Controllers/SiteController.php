<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Vote;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\UploadedFile;

class SiteController extends Controller
{
    public function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $sites = Site::all();
        return view('sitedangereux.index' , ['sites' => $sites]);
    }

    public function welcome(Request $request): Application|Factory|View|\Illuminate\Foundation\Application
    {
        if ($request->filled('search')) {
            $sites = Site::search($request->search)->get();
        } else {
            $sites = Site::get()->take('3');
        }

        return view('welcome', compact('sites'));
    }

    public function show($id): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $sites = Site::find($id);
        return view('sitedangereux.resultat', ['site' => $sites]);
    }

    public function create(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('sitedangereux.create');
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $site = Site::search($search)->get();

        // Return the search view with the resluts compacted
        return view('welcome', compact('site'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $site = new Site();
        $this->validate($request, [
            'adresse' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:max_width=1024,max_height=1024'
        ]);
        $site->adresse_site = $request->adresse;
        $site->description = $request->description;
        $image = $request->file('image');
        if($image != null) {
            $fichier = $image->getClientOriginalExtension();
            $location = storage_path('/app/image/');
            $image->move($location, $fichier);

            $site->image = $location;
        }
        try {
            $site->save();
        } catch (\Illuminate\Database\QueryException $e) {
            if($e->errorInfo[1] == 1062){
                return \redirect('/sitedangereux/create');
            }
        }

        if (Auth::check()) {
            $vote = new Vote();
            $vote->idUser = Auth::id();
            $vote->idSite = $site->id;
            $vote->save();
        }
        return redirect('/');
    }
}
