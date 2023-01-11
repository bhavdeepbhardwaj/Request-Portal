@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif

@if (session('warning'))
        <div class="alert alert-warning">
               <span>Please clear all the remaining tickets i.e. Pending from client in order to generate new tickets.</span>
         </div>
@endif
