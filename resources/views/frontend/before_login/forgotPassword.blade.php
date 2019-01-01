@extends('frontend.layouts.login')

@section('content')
<div class="logo-img">
    <a href="{{ url('/') }}">
    	<img src="{{ asset('img/logo.png') }}" alt="Lisabeth">
    </a>
</div>

<div class="login-txt">
    <label>{{ __('Student Portal') }} </label>                
</div>

<div class="form_ct detail">
    {!! Form::open(['route' => 'forgotPassword.data', 'files' => true, 'class' => '', 'id' => 'submit-form','redirect-url'=>url('/')]) !!}

        <div class="lbl">
        	{{ __('Glemt password') }}
    	</div>
        <div class="clearfix">&nbsp;</div>
        <div class="form-group">
        	{!! Form::text('verification_data',null,['data-required' => 'true','class' => 'form-control', 'placeholder' => __('Indtast bruger eller e-mail her'), 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn" name="login" id="submitBtn">{{ __('Nulstil password') }}</button>
        </div>
            
	{!! Form::close() !!}
</div>
@endsection
