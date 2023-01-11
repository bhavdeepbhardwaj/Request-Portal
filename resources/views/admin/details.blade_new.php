@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')
@include('revisions.index')
@include('edits.index')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('includes.revision')

            <table class="table table-hover">
                         <tr>
                             <th scope="col">Date: </th>
                             <input type="hidden" name="user_name" value="{!! Auth::guard('client')->user()->name !!}">
                             <td>{{ date('d/m/Y h:i:s a', strtotime($ticket_detail->created_at)) }} </td>
                         </tr>
                        <tr>
                             <th scope="col">SRN:</th>
                             <input type="hidden" name="ticket_id" value="{!! $ticket_detail->no !!}">
                             <td>ADNESEA{{ $num = sprintf('%03d', intval($ticket_detail->no))}}</td>
                         </tr>

                        <tr>
                            <th scope="col">Brand:</th>
                            <td>{{ ucfirst(trans($ticket_detail->brand)) }}</td>
                        </tr>

                        <tr>
                            <th scope="col">Country:</th>
                            <td>{{ ucfirst(trans($ticket_detail->country)) }}</td>
                        </tr>

                         <tr>
                            <th scope="col">Title:</th>
                            <td>{!! $ticket_detail->title !!}</td>
                         </tr>
                         <tr>
                             <th scope="col">Category:</th>
                             <td>{!! $ticket_detail->category_name !!}</td>
                         </tr>

                        <tr>
                            <th scope="col">Priority:</th>
                            <td>{{ ucfirst(trans($ticket_detail->priority)) }}</td>
                        </tr>

                        <tr>
                            <th scope="col">Summary:</th>
                            <td>{!!  nl2br($ticket_detail->summary) !!}</td>
                         </tr>
                         <tr>
                             <th scope="col">Objective:</th>
                             <td>{!! $ticket_detail->objective !!}</td>
                         </tr>


                        <tr>
                        <th scope="col">Reference:</th>
                        @if ($ticket_detail->reference!="")
                        <td>
                          @foreach(explode(',', $ticket_detail->reference) as $ref)
                          <a href="{{ '/'.$ref}}" target="_blank" download="{!! $ref !!}">Download File</a><br/>
                          @endforeach
                          </td>
                          @else
                            <td>N/A</td>
                        @endif
                        </tr>
                         <tr>

                            <th scope="col">Other Information:</th>
                            <td>{!! $ticket_detail->otherinfo !!}</td>
                         </tr>


               <!--- form  --->

                 <tr>
                 <th scope="col">Deadline:</th>
                <td>{!! $ticket_detail->deadline !!}</td>
                 </tr>


                  <tr>
                    <th scope="col">Status:</th>
                     <td>{!! $ticket_detail->status !!}</td>
                  </tr>

          <!--- form  --->
             <tr>
               <th scope="col">Creative for Approval:</th>
               <td>
               <div class="row justify-content-center">
               <div class="col-md-6">
               @if($ticket_detail->creative!='')

               <a href="{{ '/'.$ticket_detail->creative}}" target="_blank" download="{!! $ticket_detail->creative !!}">Download Creative</a>
               </div>
               <div class="col-md-6">
              <div class="modal-footer">
                <span class="pull-left">
                       <form method="POST" role="form" action="{{ route('approve', $ticket_detail->no) }}">
                          <input type="hidden" name="id" value="{{ $ticket_detail->no }}">
                           @csrf
                             <button type="submit" class="btn btn-success">Approve</button>
                       </form>
                </span>
                <span class="pull-right">

                <form method="POST" role="form" action="{{ route('reject', $ticket_detail->no) }}">
                 @csrf
                   <input type="hidden" name="id" value="{{ $ticket_detail->no}}">
                  <button type="submit" class="btn btn-danger">Reject</button>
                </form>

               </span>
             </div>

            </div>

          </div>
          @else
               <span>N/A</span>
               @endif
       </td>
    </tr>
       <!---
           <tr>
             <td>
             <div>
               <h3>Comments</h3>
                  <form onsubmit="addComment(event);">
                     <input type="text" placeholder="Add a comment" name="text" id="text" required>
                     <input type="hidden" name="jobno" id="jobno" value="{{$ticket_detail->no}}">
                     <input type="hidden" name="username" id="username" value="{{Auth::guard('client')->user()->name}}">
                      <button id="addCommentBtn">Comment</button>
                 </form>
                   <div class="alert" id="alert" style="display: none;"></div>
                 <br>
             <div id="comments">
                @foreach($comments as $comment)
                    <div>
                     <small>{{ $comment->username }}</small>
                        <br>
                            {{ $comment->text }}
                         </div>
                        @endforeach
                     </div>
                  </div>
                </td>


                 </tr>
             --->

             <tr>
             <td></td>
             <td>
             <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editModal">
                  Edit Request
                 </button>
             </td>
             </tr>
                 </table>



          </div>

      </div>
    </div>
     <!-- Add jQuery -->
     <script>
// when DOM is ready
        $(document).ready(function () {

        // Attach Button click event listener
        $("#editBtn").click(function(){

            // show Modal
            $('#editModal').modal('show');
            });
        });
</script>
     <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script>
        function displayComment(data) {
            let $comment = $('<div>').text(data['text']).prepend($('<small>').html(data['username'] + "<br>"));
                 $('#comments').prepend($comment);
        }

        function addComment(event) {
            function showAlert(message) {
                let $alert = $('#alert');
                $alert.text(message).show();
                setTimeout(() => $alert.hide(), 4000);
            }

            event.preventDefault();
            $('#addCommentBtn').attr('disabled', 'disabled');
            let data = {
                jobno: $('#jobno').val(),
                text: $('#text').val(),
                username: $('#username').val(),
            };
            fetch('/comments', {
                body: JSON.stringify(data),
                credentials: 'same-origin',
                headers: {
                    'content-type': 'application/json',
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
                    'x-socket-id': window.socketId
                },
                method: 'POST',
                mode: 'cors',
            }).then(response => {
                $('#addCommentBtn').removeAttr('disabled');
                if (response.ok) {
                    displayComment(data);
                    showAlert('Comment posted!');
                } else {
                    showAlert('Your comment was not approved for posting. Please be nicer :)');
                }
            })
        }
    </script>
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
    <script>
        var socket = new Pusher("your-app-key", {
            cluster: 'your-app-cluster',
        });
        // set the socket ID when we connect
        socket.connection.bind('connected', function() {
            window.socketId = socket.connection.socket_id;
        });
        socket.subscribe('comments')
            .bind('new-comment',displayComment);
    </script>
  @endsection
