<?php

namespace App\Http\Controllers;

use App\AccountManager;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request, AccountManager $account)
    {
        $email = $request->email;
        $password = $request->password;
        $sql = $account->where('email_address', $email)->where('password', $password);
        if ($sql->get()->count() < 1) {
            return back()->withError('Invalid information supplied')->withInput();
        }
        $userInfo = (object) $sql->first();
        session(['user_account' => $userInfo]);
        return redirect(route('account_dashboard'));
    }
}
