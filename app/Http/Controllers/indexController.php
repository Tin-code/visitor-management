<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;


class indexController extends Controller
{
    public function index(Request $request)
    {
        // $date_dujour =  new DateTime(now());
        // $djour_debut = $date_dujour->format('Y-m-j');
        // $djour_fin = $djour_debut;
        // if ($request->input('debut_date')) {
        //     $djour_debut = $request->input('debut_date');
        // }

        // if ($request->input('fin_date')) {
        //     $djour_fin = $request->input('fin_date');
        // }



        // $total_visitors = DB::select('select count(*) as total_visitor  from Receptions where DATE_FORMAT(date_day,"%Y-%m-%d") between :h_arriv and :h_fin', ['h_arriv' => $djour_debut, 'h_fin' => $djour_fin]);

        //faire sortir les motifs  ,['d1' =>$ddebut,'d2' =>$ddebut]
        // $lespresent = DB::select('select * from visitors, receptions where visitors.id = receptions.visitor_id and DATE_FORMAT(date_day,"%Y-%m-%d") = DATE_FORMAT(NOW(),"%Y-%m-%d")');
        //dd($lespresent);

        // return view('mtn.visitors');

        $visitors = Visitor::all();
        return view('mtn.visitors', compact('visitors'));
    }

    public function home()
    {
        Paginator::useBootstrap();
        // $receptions = Reception::paginate(1);
        $users = User::role('agent')->paginate(10);
        return view('mtn.agents', compact('users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        // dd($request->all());
        $user = new User();
        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->assignRole('agent');
        $user->save();
        session()->flash('success', 'agent crée avec succèss');
        return redirect()->route('mtn.agents');
    }

    public function graphUpdate(Request $request)
    {

        $date_dujour =  new DateTime(now());
        $djour_debut = $date_dujour->format('Y-m-d');
        $djour_fin = $djour_debut;

        if ($request->input('debut_date')) {
            $djour_debut = $request->input('debut_date');
        }

        if ($request->input('fin_date')) {
            $djour_fin = $request->input('fin_date');
        }
        $motifs = DB::select('select count(*) as y , motif  as label from Receptions where DATE_FORMAT(date_day,"%Y-%m-%d") between :h_arriv and :h_fin group by motif', ['h_arriv' => $djour_debut, 'h_fin' => $djour_fin]);

        $total_visitors = DB::select('select count(*) as total_visitor  from Receptions where DATE_FORMAT(date_day,"%Y-%m-%d") between :h_arriv and :h_fin', ['h_arriv' => $djour_debut, 'h_fin' => $djour_fin]);
        $total_visitors = $total_visitors > 0 ? $total_visitors : 0;
        $last_week = DB::select('select count(*) as counter , 
          CASE
            WHEN DATE_FORMAT(date_day,"%a") = "Mon" THEN "Lun"
            WHEN DATE_FORMAT(date_day,"%a") = "Tue" THEN "Mar"
            WHEN DATE_FORMAT(date_day,"%a") = "Wed" THEN "Mer"
            WHEN DATE_FORMAT(date_day,"%a") = "Thu" THEN "Jeu"
            WHEN DATE_FORMAT(date_day,"%a") = "Fri" THEN "Ven"
            WHEN DATE_FORMAT(date_day,"%a") = "Sat" THEN "Sam"
            WHEN DATE_FORMAT(date_day,"%a") = "Sun" THEN "Dim"
            ELSE "xxxxx"
          END as day_fr,
          DATE_FORMAT(date_day,"%e") as jour  
          from receptions 
          where  DATE_FORMAT(date_day,"%Y-%m-%d") 
          between DATE_SUB(DATE_FORMAT(now(),"%Y-%m-%d"), INTERVAL 7 DAY )  and DATE_FORMAT(now(),"%Y-%m-%d")
          group by jour,day_fr
          order by DATE_FORMAT(date_day,"%e")');

        return response()->json(['nb_reception' => $total_visitors[0]->total_visitor, 'interval' => [$djour_debut, $djour_fin], 'total_motif' => $motifs, 'week' => $last_week, 'server_date' => (new DateTime(now()))->format('Y-m-d')]);
    }

    
}
