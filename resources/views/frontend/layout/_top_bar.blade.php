<!DOCTYPE html>
<html lang="en">
    

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
@if(Request::is('about-us'))
<title>Online Taxi Booking In Surat,  Car Rental - Cab Book Karo</title>
<meta name="description" content="Looking to book a cab for your next trip? We’re truely dedicated to make your travel experience as much simple and fun as possible!">
<meta name="keywords" content="Best cab booking service" />
@elseif(Request::is('oneway-routs'))
<title>One Way Taxi Booking Service - Cab Book Karo</title>
<meta name="description" content="We are provide Various One Way Routes for Your Trip.Discover hassle-free cab booking with our reliable and easy-to-use platform. Mumbai, Surat, Rajkot...">
<meta name="keywords" content="One way Cab Booking, Car Rental" />
@elseif(Request::is('service'))
<title>Best Taxi Booking Service, Car Rental - Cab Book Karo</title>
<meta name="description" content="Whether you need a ride to the airport, a night out, or just around town, we've got you covered.Book now and enjoy a hassle-free experience!">
<meta name="keywords" content=" One way cab surat, Taxi Service in mumbai " />
@elseif(Request::is('contact-us'))
<title>Best Taxi Booking Service, Car Rental - Cab Book Karo</title>
<meta name="description" content="Whether you need a ride to the airport, a night out, or just around town, we've got you covered.Book now and enjoy a hassle-free experience!">
<meta name="keywords" content=" One way cab surat, Taxi Service in mumbai " />
@else
<title>Cab Booking Service in Surat- Oceancab</title>
<meta name="description" content="Looking to book a cab for your trip? Discover hassle-free cab booking with our reliable platform.Book your cab today and enjoy a stress-free travel experience!">
<meta name="keywords" content="Cab book karo"/>
@endif

<head>
    <!--required meta tags-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--twitter og-->
    <meta name="twitter:site" content="@themetags" />
    <meta name="twitter:creator" content="@themetags" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="AutoHive - Car Rental HTML Template" />
    <meta name="twitter:description" content="Car Rental HTML Template, auto parts technology, car dealership & business Bootstrap 5 Html template. It is best and famous car rental company website template." />
    <meta name="twitter:image" content="#" />

    <!--facebook og-->
    <meta property="og:url" content="#" />
    <meta name="twitter:title" content="AutoHive - Car Rental HTML Template" />
    <meta property="og:description" content="Car Rental HTML Template, auto parts technology, car dealership & business Bootstrap 5 Html template. It is best and famous car rental company website template." />
    <meta property="og:image" content="#" />
    <meta property="og:image:secure_url" content="#" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="600" />

    <!--meta-->
    <meta name="description" content="Car Rental HTML Template, auto parts technology, car dealership & business Bootstrap 5 Html template. It is best and famous car rental company website template." />
    <meta name="author" content="ThemeTags" />

    <!--favicon icon-->
    <link rel="icon" href="{{asset('front-assets/assets/img/favicon.png')}}" type="image/png" sizes="16x16" />

    <!--title-->
    <title>AutoHive - HTML Template</title>

    <!--build:css-->
    <link rel="stylesheet" href="{{asset('front-assets/assets/css/main.css')}}" />
    <!-- endbuild -->

    <!--custom css-->
    <link rel="stylesheet" href="{{asset('front-assets/assets/css/custom.css')}}" />
    <link rel="stylesheet" href="{{asset('front-assets/assets/css/select2.min.css')}}" />
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

</head>