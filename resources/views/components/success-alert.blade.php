@if(session()->get('success'))
	@component('components.alert')
		@slot('type', 'success')

		{{ session()->get('success') }}

	@endcomponent
@endif