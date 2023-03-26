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
        return view('sitedangereux.index' , ['sites' => $sites]);
    }

    public function show($id): View
    {
        $sites = Site::find($id);
        return view('sitedangereux.resultat', ['site' => $sites]);
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
