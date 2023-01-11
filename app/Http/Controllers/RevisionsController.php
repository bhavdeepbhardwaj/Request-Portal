<?php

namespace App\Http\Controllers;
use Auth;
use Admin;
use Client;

use Illuminate\Http\Request;
use Faker\Provider\Image;
use App\Mailers\AppMailer;
use App\Revision;
use DB;
use Storage;


class RevisionsController extends Controller
{
    protected $guard = ['admin', 'client'];
    //
    public function store(Request $request, AppMailer $mailer, $id){

        $count = DB::table('revisions')->where('jobno', $id)->count();

        if($count < 5) {
          
            $fileName="";
            $this->validate($request, [
                'comments'  => 'required',
                'reference' => 'mimes:jpg,jpeg,png,pdf,xlsx,xlx,ppt,pptx,csv,zip',
                          
            ]);
     
           if($request->hasFile('reference')){
                $image = $request->file('reference')->getClientOriginalName();
                $fileName = $request->reference->move(date('mdYHis').'uploads', $image);
                
            }
      
          $revision = new Revision([
                 'jobno'     => $id,
                 'comments'  => $request->input('comments'),
                 'reference' => $fileName,
             ]);
            
    
             $revision->save();

             $mailer->sendRevisionInformation(Auth::user(), $revision);

             $number = DB::table('revisions')
             ->orderBy('created_at','desc')
             ->first();
           
            $num = sprintf('%02d', intval($number->id));
          
           return redirect()->back()->with("status", "A new Revision ADNESEA$id-R$num has been created.");

       }else {
           
            return redirect()->back()->with("status", "Kindly contact your admin as you have exceeded the maximum revision limit.");

       }
       
    }


    public function view()
    {
        $revisions = Revision::latest()->orderBy('id', 'desc')->get();
        return view('revisions.view', compact('revisions'));

    }

    public function viewRevisionDetail($slug){

        $revision_detail = Revision::where('id', $slug)->get()->first();

        return view('revisions.details', compact('revision_detail'));


    }

    
}
