@extends('layouts.app')

@section('title', 'Open Ticket')
@section('css')
<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                padding: 20px;
            }

            input {
                border: 2px solid blue;
                font-size: 16px;
                padding: 5px;
            }

            button {
                font-size: 16px;
                padding: 5px;
            }
        </style>
@endsection
@section('content')
@include('status.index')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-10">
           <div class="panel-body">
           @include('includes.flash')
                  <form class="form-horizontal" role="form" action="/update/{{  $ticket_detail->no }}" method="POST" enctype="multipart/form-data">
                   {!! csrf_field() !!}

                 <table class="table table-hover">
                       <tr>
                             <th scope="col">Date: </th>
                             <input type="hidden" name="user_name" value="{!! Auth::guard('admin')->user()->name !!}">
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
                            <td>{!! nl2br($ticket_detail->summary) !!}</td>
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

                         <tr>
                            <th scope="col">Other Information:</th>
                            <td>{!! $ticket_detail->otherinfo !!}</td>
                         </tr>


               <!--- form  --->

                         <tr>
                            <th scope="col">Deadline:</th>
                            <td>
                            <div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">

                            <input id="deadline" type="date" class="form-control" name="deadline" value="{{ old('deadline') }}">
                                @if ($errors->has('deadline'))
                                    <span class="help-block">
                                    <strong><span class="error">Deadline Can Not Be Empty</span></strong>
                                    </span>
                                @endif
                            </div>
                          </td>
                        </tr>

                         <tr>
                            <th scope="col">Status:</th>
                            <td>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <select id="status" onchange="onDropdownSelect();" type="status" class="form-control" name="status">
                            <option value="">Select Status</option>
                                 @foreach($statuses as $status)
                                   <option value="{{ $status->name }}">{{ $status->name }}</option>
                                   @endforeach
                             </select>
                              @if ($errors->has('status'))
                                    <span class="help-block">
                                    <strong><span class="error">Job Status Can Not Be Empty</span></strong>
                                    </span>
                                @endif
                                <div id="rejected" class="status" style="display:none"> .... </div>

                               </div>
                            </td>
                         </tr>


                         @if($ticket_detail->creative_status!='')
                         <tr>
                            <th scope="col">Creative Status:</th>
                            <td>
                            {!! $ticket_detail->creative_status !!}
                            </td>
                          </tr>
                         @else
                         <tr>

                            <th scope="col">Creative for Approval:</th>
                            <td>
                            <div class="form-group{{ $errors->has('creative') ? ' has-error' : '' }}">
                            <label for="creative" class="col-md-10 control-label">Upload Creative for Client Approval</label>
                            <div class="col-md-10">
                                <input id="creative" type="file" class="form-control" name="creative" value="{{ old('creative') }}">
                                <p class="files">Supported file format: jpg, jpeg, png, pdf, xlsx, xlx, ppt, pptx, csv, zip</p>
                               @if ($errors->has('reference'))
                                    <span class="help-block">
                                    <strong><span class="error">{{ $errors->first('creative') }}</span></strong>
                                    </span>
                                @endif

                                 </div>
                              </div>
                            </td>
                         </tr>
                    @endif

                         <tr>
                            <td>

                            </td>
                         <td>
                             <div class="form-group">
                                 <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Update Details
                                </button>
                             </div>

                             </td>
                        </tr>

                     </table>
                </form>

             </div>
             <!---
             <div>
               <h3>Comments</h3>
                  <form onsubmit="addComment(event);">
                     <input type="textarea" placeholder="Add a comment" name="text" id="text">
                     <input type="hidden" name="jobno" id="jobno" value="{{$ticket_detail->no}}">
                     <input type="hidden" name="username" id="username" value="{{Auth::guard('admin')->user()->name}}">
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
          </div>
          ---->

        </div>
    </div>

     <!-- Add jQuery -->
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
    <script>
	function onDropdownSelect() {
    	var selectedValue = document.getElementById("status").value;
        if(selectedValue == 'Rejected') {
            $("#rejectModal").modal();

        }
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



