<?php

namespace App\Http\Controllers;

use App\Models\Ap;
use App\Models\Client;
use App\Models\Radio;
use Illuminate\Http\Request;

class RadioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $radios = Radio::query()
                ->where('nom_radio', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $radios = Radio::latest()->paginate(10);
            // $date = $radios->first();
        }

        $aps = Ap::all();

        $client_maisons = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
            ->where('nom_emplacement', '=', 'Maison')
            ->get(['clients.nom', 'clients.denomination']);


        $client_bureaux = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
            ->where('nom_emplacement', '=', 'Bureau')
            ->get(['clients.nom', 'clients.denomination']);
        // $clients = Client::all();

        // $date = $radios->first();
        return view('dashboard.radio.radio', compact('radios', 'aps', 'client_maisons', 'client_bureaux'));
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
            'nom_radio' => 'required|string',
            'adresse_radio' => 'required|string|max:15',
            'signal' => 'required',
            'passerelle' => 'required|string|max:15',
            'masque' => 'required|string|max:15',
            'nom_ap' => 'required',
            'status' => 'required'
        ]);

        // dd($request->nom_ap);

        $nom_radio = $request->nom_radio;
        $radio = Radio::where('nom_radio', $nom_radio)->first();
        if ($radio) {
            // L'utilisateur existe déjà dans la base de données
            // Gérer l'erreur ou afficher un message d'erreur approprié

            return redirect()->back()->withErrors(['nom_radio' => 'Cette radio existe déjà.'])->withInput();
        } else {

            if ($request->denomination) {

                $ap_id = Ap::where('aps.nom_ap', $request->nom_ap)
                    ->get('aps.id');

                $emplacement_denomination_id = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
                    ->where('denomination', '=', $request->denomination)
                    ->get('emplacements.id');

                // dd('Ok '.$emplacement_denomination_id);

                $radio = Radio::create([
                    'nom_radio' => $nom_radio,
                    'adresse_radio' => $request->adresse_radio,
                    'signal' => $request->signal,
                    'passerelle' => $request->passerelle,
                    'masque' => $request->masque,
                    'ap_id' => $ap_id[0]->id,
                    'emplacement_id' => $emplacement_denomination_id[0]->id,
                    'status' => $request->status
                ]);
                return redirect()->route('radio.index');
            }

            if ($request->nom_client) {
                $ap_id = Ap::where('aps.nom_ap', $request->nom_ap)
                    ->get('aps.id');

                $emplacement_nom_id = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
                    ->where('nom', '=', $request->nom_client)
                    ->get('emplacements.id');

                // dd('Ok '.$emplacement_nom_id);

                $radio = Radio::create([
                    'nom_radio' => $nom_radio,
                    'adresse_radio' => $request->adresse_radio,
                    'signal' => $request->signal,
                    'passerelle' => $request->passerelle,
                    'masque' => $request->masque,
                    'ap_id' => $ap_id[0]->id,
                    'emplacement_id' => $emplacement_nom_id[0]->id,
                    'status' => $request->status
                ]);
                return redirect()->route('radio.index');
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
        $radio = Radio::findOrFail($id);
        // dd($produit);
        return view('dashboard.radio.action', compact('radio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $reponse = $request->validate([
        //     'nom_radio' => 'required|string',
        //     'adresse_radio' => 'required',
        //     'signal' => 'required',
        //     'passerelle' => 'required',
        //     'masque' => 'required',
        //     'nom_ap' => 'required',
        //     'status' => 'required'
        // ]);
        $radio = Radio::findOrFail($id);

    //    dd('Ok '.$request->nom_radio);
    //    dd('Ok '.$request->adresse_radio);
    //    dd('Ok '.$request->signal);
    //    dd('Ok '.$request->passerelle);
    //    dd('Ok '.$request->masque);
    //    dd('Ok '.$request->ap_nom);
    //    dd('Ok '.$request->denomination);
    //    dd('Ok '.$request->nom_client);

        if ($request->denomination) {
             
            $ap_id = Ap::where('aps.nom_ap', $request->ap_nom)
                ->get('aps.id');

            $emplacement_denomination_id = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
                ->where('denomination', '=', $request->denomination)
                ->get('emplacements.id');

            $radio->nom_radio = $request->nom_radio;
            $radio->adresse_radio = $request->adresse_radio;
            $radio->signal = $request->signal;
            $radio->passerelle = $request->passerelle;
            $radio->masque = $request->masque;
            $radio->ap_id = $ap_id[0]->id;
            $radio->emplacement_id = $emplacement_denomination_id[0]->id;
            $radio->status = $request->status;
            $radio->update();

            return redirect()->route('radio.index');
        }

        if ($request->nom_client) {
            
            $ap_id = Ap::where('aps.nom_ap', $request->ap_nom)
                ->get('aps.id');

            $emplacement_nom_id = Client::join('emplacements', 'clients.id', '=', 'emplacements.client_id')
                ->where('nom', '=', $request->nom_client)
                ->get('emplacements.id');

            // dd('Ok '.$emplacement_nom_id);
            
            $radio->nom_radio = $request->nom_radio;
            $radio->adresse_radio = $request->adresse_radio;
            $radio->signal = $request->signal;
            $radio->passerelle = $request->passerelle;
            $radio->masque = $request->masque;
            $radio->ap_id = $ap_id[0]->id;
            $radio->emplacement_id = $emplacement_nom_id[0]->id;
            $radio->status = $request->status;
            $radio->update();

            return redirect()->route('radio.index');
        }

            return redirect()->route('radio.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $radio = Radio::findOrFail($id);

        $radio->delete();

        return redirect()->back();
    }
}
