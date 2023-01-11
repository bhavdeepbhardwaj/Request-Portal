<?php
namespace App\Mailers;

use App\Ticket;
use App\Revision;
use App\Edit;
use App\Rejection;
use Illuminate\Contracts\Mail\Mailer;
use App\Client;
use App\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AppMailer {
    protected $mailer;
    protected $fromAddress = 'info@ashplan.media';
    protected $fromName = 'Service Request | ASHPlan Media';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];


    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    //ticket information

    public function sendTicketInformation($user, Ticket $ticket)
    {
        //$this->to = $user->email;


            // $mail_1 =array ('bhavdeep.bharadwaj@ashplan.media');
            // $mail_2 =array ('sandeep.rawat@ashplan.media','bhavdeep.bharadwaj@ashplan.media');

         $mail_1 = array('sandeep.rawat@ashplan.media','info@ashplan.media','karan.bhardwaj@nexstgo.com','yash.gautam@nexstgo.com','aman.sharma@ashplan.media','bhavdeep.bharadwaj@ashplan.media',);
         $mail_2 = array('sandeep.rawat@ashplan.media','aman@meliaura.com','sandeep.rawat@ashplan.media','agam@meliaura.com','bhavdeep.bharadwaj@ashplan.media');
         $mail=[];

         if(Auth::guard('client')->user()->id == '1')
         {
             $mail = $mail_1;
         }
         elseif(Auth::guard('client')->user()->id == '2')
         {
             $mail = $mail_2;
         }
         else{

         }

        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();

        $num = sprintf('%03d', intval($number->no));
        $num1 = sprintf('%03d',intval($number->job_no));


        $this->to = $mail;
        if($number->user_id == 2)
        {
        $this->subject = "[SRN $ticket->job$num1] $ticket->title";
        }
        else
        {
        $this->subject = "[SRN $ticket->job$num] $ticket->title";
        }
        $this->view = 'emails.ticket_info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }

    public function sendTicketComments($ticketOwner, $user, Ticket $ticket, $comment)
    {
        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();

        $num = sprintf('%03d', intval($ticket->no));

        $this->to = ['sandeep.rawat@ashplan.media'];
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->job$num)";
        $this->view = 'emails.ticket_comments';
        $this->data = compact('ticketOwner', 'user', 'ticket', 'comment');
        return $this->deliver();
    }

    public function sendTicketStatusNotification($ticketOwner, Ticket $ticket)
    {
        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();

        $num = sprintf('%03d', intval($ticket->no));


        $this->to = ['sandeep.rawat@ashplan.media'];
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->job$num)";
        $this->view = 'emails.ticket_status';
        $this->data = compact('ticketOwner', 'ticket');

        return $this->deliver();
    }


    //Ticket Update information
    public function sendStatusInformation($user)
      {
        $ticket = Ticket::first();

        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();


        $num = sprintf('%03d', intval($number->no));
        $this->to = ['contact@ashplan.media'];
        $this->subject = "[SRN $ticket->job$num] $ticket->title";
        $this->view = 'emails.status_info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();

        }


    //revision

    public function sendRevisionInformation($user, Revision $revision)
    {
        // $mail/_1 =array ('bhavdeep.bharadwaj@ashplan.media');
            // $mail_2 =array ('sandeep.rawat@ashplan.media');

        $mail_1 = array('sandeep.rawat@ashplan.media','info@ashplan.media','karan.bhardwaj@nexstgo.com','yash.gautam@nexstgo.com','aman.sharma@ashplan.media','bhavdeep.bharadwaj@ashplan.media');
        $mail_2 = array('sandeep.rawat@ashplan.media','aman@meliaura.com','sandeep.rawat@ashplan.media','agam@meliaura.com','bhavdeep.bharadwaj@ashplan.media');
         $mail=[];

         if(Auth::guard('client')->user()->id == '1')
         {
             $mail = $mail_1;
         }
         elseif(Auth::guard('client')->user()->id == '2')
         {
             $mail = $mail_2;
         }
         else{

         }

        $number = DB::table('revisions')
        ->orderBy('created_at','desc')
        ->first();

       $num = sprintf('%02d', intval($number->id));

       $this->to = $mail;
       $this->subject = "[REVISION ADNESEA$number->jobno-R$num] $revision->title";
       $this->view = 'emails.revision_info';
       $this->data = compact('user', 'revision');

       return $this->deliver();
    }


    //edits

    public function sendEditInformation($user, Edit $edit)
    {
        // $mail_1 = array ('bhavdeep.bharadwaj@ashplan.media');
        // $mail_2 = array ('sandeep.rawat@ashplan.media');

        $mail_1 = array('sandeep.rawat@ashplan.media','info@ashplan.media','karan.bhardwaj@nexstgo.com','yash.gautam@nexstgo.com','aman.sharma@ashplan.media','bhavdeep.bharadwaj@ashplan.media',);
        $mail_2 = array('sandeep.rawat@ashplan.media','aman@meliaura.com','sandeep.rawat@ashplan.media','agam@meliaura.com','bhavdeep.bharadwaj@ashplan.media');
         $mail=[];

         if(Auth::guard('client')->user()->id == '1')
         {
             $mail = $mail_1;
         }
         elseif(Auth::guard('client')->user()->id == '2')
         {
             $mail = $mail_2;
         }
         else{

         }

        $number = DB::table('edits')
        ->orderBy('created_at','desc')
        ->first();

       $num = sprintf('%02d', intval($number->id));

       $this->to = $mail;
       $this->subject = "[EDIT ADNESEA$number->jobno-E$num] $edit->title";
       $this->view = 'emails.edit_info';
        $this->data = compact('user', 'edit');

        return $this->deliver();
    }
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);
        });
    }

    public function sendRejectionInformation($user, Rejection $rejection)
    {
        $ticket = Ticket::first();
        $number = DB::table('tickets')
        ->orderBy('created_at','desc')
        ->first();

        $num = sprintf('%03d', intval($number->no));
        $this->to = ['info@ashplan.media'];
        $this->subject = "[SRN $ticket->job$num] $ticket->title";
        $this->view = 'emails.rejection_info';
        $this->data = compact('user', 'rejection');

         return $this->deliver();

    }
}
