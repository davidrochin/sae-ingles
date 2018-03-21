<div class="form-group">
	<label for="{{ $name }}ControlInput">{{ $tag }}</label>
	<input id="{{ $name }}ControlInput" name="{{ $name }}" type="{{ $type or 'text' }}" class="form-control {{ $errors->has($name) ? 'is-invalid' : ''}}" value="{{ $value or '' }}" {{ isset($disabled) ? 'disabled' : '' }}>
	<div class="invalid-feedback">{{ $errors->first($name) }}</div>
</div>