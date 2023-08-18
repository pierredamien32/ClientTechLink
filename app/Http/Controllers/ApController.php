<?php

namespace App\Http\Controllers;

use App\Models\Ap;
use App\Models\Site;
use Illuminate\Http\Request;

class ApController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        if ($search) {
            $aps = Ap::query()
                ->where('nom_ap', 'LIKE', '%'.$search.'%')
                ->paginate(10); 
        } else {
            $aps = Ap::latest()->paginate(10);
            // $date = $sites->first();
        }
        $sites = Site::all();
            // $date = $sites->first();
        return view('dashboard.ap.ap', compact('aps','sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reponse = $request->validate([
            'nom_ap' => 'required|string'
        ]);

        // dd('Id = '.$request->nom_site);
        $nom_site = $request->nom_site; 

        $site_id = Site::where('sites.nom_site', $nom_site)
               ->get('sites.id');

        // dd('ok '.$site_id[0]->id);

        $nom_ap = $request->nom_ap;
        $ap = Ap::where('nom_ap', $nom_ap)->first();
        if ($ap) {
                // L'utilisateur existe déjà dans la base de données
                // Gérer l'erreur ou afficher un message d'erreur approprié

                return redirect()->back()->withErrors(['nom_ap' => 'Cet ap existe déjà.'])->withInput();
        } else {
            $ap = Ap::create([
                'nom_ap' => $nom_ap,
                'site_id' => $site_id[0]->id
            ]);
            return redirect()->route('ap.index');
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
        $ap = Ap::findOrFail($id);
        // dd($produit);
        return view('dashboard.ap.action', compact('ap'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ap = Ap::findOrFail($id);

        $ap->nom_ap = $request->nom_ap;

        $site_id = Site::where('sites.nom_site', $request->nom_site)
               ->get('sites.id');

        $ap->site_id = $site_id[0]->id;

        $ap->update();

        return redirect()->route('ap.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ap = Ap::findOrFail($id);

        $ap->delete();

        return redirect()->back();
    }
}
