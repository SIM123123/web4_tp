<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
        $sites = Site::all();
        return view('sitedangereux.index',['sites' => $sites]);
    }

    public function welcome(Request $request): View
    {
        $sites = Site::all();
        if ($request->filled('search')) {
            $tableau = array();
            $shortest = -1;
                foreach ($sites as $sitetest) {
                    $diff = levenshtein($request->search, $sitetest->adresse_site,0);

                    if ($diff <= $shortest || $shortest < 0) {
                        array_push($tableau, $sitetest);
                        $shortest = $diff;
                    }
                }
        } else {
            $tableau = [];
        }
        $tableau = array_reverse($tableau);
        $tableau = array_slice($tableau,0,3);

        return view('welcome',compact('tableau'));
    }

    public function show($id): View
    {
        $sites = Site::find($id);
        return view('sitedangereux.resultat', ['site' => $sites]);
    }

    public function create(): View
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
}
