@extends('my-account::layout.html')

@section('main-content')

	<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 bg-slate-100">
	 
		<div class="mt-7 sm:mx-auto sm:w-full sm:max-w-[420px]">
			<div class="bg-white px-6 py-12  rounded-lg sm:px-12">
				{{-- <a href="{{ route(Routesguard::identifier('customer')->attemptLogin()) }}">
					<img class="mx-auto mb-12 w-48" src="{{ asset('images/logo.png') }}" alt="{{env('APP_NAME')}}" >
				</a> --}}
				<x-alert/>
		
				<h2 class="mb-7 text-center text-2xl font-bold leading-9 tracking-tight text-slate-900">{{ $title }}</h2>
													
					@yield('content')
				</div>
		  </div>
		</div>
	</div>
@endsection
