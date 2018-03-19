<div class="form-group">
	<label for="{{ $name }}ControlInput">{{ $tag }}</label>
	<input type="{{ $type or 'text' }}" id="{{ $name }}ControlInput" name="{{ $name }}" class="form-control {{ $errors->has($name) ? 'is-invalid' : ''}} {{ $class or '' }}" value="{{ $value or '' }}" {{ isset($disabled) ? 'disabled' : '' }}>
	<div class="invalid-feedback">{{ $errors->first($name) }}</div>
</div>