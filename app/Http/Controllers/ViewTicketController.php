<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewTicketController extends Controller
{
    //
   function index(Request $request)
    {
    $user_id = Auth::user()->id;
     if(request()->ajax())
     {
      if($request->status)
      {
      //  $user_id = Auth::guard('client')->user()->id;
       $data = DB::table('tickets')->where('tickets.status', $request->status)->where('tickets.user_id','=', $user_id);
      //  dd($user_id);
        //  ->join('categories', 'categories.name', '=', 'tickets.category_name')
        //  ->select('tickets.created_at', 'tickets.no',  'tickets.brand',  'tickets.title', 'categories.name',  'tickets.priority','tickets.status')
        //  ->where('tickets.status', $request->status);
        //  ->where('tickets.user_id ', $request->user_id);
        //  dd($request->status);
       }
      else
      {
        $data = DB::table('tickets')->where('tickets.user_id','=', $user_id);
        //  ->join('categories', 'categories.name', '=', 'tickets.category_name')
        //  ->join('tickets', 'tickets.category_name', '=', 'categories.name')
        //  ->select('tickets.created_at', 'tickets.no',  'tickets.brand',  'tickets.title', 'categories.name',  'tickets.priority','tickets.status')->unique('tickets.no');
      }
      return datatables()->of($data)->make(true);

    }

    $statuses = DB::table('statuses')
        ->select("*")
        ->get();
        // dd($user_id);

     return view('view_ticket', compact('statuses', 'user_id'));

    }
}
