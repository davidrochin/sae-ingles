<div class="card {{ $class or '' }} border-{{ $border or 'default' }}" style="width: {{ $width or '' }}px;">

    @if(isset($header))
    <div class="card-header">{{ $header }}</div>
    @endif

    <div class="card-body">
        {{ $slot or '' }}
    </div>

    @if(isset($footer))
    <div class="card-footer">
        {{ $footer }}
    </div>
    @endif
</div>