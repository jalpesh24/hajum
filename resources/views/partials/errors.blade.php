@if (session()->has('errors'))
  <div class="alert alert-danger text-center animated fadeIn">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>
      {!! session()->get('errors') !!}
    </strong>
  </div>
@endif