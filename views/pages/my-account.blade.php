@extends('my-account::layout.default')

@section('content')

	<div class="divide-y">
		@livewire('change-personal-data')
		
		@livewire('change-password')
	</div>

@endsection
