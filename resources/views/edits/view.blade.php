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
                    <th scope="col">Edit Id</th>
                 </tr>
             </thead>
                <tbody>
                @foreach( $edits as $edit )
                    <tr class="table-active">
                    <td>{{ date('d-m-Y', strtotime($edit->created_at)) }}</td>
                    <td>ADNESEA{{ $num = sprintf('%03d', intval($edit->jobno))}}</td>
                    <td>ADNESEA{{ $num = sprintf('%03d', intval($edit->jobno))}}-E{{ $num = sprintf('%02d', intval($edit->id)) }}</td>
                  
                    <td>
                    
                    <div class="col-md-10 col-md-offset-4">
                          <a href="{{ route('edit.detail', $edit->id) }}" class="btn btn-primary">View Details</a>
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
