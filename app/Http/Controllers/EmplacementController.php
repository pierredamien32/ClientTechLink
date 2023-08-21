<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Emplacement;
use Illuminate\Http\Request;

class EmplacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        if ($search) {
            $emplacements = Emplacement::query()
                ->where('nom_emplacement', 'LIKE', '%'.$search.'%')
                ->paginate(10); 
        } else {
            $emplacements = Emplacement::latest()->paginate(10);
            // $date = $emplacements->first();
        }
        $clients = Client::all();
            // $date = $emplacements->first();
        return view('dashboard.emplacement.emplacement', compact('emplacements', 'clients'));
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
            'nom_emplacement' => 'required|string',
            'local_latitude' => 'required',
            'local_longitude' => 'required'
        ]);


        if($request->denomination){
            $client_entreprise_id = Client::where('clients.denomination', $request->denomination)
               ->get('clients.id');

               $emplacement = Emplacement::create([
                    'nom_emplacement' => $request->nom_emplacement,
                    'local_latitude' => $request->local_latitude,
                    'local_longitude' => $request->local_longitude,
                    'client_id' => $client_entreprise_id[0]->id
                ]);
            return redirect()->route('emplacement.index');
        }

        if($request->nom_client){
            $client_particulier_id = Client::where('clients.nom', $request->nom_client)
               ->get('clients.id');

               $emplacement = Emplacement::create([
                    'nom_emplacement' => $request->nom_emplacement,
                    'local_latitude' => $request->local_latitude,
                    'local_longitude' => $request->local_longitude,
                    'client_id' => $client_particulier_id[0]->id
                ]);
            return redirect()->route('emplacement.index');
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
        $emplacement = Emplacement::findOrFail($id);
        // dd($produit);
        return view('dashboard.emplacement.action', compact('emplacement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $emplacement = Emplacement::findOrFail($id);

        $emplacement->nom_emplacement = $request->nom_emplacement;
        $emplacement->local_latitude = $request->local_latitude;
        $emplacement->local_longitude = $request->local_longitude;
        
        if ($emplacement->client->nom == "--------") {

            $emplacement->client_id = $emplacement->client->id;
        }else{

            $emplacement->client_id = $emplacement->client->id;
        }

        $emplacement->update();

        return redirect()->route('emplacement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emplacement = Emplacement::findOrFail($id);

       
        $emplacement->delete();

        return redirect()->back();
    }
}
