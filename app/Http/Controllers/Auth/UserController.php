<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ConnecteMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utilisateurs = User::latest()->paginate(10);
        return view('dashboard.user', compact('utilisateurs'));
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
            'pseudo' => 'required',
            'email' => 'required|email|unique:users',
            'type_user' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);


            $type_user = $request->type_user;
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if ($user) {
                // L'utilisateur existe déjà dans la base de données
                // Gérer l'erreur ou afficher un message d'erreur approprié

                return redirect()->back()->withErrors(['email' => 'Cette adresse e-mail est déjà utilisée.'])->withInput();
            } else {
                // L'utilisateur n'existe pas dans la base de données, vous pouvez le créer
                if ($type_user === "Super Admin") {
                    $user = User::create([
                        'pseudo' => $request->pseudo,
                        'email' => $email,
                        'type_user' => $type_user,
                        'password' => Hash::make($request->password),
                        'role_id' => 1,
                        'lien' => 'http://127.0.0.1:8000/'
                    ]);

                    Mail::to($email)->send(new ConnecteMail($user));
                }

                if ($type_user === "Admin") {
                    $user = User::create([
                        'pseudo' => $request->pseudo,
                        'email' => $email,
                        'type_user' => $type_user,
                        'password' => Hash::make($request->password),
                        'role_id' => 2,
                        'lien' => 'http://127.0.0.1:8000/'
                    ]);
                    Mail::to($email)->send(new ConnecteMail($user));
                }

                if ($type_user === "Simple user") {
                    $user = User::create([
                        'pseudo' => $request->pseudo,
                        'email' => $email,
                        'type_user' => $type_user,
                        'password' => Hash::make($request->password),
                        'role_id' => 3,
                        'lien' => 'http://127.0.0.1:8000/'
                    ]);
                    Mail::to($email)->send(new ConnecteMail($user));
                }

                //  Auth::login($user);
                return redirect()->route('user.index');
            }

        // dd(' '.$type_user);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
