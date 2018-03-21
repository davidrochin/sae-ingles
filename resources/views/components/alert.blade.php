

<div id="{{ $id or 'defaultAlert' }}" class="alert alert-{{ $type or 'primary' }} alert-dismissible fade show {{ $style or '' }}" role="alert">
  {{ $slot or '' }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>