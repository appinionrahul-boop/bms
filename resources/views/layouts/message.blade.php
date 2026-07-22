@if (session()->has('msg'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session()->get('msg') }}
    </div>
@endif