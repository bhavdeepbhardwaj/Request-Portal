@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">SRN</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Project Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $tickets as $ticket )
                    <tr class="table-active">
                     <td>{{ date('d-m-Y', strtotime($ticket->created_at)) }}</td>
                    <td>ADNESEA{{ $num = sprintf('%03d', intval($ticket->no))}}</td>
                    <td>{{ $ticket->brand }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->category_name }}</td>
                    <td>{{ $ticket->priority }}</td>
                    <td>{{ $ticket->deadline }}</td>
                    <td>{{ $ticket->status }}</td>

                    <td>
                    
                  
                        <a href="{{ route('ticket.detail', $ticket->no) }}" class="btn btn-primary">View</a>
                     
                     </td>
                  <td>
                   
                   <!--    <a href="{{ route('ticket.delete', $ticket->no) }}" class="btn btn-danger">Delete</a>
                   <a href="/ticket/delete/{{ $ticket->no }}" class="btn btn-danger">Delete</a> --->

                    
                    </td> 
                   </tr>
                    @endforeach
                </tbody>
            </thead>
         </table>

    </div> 
  </div> 
 </div> 
 @endsection
