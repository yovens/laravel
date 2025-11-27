<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Transaction;
use App\Models\LoanCart;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user(); // récupère l'admin connecté

        // 🔥 Récupère le nom sans bug (si nom existe sinon fallback sur name)
        $adminName = $admin->nom ?? $admin->name ?? 'Administrateur';

        $usersCount        = User::count();
        $vehiclesCount     = Vehicle::count();
        $transactionsCount = Transaction::count();
        $loansCount        = LoanCart::count();

        return view('admin.dashboard', compact(
            'adminName',
            'usersCount',
            'vehiclesCount',
            'transactionsCount',
            'loansCount'
        ));
    }
}
