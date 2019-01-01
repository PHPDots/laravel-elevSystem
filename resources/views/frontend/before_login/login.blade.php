@extends('frontend.layouts.login')

@section('content')
<div class="logo-img">
    <a href="{{ url('/') }}">
    	<img src="{{ asset('img/logo.png') }}" alt="Lisabeth">
    </a>
</div>

<div class="login-txt">
    <label>{{ __('Elev system') }} </label>                
</div>

<div class="form_ct detail">
    {!! Form::open(['route' => 'check_admin_login', 'files' => true, 'class' => '', 'id' => 'login-form']) !!}

        <div class="lbl">
        	{{ __('Login information finder du I din velkomstmail') }}
    	</div>
        <div class="form-group">
        	{!! Form::text('username',null,['data-required' => 'true','class' => 'form-control', 'placeholder' => __('Brugernavn'), 'label' => FALSE, 'required'=>'required']) !!}
        </div>
        <div class="form-group">
        	{!! Form::password('password',['data-required' => 'true','class' => 'form-control', 'placeholder' => __('Kodeord'),'label' => FALSE, 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn" name="login" id="submitBtn">{{ __('Login') }}</button>
        </div>
        <div class="lbl">
        	<a href="{{ route('forgotPassword.user') }}" class="forgotPasswordLink">{{ __('Glemt kodeord?') }}</a>
        </div>
            
	{!! Form::close() !!}
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#login-form').submit(function () {

            if (true)
            {
                $('#submitBtn').attr('disabled',true);
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
                        $('#submitBtn').attr('disabled',false);
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
                        $('#submitBtn').attr('disabled',false);
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