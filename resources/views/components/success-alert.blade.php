@if(session()->get('success'))
	@component('components.alert')
		@slot('message', session()->get('success'))
		@slot('type', 'success')
	@endcomponent
@endif