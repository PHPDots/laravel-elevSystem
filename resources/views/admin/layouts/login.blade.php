<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="title" content="{{ isset($page_title) ? $page_title : env('APP_SITE_TITLE') }}" />
        <title>{{ isset($page_title) ? $page_title : env('APP_SITE_TITLE') }}</title>
        <link href="{{asset('img/lisabeth/favicon-32.png')}}" sizes="16x16" type="image/png" rel="icon">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link href="{{ asset('css/admin/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/bootstrap-responsive.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/main.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/custom_style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom.css?2345') }}" rel="stylesheet" type="text/css" />

        @yield('styles')
    </head>

    <body>
         
        <div class="login-wrapper">
            @yield('content')
        </div>
        <div id="AjaxLoaderDiv" style="display: none;z-index:99999 !important;">
            <div style="width:100%; height:100%; left:0px; top:0px; position:fixed; opacity:0; filter:alpha(opacity=40); background:#000000;z-index:999999999;">
            </div>
            <div style="float:left;width:100%; left:0px; top:50%; text-align:center; position:fixed; padding:0px; z-index:999999999;">
                <img src="{{ asset('/img/elev-loader.gif') }}" />                
            </div>
        </div>

        <script src="{{ asset('js/admin/jquery-1.8.3.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.bootstrap-growl.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/parsley.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('js/formSubmitJs.js') }}"></script>

        @yield('scripts')

    </body>

</html>    