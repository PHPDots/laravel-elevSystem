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
    {!! Form::open(['route' => 'resetPassword.data', 'files' => true, 'class' => '', 'id' => 'submit-form','redirect-url'=>url('/')]) !!}

        <div class="lbl">
        	{{ __('Nulstil password') }}
    	</div>
        <div class="form-group">
        	{!! Form::password('password',['data-required' => 'true','class' => 'form-control', 'placeholder' => __('Indtast dit password her'), 'label' => FALSE, 'required'=>'required']) !!}
        </div>
        <div class="form-group">
        	{!! Form::password('password_confirmation',['data-required' => 'true','class' => 'form-control', 'placeholder' => __('Bekræft dit password her'),'label' => FALSE, 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn" name="login" id="submitBtn">{{ __('Nulstil password') }}</button>
        </div>
            
	{!! Form::close() !!}
</div>
@endsection
