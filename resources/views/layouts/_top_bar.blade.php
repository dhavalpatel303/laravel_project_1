<html class="loaded " lang="en" data-textdirection="ltr" style="--vh:3.86px;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Favicon icon -->
        <?php $site_logo = helpers::logo();?>
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('logo/'.$site_logo)}}">
        <title>Xtreme admin Template - The Ultimate Multipurpose admin template</title>
        <!-- Custom CSS -->
        <link href="{{asset('app-assets/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
        <link href="{{asset('app-assets/assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
        <link href="{{asset('app-assets/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
        <link href="{{asset('app-assets/dist/css/style.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/assets/extra-libs/prism/prism.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
<!-- BEGIN: Header-->
