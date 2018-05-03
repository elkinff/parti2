 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#355C7D">
    <title>Parti2</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/app.css')}}">

    {{-- Favicon  --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('img/favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ secure_asset('img/favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('img/favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ secure_asset('img/favicon/site.webmanifest') }}">
	<meta name="msapplication-TileColor" content="#355C7D">

	{{-- Metas --}}
	<meta description="Disfruta ganando dinero con tu equipo!">

    {{-- Open Graph Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parti2co">
    <meta name="twitter:creator" content="@elkinff">
    <meta name="twitter:title" content="Empieza a jugar ya!">
    <meta name="twitter:description" content="Selecciona el partido, el equipo por el cual vas a apostar y en poco tiempo encontrarás tu match.">
    <meta name="twitter:image" content="https://parti2.com/img/banners/banner.jpg">

    
    {{-- Open Graph Facebook --}}
    <meta property="og:description" content="Selecciona el partido, el equipo por el cual vas a apostar y en poco tiempo encontrarás tu match."/>
    <meta property="og:url" content="www.parti2.com"/>
    <meta property="og:image" content="https://parti2.com/img/banners/banner.jpg"/>
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Parti2"/>

    {{-- Web Push Notifications --}}

    <link rel="manifest" href="/manifest.json" />

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
      var OneSignal = window.OneSignal || [];
      OneSignal.push(function() {
        OneSignal.init({
          appId: "a4698ecd-a0c4-4bd9-beed-acfa8bf8a45a",
        });
      });
    </script>


    {{-- Google Analytics --}}

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118696025-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-118696025-1');
    </script>
    
</head>




