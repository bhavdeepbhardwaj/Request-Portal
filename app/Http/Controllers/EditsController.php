<?php

namespace App\Http\Controllers;
use Auth;
use Admin;
use Client;

use Illuminate\Http\Request;
use Faker\Provider\Image;
use App\Mailers\AppMailer;
use App\Edit;
use DB;
use Storage;

class EditsController extends Controller
{
    protected $guard = ['admin', 'client'];

    public function store(Request $request, AppMailer $mailer, $id){

        $fileName="";
        $this->validate($request, [
            'comments'  => 'required',
            'reference' => 'mimes:jpg,jpeg,png,pdf,xlsx,xlx,ppt,pptx,csv,zip|max:307200',

        ]);

       if($request->hasFile('reference')){
            $image = $request->file('reference')->getClientOriginalName();
            $fileName = $request->reference->move(date('mdYHis').'uploads', $image);

        }

      $edit = new Edit([
             'jobno'     => $id,
             'comments'  => $request->input('comments'),
             'reference' => $fileName,
         ]);


         $edit->save();

         $mailer->sendEditInformation(Auth::user(), $edit);


         $number = DB::table('edits')
         ->orderBy('created_at','desc')
         ->first();

        $num = sprintf('%02d', intval($number->id));

       return redirect()->back()->with("status", "An Edit Request ADNESEA$id-E$num has been submitted.");
    }


    public function view()
    {
        $edits = Edit::latest()->orderBy('id', 'desc')->get();
        return view('edits.view', compact('edits'));

    }

    public function viewEditDetail($slug){

        $edit_detail = Edit::where('id', $slug)->get()->first();

        return view('edits.details', compact('edit_detail'));


    }


}
