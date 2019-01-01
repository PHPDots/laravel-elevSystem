@extends('admin.layouts.login')

@section('content')

<div class="login-container">    
    <div class="login">
        <div class="avatar">
            <a href="">
                <img src="{{ asset('img/lisabeth/logo2.png') }}">
            </a>
        </div>

        <div class="clearfix"></div>
        
        {!! Form::open(['route' => 'resetPassword.data', 'files' => true, 'class' => '', 'id' => 'submit-form','redirect-url'=>url('/admin')]) !!}

        {!! Form::password('password',['data-required' => 'true','class' => 'form-control', 'placeholder' => __('Indtast dit password her'), 'label' => FALSE, 'required'=>'required']) !!}

        {!! Form::password('password_confirmation',['data-required' => 'true','class' => 'form-control', 'placeholder' => __('Bekræft dit password her'),'label' => FALSE, 'required'=>'required']) !!}

        <button type="submit" class="fRight button button-blue">{{ __('Nulstil password') }}</button>
        <div class="clearfix"></div>

        {!! Form::close() !!}
    </div>
    
    <span>
        {!! __("&copy; Lisabeth") !!}
    </span>
</div>

@endsection
