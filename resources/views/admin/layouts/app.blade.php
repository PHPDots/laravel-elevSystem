<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="title" content="{{ env('APP_SITE_TITLE')}}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ isset($page_title) ? $page_title:env('APP_SITE_TITLE') }}</title>
	    <link href="{{ asset('img/lisabeth/favicon-32.png') }}" sizes="16x16" type="image/png" rel="icon">
        <link href="{{ asset('css/admin/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/bootstrap-responsive.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/main.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/custom_style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/jquery.datetimepicker.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/chosen/chosen.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom.css?2345') }}" rel="stylesheet" type="text/css" />

            @yield('styles')        
    </head>
    
    <body>
        <div id="container" class="nosidebar">
        
            @include('admin.includes.header')

            <div class="mainNavigation nosidebar close-menu">
                <div class="innerNavigation">

                    @include('admin.includes.sidebar')

                </div>
            </div>

            <div id="content" class="content addUserPage nosidebar">
                    @yield('content')
            </div>
            <div class="clearfix"></div>

        </div>
        
        <script src="{{ asset('js/admin/jquery-1.8.3.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/ui/jquery-ui-1.9.2.custom.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/uniform/jquery.uniform.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/cleditor/jquery.cleditor.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/fancybox/jquery.fancybox.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/form-validate/jquery.validate.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/main.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/forms.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/fileuploader.js') }}" type="text/javascript"></script>
        <!-- <script src="{{ asset('js/admin/ossuploadergallery.js') }}" type="text/javascript"></script> -->
        <script src="{{ asset('js/admin/nestedsortable.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/jscolor/jscolor.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/jquery.datetimepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/chosen/chosen.jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/colorpicker/jscolor.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/jquery.scrollTo.min.js') }}" type="text/javascript"></script>
        <!-- <script src="{{ asset('js/admin/general.js') }}" type="text/javascript"></script> -->
        <script src="{{ asset('js/admin/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/jquery.sessionTimeout.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.bootstrap-growl.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/parsley.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('js/formSubmitJs.js?56576') }}"></script>

        @yield('scripts')
    
    </body>    
</html>
