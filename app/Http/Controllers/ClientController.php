<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientModifier;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;


        $clientParticulier = Client::where('type_client', '=', 'Particulier')
            ->count();
        $date_maj_particulier = Client::where('type_client', '=', 'Particulier')
            ->latest('updated_at')
            ->value('updated_at');


        $clientEntreprise = Client::where('type_client', '=', 'Entreprise')
            ->count();
        $date_maj_entreprise = Client::where('type_client', '=', 'Entreprise')
            ->latest('updated_at')
            ->value('updated_at');


        if ($search) {
            $clients = Client::query()
                ->where('nom', 'LIKE', '%' . $search . '%')
                ->orWhere('prenom', 'LIKE', '%' . $search . '%')
                ->orWhere('denomination', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {

            $clients = Client::latest()->paginate(10);
            $date = $clients->first();

            $clientParticulier = Client::where('type_client', '=', 'Particulier')
                ->count();
            $date_maj_particulier = Client::where('type_client', '=', 'Particulier')
                ->latest('updated_at')
                ->value('updated_at');


            $clientEntreprise = Client::where('type_client', '=', 'Entreprise')
                ->count();
            $date_maj_entreprise = Client::where('type_client', '=', 'Entreprise')
                ->latest('updated_at')
                ->value('updated_at');
        }
        $date = $clients->first();
        return view('dashboard.client.client', compact('clients', 'date', 'clientParticulier', 'clientEntreprise', 'date_maj_particulier', 'date_maj_entreprise'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function FormParticulier(Request $request)
    {
        $reponse = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'code_anyx' => 'required',
            'code_befra' => 'required'
        ]);


        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'denomination' => '--------',
            'type_client' => 'Particulier',
            'code_anyx' => $request->code_anyx,
            'code_befra' => $request->code_befra,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('client.index');
    }

    public function FormEntreprise(Request $request)
    {
        $reponse = $request->validate([
            'denomination' => 'required|string',
            'code_anyx' => 'required',
            'code_befra' => 'required'
        ]);


        $client = Client::create([
            'nom' => '--------',
            'prenom' => '--------',
            'denomination' => $request->denomination,
            'type_client' => 'Entreprise',
            'code_anyx' => $request->code_anyx,
            'code_befra' => $request->code_befra,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('client.index');
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
        $client = Client::findOrFail($id);
        // dd($produit);
        return view('dashboard.client.action', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = client::findOrFail($id);
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->denomination = $request->denomination;
        $client->type_client = $request->type_client;
        $client->code_anyx = $request->code_anyx;
        $client->code_befra = $request->code_befra;
        $client->update();

        $user = ClientModifier::create([
            'user_id' => auth()->user()->id,
            'client_id' => $client->id
        ]);

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);

        if ($client->emplacements != null) {
            foreach ($client->emplacements as $emplacement) {
                $emplacement->delete();
            }
        }

        $client->delete();

        return redirect()->back();
    }
}
