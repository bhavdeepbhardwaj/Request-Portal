<?php

namespace App\Http\Controllers;

use Admin;
use Client;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Storage;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Country;
use App\Comment;
use App\Ticket;
use App\Rejection;
use Faker\Provider\Image;
use App\Mailers\AppMailer;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class TicketsController extends Controller
{

    protected $guard = ['admin', 'client'];

    public function create()
    {
        // $user_id = Auth::guard('client')->user()->id ;
        $user_id = Auth::user()->id;
        $categories = Category::where('user_id', $user_id)->get();
        $brands = Brand::where('user_id', $user_id)->get();
        $countries = Country::where('user_id', $user_id)->get();
        return view('users.create', compact('brands', 'countries', 'categories',));
    }


    public function show()
    {
        //$tickets = Ticket::all();
        $tickets = Ticket::latest()->orderBy('no', 'desc')->get();
        // dd($tickets);
        return view('admin.show', compact('tickets'));
    }



    public function view()
    {
        //$tickets = Ticket::all();
        $tickets = Ticket::latest()->orderBy('no', 'desc')->get();
        return view('users.view', compact('tickets'));
    }



    public function update(Request $request, $id, AppMailer $mailer)
    {
        $fileName = "";
        $this->validate($request, [
            'creative' => 'mimes:jpg,jpeg,png,pdf,xlsx,xlx,ppt,pptx,csv,zip',

        ]);

        if ($request->hasFile('creative')) {
            $image = $request->file('creative')->getClientOriginalName();
            $fileName = $request->creative->move(date('mdYHis') . 'uploads', $image);
        }
        $deadline = $request->input('deadline');
        $status = $request->input('status');
        $creative = $fileName;

        DB::update('update tickets set deadline = ?, status = ?, creative = ? where no = ?', [$deadline, $status, $creative, $id]);
        $num = sprintf('%03d', intval($id));

        if ($request->input('status') == "closed") {
            $mailer->sendStatusInformation(Auth::user());
        }

        return redirect()->back()->with("status", "Your SRN: ADNESEA$num has been updated.");
    }



    public function store(Request $request, AppMailer $mailer)
    {

        // $user_id = Auth::guard('client')->user()->id ;
        $this->validate($request, [
            'user_id'   => 'required',
            'brand'     => 'required',
            'country'   => 'required',
            'title'     => 'required',
            'category'  => 'required',
            'priority'  => 'required',
            'summary'   => 'required',
            'reference.*' => 'mimes:doc,docx,jpg,jpeg,png,pdf,xlsx,xlx,ppt,pptx,csv,zip',

        ]);

        /*  if($request->hasFile('reference')){
            $image = $request->file('reference')->getClientOriginalName();
            $fileName = $request->reference->move(date('mdYHis').'uploads', $image);

        }
      */


        if ($request->hasFile('reference')) {
            $picture = array();
            $imageNameArr = [];
            foreach ($request->reference as $file) {
                // you can also use the original name
                $imageName = time() . '-' . $file->getClientOriginalName();
                $imageNameArr[] = $imageName;
                // Upload file to public path in images directory
                $fileName = $file->move(date('mdYHis') . 'uploads', $imageName);
                // Database operation
                $array[] = $fileName;
                $picture = implode(",", $array); //Image separated by comma
            }
        } else {
            $picture = "";
        }

        if ($request->user_id == 2) {
            // dd($request->user_id);
            // $getdata = Ticket::where('tickets.user_id','=','$request->user_id')->get();
            $getdata = Ticket::where('user_id', $request->user_id)->latest('job_no')->first();
            $job_no = $getdata->job_no;
            $job_no = $job_no + 1;
            //dd($job_no);
            $ticket = new Ticket([
                'job'              => 'MELIAURA',
                'user_id'          => $request->input('user_id'),
                'job_no'           => $job_no,
                'brand'            => $request->input('brand'),
                'country'          => $request->input('country'),
                'title'            => $request->input('title'),
                'category_name'    => $request->input('category'),
                'priority'         => $request->input('priority'),
                'summary'          => $request->input('summary'),
                'objective'        => $request->input('objective'),
                'reference'        => $picture,
                'otherinfo'        => $request->input('otherinfo'),
            ]);
        } else {
            $ticket = new Ticket([
                'job'              => 'ADNESEA',
                'user_id'          => $request->input('user_id'),
                'job_no'            => 0,
                'brand'            => $request->input('brand'),
                'country'          => $request->input('country'),
                'title'            => $request->input('title'),
                'category_name'    => $request->input('category'),
                'priority'         => $request->input('priority'),
                'summary'          => $request->input('summary'),
                'objective'        => $request->input('objective'),
                'reference'        => $picture,
                'otherinfo'        => $request->input('otherinfo'),
            ]);
        }
        $pending = Ticket::where('status', 'Pending from Client')->count();


        $high = Ticket::where('priority', 'high')
            ->where('status', 'Processing')->count();
        $medium = Ticket::where('priority', 'medium')
            ->where('status', 'Processing')->count();
        $low = Ticket::where('priority', 'low')
            ->where('status', 'Processing')->count();


        //    $fileName = $request->file('reference')->getClientOriginalName();
        //  $request->reference->move(public_path().'/uploads', $fileName);

        if ($pending < 5) {

            if ($request->input('priority') == 'high' &&  $high > 5) {
                return redirect()->back()->with("alert", "You have exceeded the maximum High priority tickets i.e. 5");
            } elseif ($request->input('priority') == 'medium' && $medium > 8) {
                return redirect()->back()->with("alert", "You have exceeded the maximum Medium priority i.e. 8");
            } elseif ($request->input('priority') == 'low' && $low > 10) {
                return redirect()->back()->with("alert", "You have exceeded the maximum Low priority i.e. 10");
            } else {

                $ticket->save();
                // if($user_id == $request->input('user_id') )
                // {
                // $mailer->sendTicketInformation(Auth::user(), $ticket);
                // }
                $mailer->sendTicketInformation(Auth::user(), $ticket);
                $number = DB::table('tickets')
                    ->orderBy('created_at', 'desc')
                    ->first();

                $num = sprintf('%03d', intval($number->no));
                $num1 = sprintf('%03d', intval($number->job_no));
                if ($number->user_id == 2) {
                    return redirect()->back()->with("status", "A new SRN: $ticket->job$num1 has been generated.");
                } else {
                    return redirect()->back()->with("status", "A new SRN: $ticket->job$num has been generated.");
                }
            }
        } else {
            return redirect()->back()->with("warning", "Please clear all the remaining tickets i.e. Pending from client in order to generate new tickets.");
        }
    }


    public function viewTicketDetail($slug)
    {

        //$ticket = Ticket::where('no', $slug)->firstOrFail();
        //return view('users.details', compact('ticket'));

        $comments = Comment::orderBy('id', 'desc')->get();

        $ticket_detail = Ticket::where('no', $slug)->get()->first();
        return view('users.details', compact('ticket_detail', 'comments'));
    }



    public function showTicketDetail($slug)
    {

        $statuses = DB::table('statuses')
            ->select("*")
            ->get();

        $comments = Comment::orderBy('id', 'desc')->get();

        $ticket_detail = Ticket::where('no', $slug)->get()->first();
        return view('admin.details', compact('ticket_detail', 'statuses', 'comments'));

        //

    }


    public function deleteTicketDetail($slug)
    {

        $ticket = Ticket::findOrFail($slug);
        $ticket->delete();
        return redirect()->view('view_ticket');
    }

    //Approval and Rejection

    public function approve(Request $request)
    {
        $id = request('id');

        // DB::insert('insert into mides_users(name, email, password) select name,roc_no,password from mides_vendors where id = :id', ['id' => $id]);
        DB::update('update tickets set creative_status = :status where no = :id', ['status' => 'Approved', 'id' => $id]);

        return redirect()->back()->with("status", "Thank you for approving the creative.");
    }

    public function reject(Request $request)
    {
        $id = request('id');
        DB::update('update tickets set creative_status = :status where no = :id', ['status' => 'Rejected', 'id' => $id]);
        return redirect()->back()->with("status", "Thank you for sharing your feedback, We will share new reference soon");
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Closed";
        $ticket->save();
        $ticketOwner = $ticket->user;
        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
        return redirect()->back()->with("status", "The ticket has been closed.");
    }

    public function rejection(Request $request, AppMailer $mailer, $id)
    {
        $this->validate($request, [
            'reason' => 'required',

        ]);

        $rejection = new Rejection([
            'jobno'     => $id,
            'reason' => $request->input('reason'),
            'comments'  => $request->input('comments'),

        ]);

        $rejection->save();
        $status = $request->input('reject');

        DB::update('update tickets set status = ? where no = ?', [$status, $id]);

        $mailer->sendRejectionInformation(Auth::user(), $rejection);
        return redirect()->back()->with("status", "SRN: ADNESEA$id has been rejected.");
    }

    public function addComment()
    {
        $data = request()->post();
        Comment::moderate($data['text']);
        $comment = Comment::create($data);
        Pusher::trigger('comments', 'new-comment', $comment, request()->header('X-Socket-Id'));
        return $comment;
    }
}
