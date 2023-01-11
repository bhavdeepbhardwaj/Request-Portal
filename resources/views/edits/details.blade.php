@extends('layouts.app')

@section('title', 'Edit Details')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

        <table class="table table-hover">
                       <tr>
                        <th scope="col">Date:</th>
                             <td>{{ date('d/m/Y h:i:s a', strtotime($edit_detail->created_at)) }} </td>

                         </tr>

                         <tr>
                             <th scope="col">Edit Id:</th>
                             <td>ADNESEA{{ $num = sprintf('%03d', intval($edit_detail->jobno))}}-E{{ $num = sprintf('%02d', intval($edit_detail->id)) }}</td>
                         </tr>

                        <tr>
                             <th scope="col">SRN:</th>
                             <td>ADNESEA{{ $num = sprintf('%03d', intval($edit_detail->jobno))}}</td>
                         </tr>
               
                      
                        <tr>
                            <th scope="col">Comment:</th>
                            <td>{!! nl2br($edit_detail->comments) !!}</td>
                         </tr>
                  
               
               
                        <tr>
                        @if($edit_detail->reference!='')
                        
                        <th scope="col">Reference:</th>
                        
                        <td><a href="{{ '/'.$edit_detail->reference}}" target="_blank" download="{!! $edit_detail->reference !!}">Download File</a></td>
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
                  <a class="nav-link btn btn-primary" style="cursor: pointer; color:#fff; width:50%;" href="{{ url('view_edit') }}">{{ __('View Edit') }}</a>
                </div>
                
               </td>
               
               </tr>
                       
                    </table>
              </div>
          </div>
    </div>     
  @endsection