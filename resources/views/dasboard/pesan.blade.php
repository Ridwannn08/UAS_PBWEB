@if ($errors->any)
<div class="alert-danger">
  <ul>
    @foreach ($errors->all() as $item)
      <li>{{ $item}}</li>
    @endforeach
  </ul>                   
</div>   
@endif

@if (Session::has('succes'))
    <div class="alert alert-success">
        {{ Session::get('succes') }}
    </div>
@endif