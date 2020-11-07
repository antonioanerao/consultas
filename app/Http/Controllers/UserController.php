<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user) {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function dashboard() {
        return view('dashboard');
    }
}
