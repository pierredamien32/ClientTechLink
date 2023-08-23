<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ConnecteMail;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        if ($search) {
            $utilisateurs = User::query()
                ->where('pseudo', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->paginate(10); 
        } else {

            $utilisateurs = User::latest()->paginate(10);
            $date = $utilisateurs->first();
        }
            $date = $utilisateurs->first();
        return view('dashboard.user.user', compact('utilisateurs', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createFormLogin(){
        return view('login');
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

                    // Mail::to($email)->send(new ConnecteMail($user));
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
                    // Mail::to($email)->send(new ConnecteMail($user));
                }

                if ($type_user === "Simple Utilisateur") {
                    $user = User::create([
                        'pseudo' => $request->pseudo,
                        'email' => $email,
                        'type_user' => $type_user,
                        'password' => Hash::make($request->password),
                        'role_id' => 3,
                        'lien' => 'http://127.0.0.1:8000/'
                    ]);
                    // Mail::to($email)->send(new ConnecteMail($user));
                }

                //  Auth::login($user);
                return redirect()->route('user.index');
            }

        // dd(' '.$type_user);
    }

    public function loginUsers(Request $request)
    {
        
        $request->session()->flush();
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // dd('je suis là');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $verifiUser = User::where('id', $user->id)->first();
            // dd('ok '.$verifiUser);

            session(['pseudo' => $verifiUser->pseudo,
                    'type_user' => $verifiUser->type_user,
            ]);
            Session::put('user_pseudo', $verifiUser->pseudo);
            Session::put('user_type_user', $verifiUser->type_user);
            Auth::loginUsingId($user->id);
            if(Auth::user()->role->id == 1){
                return redirect()->route('user.index');
            }else{
                return redirect()->route('client.index');
            }
            
        }

        return back()->withErrors([
            'erreur' => 'Identifiants incorrects.',
        ])->onlyInput('erreur');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flush();

        return redirect()->route('createFormLogin');
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
        $user = User::findOrFail($id);
        // dd($produit);
        return view('dashboard.user.action', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $user = User::findOrFail($id);

        $user->pseudo = $request->pseudo;

        if($user->email != $request->email){
            $user->email = $request->email;
            //Mail::to($user->email)->send(new ConnecteMail($user));
        }

        $user->type_user = $request->type_user;


        $user->update();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back();
    }
}
