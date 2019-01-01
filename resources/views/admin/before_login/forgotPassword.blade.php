@extends('admin.layouts.login')

@section('content')

<div class="login-container">    
    <div class="login departmentContainer">

        <h3>{{ __('Nulstil password') }}</h3>
        <div class="clearfix"></div>
        
        {!! Form::open(['route' => 'forgotPassword.data', 'files' => true, 'class' => '', 'id' => 'submit-form','redirect-url'=>route('admin_login')]) !!}

        {!! Form::text('verification_data',null,['data-required' => 'true','class' => 'login-input', 'placeholder' => __('Indtast bruger eller e-mail her'), 'required'=>'required']) !!}

        <input type="hidden" name="type" value="1">
        <button type="submit" class="fRight button button-blue">{{ __('Nulstil password') }}</button>
        <div class="clearfix"></div>

        {!! Form::close() !!}
    </div>
    
    <span>
        {!! __("&copy; Lisabeth") !!}
    </span>
</div>

@endsection
