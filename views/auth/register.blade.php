@extends('my-account::layout.auth')

@section('content')
	<p class="mb-7 text-center text-gray-600">Informe seus dados para criar sua conta:</p>
				
	<form method="post" action="{{ $register_post_url }}"  x-data="{loading: false}" x-on:submit="loading=true">
		@csrf

		<div class="space-y-4">
			
			<x-input type="text"  :required=true name="name" title="Nome completo"></x-input>
			
			<x-input type="text" :required=true name="email" title="E-mail"></x-input>
						
			<x-input type="password" :required=true name="password" title="Escolha uma senha"></x-input>
		</div>
		
		<div class="mt-7">
			<x-button full className="btn-primary" loading type="submit">Continuar</x-button>
		</div>

		<div class="text-center mt-8">
			<a class="text-gray-600 hover:text-gray-800 text-base" href="{{ $login_url }}">Voltar </a>
		</div>
	</form>

@endsection
