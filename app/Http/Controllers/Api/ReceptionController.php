<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReceptionController extends Controller
{
    public function index()

    {
        $receptions = DB::select('SELECT visitors.id,nom,prenom,telephone
         FROM receptions,visitors WHERE receptions.id=visitors.id');
        //  $receptions = Reception::all();

        // return $receptions->toJson(JSON_PRETTY_PRINT);
        // return view('mtn.reception', compact('receptions'));
    }
}
