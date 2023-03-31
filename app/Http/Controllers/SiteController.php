<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
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

    public function welcome(Request $request) : View
    {
        return view('welcome');
    }

    public function show($id): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $sites = Site::find($id);
        if ($sites->isUser != null) {
            $username = User::findOrFail($sites->idUser);
        }
        else {
            $username = "Anonyme";
        }
        return view('sitedangereux.show', ['site' => $sites, 'username' => $username]);
    }

    public function create(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('sitedangereux.create');
    }

    public function search(Request $request)
    {
        if ($request->filled('search')) {
            $sites = Site::search($request->search)->get()->take(3);
            if (sizeof($sites) < 3) {
                $sites = Site::all();
                $tableau = array();
                $shortest = -1;
                foreach ($sites as $sitetest) {
                    $diff = levenshtein($request->search, $sitetest->adresse_site, 0);

                    if ($diff <= $shortest || $shortest < 0) {
                        array_push($tableau, $sitetest);
                        $shortest = $diff;
                    }
                }
                $tableau = array_reverse($tableau);
                $tableau = array_slice($tableau, 0, 3);
                return view('welcome', compact('tableau'));
            }
            $tableau = $sites;
        } else {
            $tableau = [];
        }

        return view('welcome', compact('tableau'));
    }

    public function preRemplir($nom):View
    {
        return view('sitedangereux.create', ['nom' => $nom]);
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
