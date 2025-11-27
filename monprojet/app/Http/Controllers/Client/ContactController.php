<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){ return view('client.contact'); }

    public function send(Request $request){
        $data = $request->validate([
            'subject'=>'required|string',
            'message'=>'required|string'
        ]);
        // Envoyer email ou stocker en DB
        return back()->with('success','Message envoyé');
    }
}
