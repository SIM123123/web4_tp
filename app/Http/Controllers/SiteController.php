<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
        $sites = Site::all();
        return view('sitedangereux.index' , ['sites' => $sites]);
    }

    public function welcome(Request $request): View
    {
        if ($request->filled('search')) {
            $sites = Site::search($request->search)->get();
        } else {
            $sites = Site::get()->take('3');
        }

        return view('welcome', compact('sites'));
    }

    public function show($id): View
    {
        $sites = Site::find($id);
        return view('sitedangereux.resultat', ['site' => $sites]);
    }

    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
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

    public function store(Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|RedirectResponse|\Illuminate\Routing\Redirector
    {
        $site = new Site();
        $site->adresse_site = $request->adresse;
        $site->description = $request->description;
        $site->save();

        return redirect('/');
    }
}
