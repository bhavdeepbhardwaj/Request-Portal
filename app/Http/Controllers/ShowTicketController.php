<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowTicketController extends Controller
{
    //
   function index(Request $request)
    {
    $user_id = 2;
     if(request()->ajax())
     {
      if($request->status)
      {
        //    $data = DB::table('tickets')
        //  ->join('categories', 'categories.name', '=', 'tickets.category_name')->where('tickets.status', $request->status);
        //  ->select('tickets.created_at', 'tickets.no',  'tickets.brand',  'tickets.title', 'categories.name',  'tickets.priority','tickets.status')
        //  $data = DB::table('tickets')->where('tickets.status', $request->status)->where('tickets.user_id','=', $user_id);
         $data = DB::table('tickets')->where('tickets.status', $request->status);
       }
      else
      {
       $data = DB::table('tickets');
    //    $data = DB::table('tickets')->where('tickets.user_id','=', $user_id);
        //  ->join('categories', 'categories.name', '=', 'tickets.category_name')
        //  ->select('tickets.created_at', 'tickets.no',  'tickets.brand',  'tickets.title', 'categories.name',  'tickets.priority','tickets.status');
      }
      return datatables()->of($data)->make(true);

    }

    $statuses = DB::table('statuses')
        ->select("*")
        ->get();

     return view('show_ticket', compact('statuses'));

    }

}
