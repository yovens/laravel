<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LoanCart;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Commencer une location
    public function start(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        // Durée : si non fournie, 5 jours par défaut
        $duration = $request->input('duration', 5);

        // Calcul du montant total
        $total = $vehicle->loan_price * $duration;

        LoanCart::create([
            'user_id'       => Auth::id(),
            'vehicle_id'    => $vehicle->id,
            'status'        => 'En cours',
            'duration_days' => $duration,
            'total_amount'  => $total,
        ]);

        return redirect()->route('client.loan')
                         ->with('success', "Location démarrée pour $duration jour(s), Total : $total HTG");
    }

    // Afficher les locations de l'utilisateur
    public function index()
    {
        $loans = LoanCart::where('user_id', Auth::id())
                         ->with('vehicle')
                         ->get();

        return view('client.loan', compact('loans'));
    }
    public function transactions()
{
    $transactions = \App\Models\Transaction::where('user_id', auth()->id())
        ->with('vehicle')
        ->get();

    return view('client.transactions', compact('transactions'));
}

}
