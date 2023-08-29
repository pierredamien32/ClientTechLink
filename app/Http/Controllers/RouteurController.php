<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Routeur;
use Illuminate\Http\Request;

class RouteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $routeurs = Routeur::query()
                ->where('nom_routeur', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $routeurs = Routeur::latest()->paginate(10);
            // $date = $radios->first();
        }

        $client_maisons = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
            ->where('nom_emplacement', '=', 'Maison')
            ->get(['clients.nom', 'clients.denomination']);


        $client_bureaux = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
            ->where('nom_emplacement', '=', 'Bureau')
            ->get(['clients.nom', 'clients.denomination']);
        // $clients = Client::all();

        // $date = $radios->first();
        return view('dashboard.routeur.routeur', compact('routeurs', 'client_maisons', 'client_bureaux'));
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
            'nom_routeur' => 'required|string',
            'adresse_routeur' => 'required|string|max:15',
            'marque' => 'required',
            'modele' => 'required',
            'passerelle' => 'required|string|max:15',
            'masque' => 'required|string|max:15'
        ]);

        $nom_routeur = $request->nom_routeur;
        $routeur = Routeur::where('nom_routeur', $nom_routeur)->first();

        if ($routeur) {
            // L'utilisateur existe déjà dans la base de données
            // Gérer l'erreur ou afficher un message d'erreur approprié

            return redirect()->back()->withErrors(['nom_routeur' => 'Ce routeur existe déjà.'])->withInput();
        } else {

            if ($request->denomination) {

                $emplacement_denomination_id = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
                    ->where('denomination', '=', $request->denomination)
                    ->get('emplacements.id');
                $routeur_denomination = Routeur::where('emplacement_id', $emplacement_denomination_id[0]->id)->first();

                // dd('Ok '.$emplacement_denomination_id);
                if ($routeur_denomination) {
                    // L'utilisateur existe déjà dans la base de données
                    // Gérer l'erreur ou afficher un message d'erreur approprié

                    return redirect()->back()->withErrors(['denomination' => 'Cet entreprise a déjà un routeur.'])->withInput();
                } else {
                    $routeur = Routeur::create([
                        'nom_routeur' => $nom_routeur,
                        'adresse_routeur' => $request->adresse_routeur,
                        'marque' => $request->marque,
                        'modele' => $request->modele,
                        'passerelle_routeur' => $request->passerelle,
                        'masque_routeur' => $request->masque,
                        'emplacement_id' => $emplacement_denomination_id[0]->id,
                    ]);
                    return redirect()->route('routeur.index');
                }
            }

            if ($request->nom_client) {

                $emplacement_nom_id = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
                    ->where('nom', '=', $request->nom_client)
                    ->get('emplacements.id');

                $routeur_nom = Routeur::where('emplacement_id', $emplacement_nom_id[0]->id)->first();

                // dd('Ok '.$emplacement_nom_id);
                if ($routeur_nom) {
                    // L'utilisateur existe déjà dans la base de données
                    // Gérer l'erreur ou afficher un message d'erreur approprié

                    return redirect()->back()->withErrors(['nom_client' => 'Ce particulier a déjà un routeur.'])->withInput();
                } else {

                    $routeur = Routeur::create([
                        'nom_routeur' => $nom_routeur,
                        'adresse_routeur' => $request->adresse_routeur,
                        'marque' => $request->marque,
                        'modele' => $request->modele,
                        'passerelle_routeur' => $request->passerelle,
                        'masque_routeur' => $request->masque,
                        'emplacement_id' => $emplacement_nom_id[0]->id,
                    ]);
                    return redirect()->route('routeur.index');
                }
            }
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
        $routeur = Routeur::findOrFail($id);
        // dd($produit);
        return view('dashboard.routeur.action', compact('routeur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $routeur = Routeur::findOrFail($id);

        // dd($request->nom_ap);

        if ($request->denomination) {

            $emplacement_denomination_id = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
                ->where('denomination', '=', $request->denomination)
                ->get('emplacements.id');

            // dd('Ok '.$emplacement_denomination_id);

            // dd('je suis denomination');
            $routeur->nom_routeur = $request->nom_routeur;
            $routeur->adresse_routeur = $request->adresse_routeur;
            $routeur->marque = $request->marque;
            $routeur->modele = $request->modele;
            $routeur->passerelle_routeur = $request->passerelle;
            $routeur->masque_routeur = $request->masque;
            $routeur->emplacement_id = $emplacement_denomination_id[0]->id;
            $routeur->update();
            return redirect()->route('routeur.index');
        }

        if ($request->nom_client) {

            $emplacement_nom_id = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
                ->where('nom', '=', $request->nom_client)
                ->get('emplacements.id');

            // dd('Ok '.$emplacement_nom_id);

            $routeur->nom_routeur = $request->nom_routeur;
            $routeur->adresse_routeur = $request->adresse_routeur;
            $routeur->marque = $request->marque;
            $routeur->modele = $request->modele;
            $routeur->passerelle_routeur = $request->passerelle;
            $routeur->masque_routeur = $request->masque;
            $routeur->emplacement_id = $emplacement_nom_id[0]->id;
            $routeur->update();
            // dd('je suis là');
            return redirect()->route('routeur.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $routeur = Routeur::findOrFail($id);

        $routeur->delete();

        return redirect()->back();
    }
}
