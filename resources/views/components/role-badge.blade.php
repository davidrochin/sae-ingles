
<span class="badge badge-pill
@if($role->name == 'admin')
badge-dark
@elseif($role->name == 'coordinator')
badge-success
@elseif($role->name == 'schoolserv')
badge-info
@else
badge-light
@endif
">
{{ $role->description }}
</span>