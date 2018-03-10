

<div class="alert alert-{{ $type or 'primary' }} alert-dismissible fade show" role="alert">
  {{ $message or '' }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>