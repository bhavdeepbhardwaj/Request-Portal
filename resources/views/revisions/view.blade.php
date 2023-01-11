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
                    <th scope="col">Revision No.</th>
                 </tr>
             </thead>
                <tbody>
                @foreach( $revisions as $revision )
                    <tr class="table-active">
                    <td>{{ date('d-m-Y', strtotime($revision->created_at)) }}</td>
                    <td>ADNESEA{{ $num = sprintf('%03d', intval($revision->jobno))}}</td>
                    <td>ADNESEA{{ $num = sprintf('%03d', intval($revision->jobno))}}-R{{ $num = sprintf('%02d', intval($revision->id)) }}</td>
                  
                    <td>
                    
                    <div class="col-md-10 col-md-offset-4">
                          <a href="{{ route('revision.detail', $revision->id) }}" class="btn btn-primary">View Details</a>
                  </div>
                    
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
