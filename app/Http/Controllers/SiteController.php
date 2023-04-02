<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
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
use Illuminate\Support\Facades\Storage;
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
        $site = Site::find($id);
        if ($site->idUser != null) {
            $username = User::find($site->idUser)->name;
        }
        else {
            $username = "Anonyme";
        }

        $votes = Vote::where('idSite', $id)->count();
        $commentaires = Commentaire::where('idSite', $id)
                                ->orderByDesc('created_at')
                                ->get();

        $voteUser = \App\Models\Vote::where('idSite', $site->id)
            ->where('idUser', \Illuminate\Support\Facades\Auth::id())
            ->get();


        return view('sitedangereux.show', ['site' => $site,
            'username' => $username,
            'votes' => $votes,
            'voteUser' => $voteUser,
            'commentaires' => $commentaires]);
    }

    public function create(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('sitedangereux.create');
    }

    public function search(Request $request)
    {
        if ($request->filled('search')) {
                $sites = Site::all();
                $tableau = array();
                $shortest = -1;
                foreach ($sites as $site) {
                    $diff = levenshtein(strtolower($request->search),
                        strtolower(preg_filter("/[.].*/i", "",$site->adresse_site)), 0);

                    if ($diff <= $shortest || $shortest < 0) {
                        $tableau[] = $site;
                        $shortest = $diff;
                    }
                    if($request->search == $site->adresse_site){
                        $tableau = [];
                        $tableau[] = $site;
                        return view('welcome', compact('tableau'));
                    }
                }
                $tableau = array_reverse($tableau);
                $tableau = array_slice($tableau, 0, 3);
                return view('welcome', compact('tableau'));
        } else {
            $tableau = [];
        }

        return view('welcome', compact('tableau'));
    }

    public function preRemplir($nom): Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('sitedangereux.create', ['nom' => $nom]);
    }

    public function store(Request $request) : RedirectResponse
    {

        $attribute = $request->validate([
            'adresse_site' => 'required|url',
            'description' => 'required'
        ]);

        $site = new Site($attribute);
        $this->recupererDonnees($site, $request);

        try {
            $site->save();
        } catch (\Illuminate\Database\QueryException $e) {
            if($e->errorInfo[1] == 1062){
                return \redirect('/sitedangereux/create');
            }
        }

        if (Auth::check()) {
            $site->idUser = Auth::id();
            $this->voterAuto($site);
        }

        return redirect()->route('show', ['id' => $site->id]);
    }

    public function destroy($id) {
        $site = Site::findOrFail($id);

        if(Storage::exists('/public/image/'.$site->image)){
            Storage::delete('/public/image/'.$site->image);
        }

        $site->delete();

        return redirect()->route('lister')->with('success', 'Site supprimé!');
    }

    public function lister(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $sites = Site::where('idUser', Auth::id())->get();
        $listeSites = array();
        foreach ($sites as $site) {
            $votes = Vote::where('idSite', $site->id )->count();
            $listeSites[] = ["IdSite" => $site->id, "Adresse" => $site->adresse_site, "Votes" => $votes];
        }

        return view('sitedangereux.sites' , ['sites' => $listeSites]);
    }

    private function recupererDonnees($site, $request) {
        $site->adresse_site = $request->adresse_site;
        $site->description = $request->description;
        $image = $request->file('image');

        if($image != null) {
            $fichier = $image->getClientOriginalName();
            $location = storage_path('/app/public/image');
            $image->move($location, $fichier);
            $site->image = $fichier;
        }
    }
    private function voterAuto($site) {
        $vote = new Vote();
        $vote->idUser = Auth::id();
        $vote->idSite = $site->id;
        $vote->save();
    }

    public function commenter(Request $request) {
        $site = Site::find($request->route('id'));


        $idUser = Auth::id();

        Commentaire::create([
            'idSite' => $site->id,
            'idUser' => $idUser,
            'commentaire' => $request->get('commentaire')]);

        return redirect()->route('show', ['id' => $site->id]);
    }

    public function voter(Request $request) {
        $site = Site::find($request->route('id'));

        $idUser = Auth::id();

        Vote::create([
            'idSite' => $site->id,
            'idUser' => $idUser]);

        return redirect()->route('show', ['id' => $site->id]);
    }
}
