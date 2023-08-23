<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Emplacement;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule;

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
                ->where('nom_emplacement', 'LIKE', '%' . $search . '%')
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
        $request->validate([
            'nom_emplacement' => 'required|string',
            'local_latitude' => 'required|numeric',
            'local_longitude' => 'required|numeric'
        ]);

        $client_id = null;

        if ($request->denomination) {
            $client_id = Client::where('denomination', $request->denomination)->value('id');
        } elseif ($request->nom_client) {
            $client_id = Client::where('nom', $request->nom_client)->value('id');
        }

        if ($client_id !== null) {
            $validator_latitude = FacadesValidator::make(
                ['local_latitude' => $request->local_latitude],
                ['local_latitude' => 'required|numeric']
            );

            $validator_longitude = FacadesValidator::make(
                ['local_longitude' => $request->local_longitude],
                ['local_longitude' => 'required|numeric']
            );

            if ($validator_latitude->fails()) {
                return redirect()->back()->withErrors([
                    'local_latitude' => 'La valeur de latitude n\'est pas valide.'
                ])->withInput();
            }

            if ($validator_longitude->fails()) {
                return redirect()->back()->withErrors([
                    'local_longitude' => 'La valeur de longitude n\'est pas valide.'
                ])->withInput();
            }

            $existingEmplacement = Emplacement::where('client_id', $client_id)->first();

            if ($existingEmplacement) {
                return redirect()->back()->withErrors([
                    'nom_client' => 'Cette entreprise ou ce particulier a déjà un emplacement.'
                ])->withInput();
            }

            Emplacement::create([
                'nom_emplacement' => $request->nom_emplacement,
                'local_latitude' => $request->local_latitude,
                'local_longitude' => $request->local_longitude,
                'client_id' => $client_id
            ]);

            return redirect()->route('emplacement.index');
        }

        return redirect()->back()->withErrors([
            'nom_client' => 'L\'entreprise ou le particulier n\'existe pas.'
        ])->withInput();
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

        if ($request->denomination) {
            $client_entreprise_id = Client::where('clients.denomination', $request->denomination)
                ->get('clients.id');


            $emplacement->client_id = $client_entreprise_id[0]->id;
        } else if ($request->nom_client) {
            $client_particulier_id = Client::where('clients.nom', $request->nom_client)
                ->get('clients.id');

            $emplacement->client_id = $client_particulier_id[0]->id;
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
