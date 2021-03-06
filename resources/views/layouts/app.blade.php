<!DOCTYPE html>

<html lang="en">
	<head>

		<title>Honest Ipsum</title>

		<!-- meta -->
		<meta charset="UTF-8">
		<meta name="keywords" content="Honest Ipsum, Lorem Ipsum, John Lendvoy, John C Lendvoy, Web Design, Software, Web Developer Tools, Web Design Tools, Dev Tools, Filler Text, Placeholder Text, Design Mockup">
		<meta name="author" content="John C. Lendvoy">
		<meta name="description" content="Honest Ipsum is a replacement for Lorem Ipsum. It was created to alleviate the confusion some clients experience when they see a foreign language all over their website or poster. The filler text generated by this tool is free to be used by designers and developers.">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">

		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle. js"></script>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({
				google_ad_client: "ca-pub-6897955610556286",
				enable_page_level_ads: true
			});
		</script>

		<!-- favicons https://realfavicongenerator.net -->
		{{-- <link rel="icon" href="/favicon.ico?v=2">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#2d4244">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#2d4244">
		<meta name="theme-color" content="#fbfffd"> --}}
			
		<!-- fonts -->
		{{-- <link href="https://fonts.googleapis.com/css?family=Heebo|Roboto:900|Lobster" rel="stylesheet"> --}}
		<link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet"> 

		<!-- bootstrap -->
		{{-- <link href="/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"> --}}

		<!-- plugins -->
		{{-- <link rel="stylesheet" type="text/css" href="/css/dropzone.css"> --}}
		{{-- <link rel="stylesheet" type="text/css" href="/plugins/slick/slick.css"> --}}
		{{-- <link rel="stylesheet" type="text/css" href="/plugins/slick/slick-theme.css"> --}}
		{{-- <link rel="stylesheet" href="/plugins/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" /> --}}
		{{-- <link rel="stylesheet" href="/plugins/sweetalert-master/dist/sweetalert.css" type="text/css"/> --}}
		{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css"> --}}

		<!-- icons -->
		{{-- <link rel="stylesheet" href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css"> --}}

		<!--custom -->
		{{-- <link  rel="stylesheet" type="text/css" href="/css/style.css"> --}}
		<link  rel="stylesheet" type="text/css" href="/css/tailwind.css">

		@yield('head')
		@yield('css')
		
	</head>
	<body class="antialiased text-gray-900 h-screen bg-gray-200 flex flex-col">
        @yield('content')
		@yield('scripts')
	</body>
</html>
