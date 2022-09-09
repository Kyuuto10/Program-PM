@if(session('success'))
    <div class="alert alert-success" 
    style="
            position: absolute;
            top: 200px;
            left:20px;
            width:1460px;
        "
    role="alert">
        {{session('success')}}
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning" role="alert">
        {{session('warning')}}
    </div>
@endif