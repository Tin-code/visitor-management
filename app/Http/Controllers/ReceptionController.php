<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();
        // $receptions = DB::select('SELECT receptions.id as rec_id ,motif,date_day,date_coming
        //  FROM receptions,users,visitors WHERE  receptions.user_id=users.id AND  receptions.visitor_id=visitors.id');
        //  dd($receptions);
        
        //$receptions = Reception::paginate(10);
        $receptions = DB::select('SELECT visitors.prenom as visitor_prenom, visitors.nom as visitor_name,users.name  as user_name, users.prenom as user_prenom, receptions.motif,receptions.date_day,receptions.date_coming FROM receptions,visitors,users WHERE receptions.user_id=users.id AND receptions.visitor_id=visitors.id');
        //dd($rep);
        //return view('mtn.reception', compact('receptions'));
        return view('mtn.reception', ["receptions"=>$receptions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'motif'=>'required',

        // ]);

    //     if(Auth::id() != null)
    // //     {
    // //    $reception= Reception::select('id','user_id','visitor_id','date_day','date_coming','departure_date')
    //                        ->where('user_id',Auth::id())
    //                        ->where('visitor',Visitor::id)
    //                     //    ->where('date_day',date('Y-m-d'))
    //                        ->first();
    //     if($reception === null)
    //     {
    //         // Create new day appointment
    //         $newReception = new Reception();
    //         $newReception->user_id = Auth::id();
    //         $newReception->visitor_id = Auth::id();
    //         // $newReception->date_day = date('Y-m-d');
    //         $newReception->date_coming = date('H:i:s');
    //         $newReception->save();
    //         session()->flash('success', 'modifier  avec succés');
    //         session()->flash('success', 'Pointage du matin effectuer avec succès');
    //         // return redirect('emargement');
    //         with('date_coming','Pointage du matin effectuer avec succès !');
    //     }elseif($reception->date_coming !==null && $reception->departure_date !== null)
    //     {
    //         session()->flash('success', 'Vous avez déjà pointer 2 fois au cour de cette journnée !');
    //         return redirect('emargement');

    //     }else
    //     {
    //        $updateReception = Emerge::find($reception->id);
    //        $updateReception->departure_date = date('H:i:s');
    //        $updateReception->save();
    //        session()->flash('success','Pointage du soir effectuer avec succès !');
    //        return redirect('emargement');
    //     }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show(Reception $reception)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function edit(Reception $reception)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reception $reception)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reception $reception)
    {
        //
    }
}
