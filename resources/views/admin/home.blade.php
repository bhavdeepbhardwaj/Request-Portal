@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="title m-b-md">
            <img src="{{ asset('images/logo.png') }}" style="width:300px;">
                </div>
                </div>
                <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="center-center links">
                    @auth
                        <a href="{{ url('show_ticket') }}">View Request</a>
                        <a href="{{ url('update_ticket') }}">Update Request</a>

                    @else
                        <a href="{{ route('login') }}">Proceed to Login</a>
                    @endauth
                        <!---
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            --->
                  </div>
               @endif
            </div>

            </div>

        </div>

</div>

@endsection
