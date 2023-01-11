@extends('layouts.app')

@section('title', 'Revision Details')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        <table class="table table-hover">
                       <tr>
                        <th scope="col">Date:</th>
                             <td>{{ date('d/m/Y h:i:s a', strtotime($revision_detail->created_at)) }} </td>
                         </tr>

                         <tr>
                             <th scope="col">Revision No.:</th>
                             <td>ADNESEA{{ $num = sprintf('%03d', intval($revision_detail->jobno))}}-R{{ $num = sprintf('%02d', intval($revision_detail->id))}}</td>
                         </tr>

                        <tr>
                             <th scope="col">SRN:</th>
                             <td>ADNESEA{{ $num = sprintf('%03d', intval($revision_detail->jobno))}}</td>
                         </tr>
               
                      
                        <tr>
                            <th scope="col">Comment:</th>
                            <td>{!! nl2br($revision_detail->comments) !!}</td>
                         </tr>
                  
               
               
                        <tr>
                        @if($revision_detail->reference!='')
                        
                        <th scope="col">Reference:</th>
                        
                        <td><a href="{{ '/'.$revision_detail->reference}}" target="_blank" download="{!! $revision_detail->reference !!}">Download File</a></td>
                            @else
                            <th scope="col">Reference:</th>
                            <td>N/A</td>

                            @endif
                        </tr>
                    <tr>
               <td>
                
               </td>
               <td>
               <div class="col">
                  <a class="nav-link btn btn-primary" style="cursor: pointer; color:#fff; width:50%;" href="{{ url('view_revision') }}">{{ __('View Revision') }}</a>
                </div>
                
               </td>
               
               </tr>
                       
                    </table>
              </div>
          </div>
    </div>     
  @endsection