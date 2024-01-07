<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-gray-100">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $panel->getTitle() }} | {{ $title }}</title>
	<style>
		[x-cloak] { display: none !important; }
	</style>

	<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
		
	@vite(['resources/css/app.css'])

	@livewireStyles
</head>
<body class="h-full">
	
	@yield('main-content')

	@vite(['resources/js/app.js'])

	@livewireScripts
</body>
</html>