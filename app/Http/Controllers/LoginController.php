<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('login');
  }

  public function store(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ], [
      'email.required' => 'Esse campo de email é obrigatório',
      'email.email' => 'Esse campo tem que ter um email válido',
      'password.required' => 'Esse campo password é obrigatório',
      // 'password.min' => 'Esse campo tem que ter no mínimo :min caracteres'
    ]);

    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
      return redirect()->route('login.index')->withErrors(['error' => 'Email or password invalid']);
    }

    if (!password_verify($request->input('password'), $user->password)) {
      return redirect()->route('login.index')->withErrors(['error' => 'Email or password invalid']);
    }

    Auth::loginUsingId($user->id);

    return redirect()->route('login.index')->with('success', 'Logged in');

    // var_dump($user);
    // die();

    // $credentials = $request->only('email', 'password');
    // $authenticated = Auth::attempt($credentials);

    // if (!$authenticated) {
    //   return redirect()->route('login.index')->withErrors(['error' => 'Email or password invalid']);
    // }

    // return redirect()->route('login.index')->with('success', 'Logged in');
  }

  public function destroy()
  {
    Auth::logout();

    return redirect()->route('login.index');
  }
}
