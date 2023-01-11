@if (session('status'))
    <div class="alert alert-fill-primary">
        <i class="ti-info-alt"></i> {{ session('status') }}
    </div>
@endif
