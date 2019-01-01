<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="title" content="{{ env('APP_SITE_TITLE')}}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ isset($page_title) ? $page_title:env('APP_SITE_TITLE') }}</title>
        <link href="{{ asset('img/lisabeth/favicon-32.png') }}" sizes="16x16" type="image/png" rel="icon">
        <link href="{{ asset('css/front/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/fonts/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/fonts/fontstyle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/responsive.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/chosen/chosen.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/jquery.datetimepicker.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/front/jquery.rtable.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom.css?2345') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/buttons.css?2345') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('css/admin/datatables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/admin/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

            @yield('styles')
    </head>
    
    <body>
        <div id="main" class="container-fluid">
            <div class="header row">
                @include('frontend.includes.header')
                
                <div class="col-xs-12 col-sm-9">
                    @include('frontend.includes.breadcrumb')
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 navbar navbar-default menu menu-default">
                        <div class="side-bar">
                        
                            @include('frontend.includes.sidebar')

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-9 menu_ct">                    
                        @yield('content')
                    </div>
                </div>
                <div id="exc" style="display: none;"></div>
            </div>
        </div>
        
        <script src="{{ asset('js/front/jquery-1.9.0.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/fullcalendar/fullcalendar.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/general.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/jquery.datetimepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/jquery.scrollTo.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/ui/jquery-ui-1.9.2.custom.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/fancybox/jquery.fancybox.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/jquery.datetimepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/chosen/chosen.jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/chosen/chosen.proto.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/ossuploadergallery.js.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/jquery.rtable.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/front/table_custom.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/admin/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript">
            jQuery().ready(function(){
                jQuery('.submenu').hide();
                jQuery('.has-submenu').click(function(){
                    if(jQuery(this).hasClass('open-block')){
                        jQuery(this).find('.submenu').slideUp();
                        jQuery(this).removeClass('open-block');                        
                    }else{
                         jQuery(this).find('.submenu').slideDown();
                         jQuery(this).addClass('open-block');  
                    }
                });
                
                jQuery('.side-bar').height(jQuery(document).height());
            });
        </script>
        <script src="{{ asset('js/jquery.bootstrap-growl.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/parsley.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('js/formSubmitJs.js') }}"></script>
        @yield('scripts')
    </body>    
</html>
