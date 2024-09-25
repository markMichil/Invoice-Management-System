
@if(count($errors)>0)
    <div class="alert alert-danger">
        @foreach ($errors as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif



@if(Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }}
    </div>
@endif
