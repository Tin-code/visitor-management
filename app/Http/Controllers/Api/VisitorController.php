<?php

namespace App\Http\Controllers\Api;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reception;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Laravel\Sanctum\Sanctum;

class VisitorController extends Controller


{


    public function __construct()
        {
            $this->middleware(['auth:sanctum']);
        }
    public function index(){
        $visitors = Visitor::all();
     return $visitors->toJson(JSON_PRETTY_PRINT);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'telephone'=>'required',
            'num_piece'=>'required',
            'type_piece'=>'required',
            'image'=>'required',
        ]);
        $verfi_visitor = Visitor::where('num_piece',$request->num_piece)->first();
         if(!$verfi_visitor)
         {
            $visitor = new Visitor();
            $visitor->user_id = auth()->user()->id;
            $visitor->nom = $request->nom;
            $visitor->prenom = $request->prenom;
            $visitor->telephone= $request->telephone;
            $visitor->num_piece = $request->num_piece;
            $visitor->type_piece = $request->type_piece;
            $image_name = $request->image->hashName();
            $request->image->storeAs('public/photo/', $image_name);
            $visitor->image= $image_name;
            $visitor->save();

            //create reception
            $reception = new Reception();
            $reception->user_id = $verfi_visitor->id;
            $reception->visitor_id = Visitor::where('num_piece',$request->num_piece)->first()->id;
            $reception->motif = $request->motif;
            $reception->date_day = date(' Y-m-dH:m');
            $reception->save();

            return json_encode(['message'=>'Visiteur Ajouté avec Success']);

         }else{
            $reception = new Reception();
            $reception->user_id = $verfi_visitor->id;
            $reception->visitor_id = Visitor::where('num_piece',$request->num_piece)->first()->id;
            $reception->motif = $request->motif;
            $reception->date_day = date('Y-m-d H:m');
            $reception->save();
            return json_encode(['message'=>'Visiteur Ajouté ']);
        //     return response()->json([
        //         'danger' =>' le Visiteur existe deja'], 200);
          }

        //  return response()->json([
        //     'success' =>'Visitor crée avec succes'], 200);
        // session()->flash('success', 'visiteur crée avec succés');
        // return view('enregistrer');
        // dd($request->all());

    }
}
