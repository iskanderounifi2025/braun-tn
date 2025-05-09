<?php

namespace App\Http\Controllers;

 use App\Models\User ;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;           
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Password;
 use Illuminate\Support\Facades\Mail;
 use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function createUser()
    {
        return view('dashboard.users');
    }

    /**
     * Ajouter un nouvel utilisateur.
     */
    public function Store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'utype' => 'in:USR,ADM',  
        ]);

        // Vérification des erreurs de validation
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'utype' => $request->utype ?? 'USR', // Défaut à 'USR'
        ]);

        // Redirection après succès
        return redirect()
            ->route('dashboard.users')
            ->with('success', 'Utilisateur ajouté avec succès.');
    }


    public function Index()
    {
        // Récupérer tous les utilisateurs
        $users = User::paginate(10);

        // Passer les utilisateurs à la vue
        return view('dashboard.users', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'utype' => 'required|in:USR,ADM',
        ]);
    
        $user = User::findOrFail($id);
        $user->update($request->all());
    
        return redirect()->route('dashboard.users')->with('success', 'Utilisateur mis à jour avec succès.');
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('dashboard.users')->with('success', 'Utilisateur supprimé avec succès.');
    }
    
     

    //Login 

    public function showLogin()
    {
        return view('dashboard.login'); // Assurez-vous que la vue se trouve dans resources/views/auth/login.blade.php
    }

    // Traiter la connexion
    public function login(Request $request)
{
    // ✅ Étape 1 : Validation stricte des entrées
    $credentials = $request->validate([
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:6', 'max:100'],
    ]);

    // ✅ Étape 2 : Vérification des tentatives (optionnel : rate limiter Laravel)
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate(); // 🔒 Anti-fixation de session

        return redirect()->intended(route('dashboard'))
                         ->with('success', 'Connexion réussie.');
    }

    // ❌ Échec de l'authentification
    throw ValidationException::withMessages([
        'email' => 'Les informations de connexion sont incorrectes.',
    ]);
}



    public function logout(Request $request)
{
    Auth::logout(); // Déconnexion de l'utilisateur

    $request->session()->invalidate(); // Invalider la session
    $request->session()->regenerateToken(); // Régénérer le token CSRF

    return redirect()->route('login')->with('success', 'Déconnexion réussie.');
}
    // Déconnexion
    
    // Afficher le formulaire de réinitialisation de mot de passe
    /*public function showForgotPasswordForm()
    {
        return view('dashboard.login'); // Assurez-vous que cette vue existe
    }
*/
    // Envoyer le lien de réinitialisation de mot de passe
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Lien de réinitialisation envoyé à votre adresse e-mail.');
        }

        return back()->withErrors(['email' => __($status)]);
    }

    
    public function showProfile()
    {
        // Vérifiez si l'utilisateur est authentifié
        if (Auth::check()) {
            // Récupérer les informations de l'utilisateur connecté
            $user = Auth::user();  // Récupère l'utilisateur authentifié

            // Vous pouvez aussi ajouter d'autres informations comme le nombre de messages non lus, etc.
            $user->inbox_count = 27;  // Exemple : nombre de messages non lus (vous pouvez le calculer dynamiquement)

            // Retourner la vue avec les données de l'utilisateur
            return view('dashboard.home', compact('user'));
        }

        // Si l'utilisateur n'est pas authentifié, rediriger vers la page de connexion
        return redirect()->route('login');
    }
    public function showProfileDetail()
    {
        $user = Auth::user(); // Récupère l'utilisateur actuellement authentifié
        return view('dashboard.profile', compact('user')); // Transmet l'utilisateur à la vue
    }
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
    }

    // Mise à jour du mot de passe
    $user->password = Hash::make($request->new_password);
    $user->save();

    // Déconnexion automatique
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Rediriger vers login avec message
    return redirect()->route('login')->with('success', 'Votre mot de passe a été modifié. Veuillez vous reconnecter.');
}


/*Forget  password */

// 1. Affiche le formulaire de demande de lien de réinitialisation
public function showForgotPasswordForm()
{
    return view('dashboard.forgot');
}

// 2. Envoie le lien de réinitialisation à l'e-mail de l'utilisateur
public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
}

// 3. Affiche le formulaire de réinitialisation avec le token
public function showResetForm(Request $request, $token = null)
{
    return view('dashboard.reset', [
        'token' => $token,
        'email' => $request->email
    ]);
}

// 4. Réinitialise le mot de passe de l'utilisateur
public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email|exists:users,email',
        'password' => 'required|confirmed|min:8',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
}





}
 