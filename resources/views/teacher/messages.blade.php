@if (session('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <h5 class="alert-heading pt-2">{{session('success')}}</h5>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <hr>
    <p>{{session('details')}}</p>

</div>

@endif