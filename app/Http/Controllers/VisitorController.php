<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $image_name;
    public function index()
    {
        Paginator::useBootstrap();
        $visitors = Visitor::paginate(10);
        return view('mtn.visitors',compact('visitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        //
        $visitor = new Visitor();
        $visitor->user_id = auth()->user()->id;
        $visitor->nom = $request->nom;
        $visitor->prenom = $request->prenom;
        $visitor->telephone= $request->telephone;
        $visitor->num_piece = $request->num_piece;
        $visitor->type_piece = $request->type_piece;
        $visitor->image = $request->file('image')->getClientOriginalName();
        $request->image->storeAs('public/photo/', $visitor->image);
        $visitor->save();
        session()->flash('success', 'visiteur crée avec succés');
        Paginator::useBootstrap();
        $visitors = Visitor::paginate(10);
        return view('mtn.visitors',compact('visitors'));
        //return view('mtn.visitors');
        // dd($request->all());

    }
    public function edit($id)
    {
        $visitors = Visitor::find($id);
        return view('mtn.edit', compact('visitors'));
    }


    public function update(Request $request)
    {
        $visitor = Visitor::find($request->visitor_id);

        $visitor->nom = $request->nom;
        $visitor->prenom = $request->prenom;
        $visitor->telephone= $request->telephone;
        $visitor->num_piece = $request->num_piece;
        $visitor->type_piece = $request->type_piece;
        $visitor->image = $request->file('image')->getClientOriginalName();
        $visitor->update();

        Session()->flash('update', 'Les informations du visiteur "' . $request->nom . '" ont été mise à jour avec succès.');
        return redirect('visiteurs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitors = Visitor::find($id);
        $visitors->delete();
        return redirect('visiteurs');
    }
}
