@extends('admin.layouts.login')

@section('content')

<div class="login-container">    
    <div class="login">

        <h1 class="login_header">{{ __('Login') }}</h1>
        <div class="clearfix"></div>
        
        {!! Form::open(['route' => 'check_admin_login', 'files' => true, 'class' => '', 'id' => 'login-form']) !!}
        {{ csrf_field() }}
        {!! Form::text('username',null,['data-required' => 'true','class' => 'login-input', 'placeholder' => __('Indtast dit brugernavn her'), 'label' => '', 'required'=>'required']) !!}

        {!! Form::password('password',['data-required' => 'true','class' => 'password-input', 'placeholder' => __('Indtast dit password her'),'label' => '', 'required'=>'required']) !!}

        <div class="remember fLeft">
            <label class="form-button">
                <input type="checkbox" name="" id="UserRememberMe"> {{ __('Husk mig') }}
            </label>
        </div>
        <button type="submit" class="fRight button button-blue">{{ __('Login') }}</button>
        <div class="clearfix"></div>

        {!! Form::close() !!}
    </div>

    <div class="login-footer">
        <a href="{{ route('forgotPassword.admin') }}">{{ __('Glemt password?') }}</a>
    </div>
    
    <span>
        {!! __("&copy; Lisabeth") !!}
    </span>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#login-form').submit(function () {
            if (true)
            {
                //$('#submitBtn').attr('disabled',true);
                $('#AjaxLoaderDiv').fadeIn('slow');
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    enctype: 'multipart/form-data',
                    success: function (result)
                    {
                        //$('#submitBtn').attr('disabled',false);
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        if (result.status == 1)
                        {
                            $.bootstrapGrowl(result.msg, {type: 'success success-msg', delay: 4000});
                            @php
                                $url = url()->previous();
                            @endphp
                            window.location = '{{  $url }}';
                        }
                        else if (result.status == 2)
                        {
                            window.location = '{{  route("userTerms") }}';
                        }
                        else
                        {
                            $.bootstrapGrowl(result.msg, {type: 'danger error-msg', delay: 4000});
                        }
                    },
                    error: function (error)
                    {
                        //$('#submitBtn').attr('disabled',false);
                        $('#AjaxLoaderDiv').fadeOut('slow');
                        $.bootstrapGrowl("Internal server error !", {type: 'danger error-msg', delay: 4000});
                    }
                });
            }
            return false;
        });
    });
</script>
@endsection