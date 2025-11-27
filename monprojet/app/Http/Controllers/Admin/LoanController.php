<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\LoanCart;
use Illuminate\Http\Request;
class LoanController extends Controller
{
    public function index() {
        $loans = LoanCart::with('user','vehicle')->get();
        return view('admin.loans.index', compact('loans'));
    }

    public function destroy(LoanCart $loan){
        $loan->delete();
        return back()->with('success','Location supprimée');
    }

        // Empêche l’erreur RouteNotFoundException
    public function store(Request $request)
    {
        abort(404); // ou redirect()->back() selon ton choix
    }
}
