<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        if ($search) {
            $sites = Site::query()
                ->where('nom_site', 'LIKE', '%'.$search.'%')
                ->paginate(10); 
        } else {
            $sites = Site::latest()->paginate(10);
            $date = $sites->first();
        }
            // $date = $sites->first();
        return view('dashboard.site.site', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.site.site');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reponse = $request->validate([
            'nom_site' => 'required|string',
            'local_latitude' => 'required',
            'local_longitude' => 'required'
        ]);
        

        $nom_site = $request->nom_site;
        $site = Site::where('nom_site', $nom_site)->first();
        if ($site) {
                // L'utilisateur existe déjà dans la base de données
                // Gérer l'erreur ou afficher un message d'erreur approprié

                return redirect()->back()->withErrors(['nom_site' => 'Ce site existe déjà.'])->withInput();
        } else {
            $site = Site::create([
                'nom_site' => $nom_site,
                'local_latitude_site' => $request->local_latitude,
                'local_longitude_site' => $request->local_longitude
            ]);
            return redirect()->route('site.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $site = Site::findOrFail($id);
        // dd($produit);
        return view('dashboard.site.action', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $site = Site::findOrFail($id);

        $site->nom_site = $request->nom_site;
        $site->local_latitude_site = $request->local_latitude;
        $site->local_longitude_site = $request->local_longitude;

        $site->update();

        return redirect()->route('site.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $site = Site::findOrFail($id);

        $site->delete();

        return redirect()->back();
    }
}
