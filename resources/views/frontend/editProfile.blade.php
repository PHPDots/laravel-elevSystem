@extends('frontend.layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            <div class="widget-header col-xs-12">
                <h5>{{ __('Bruger konto') }}</h5>
            </div> 
            <div class="widget-content col-xs-12 no-padding">
                {!! Form::model($user,['method' => 'POST','route'=> ['updateProfile',$user->id],'files' => true, 'class' => 'form-horizontal', 'id' => 'submit-form','redirect-url'=>route('myProfile')]) !!}
                
                <div class="form-row form-group">
                    <label class="col-xs-3 field-name" for="email">{{ __('E-mail') }} : </label>
                    <div class="col-xs-9">
                        <span class="col-xs-6">
                            {!! Form::text('email_id',null,['class'=>'col-xs-12','placeholder'=>__('E-mail')])!!}
                        </span>  
                    </div>
                </div>
                
                <div class="form-row form-group">
                    <label class="col-xs-3 field-name" for="email">{{ __('Telefonnummer') }}:</label>
                    <div class="col-xs-9">
                        <div class="col-xs-6">
                            {!! Form::text('phone_no',null,['class'=>'col-xs-12','placeholder'=>__('Telefonnummer')])!!}
                        </div>
                    </div>
                </div> 
                
                <div class="form-row form-group">
                    <label class="col-xs-3 field-name" for="email">{{ __('Other Phone Number') }}:</label>
                    <div class="col-xs-9">
                        <div class="col-xs-6">
                            {!! Form::text('other_phone_no',null,['class'=>'col-xs-12','placeholder'=>__('Other Phone Number')])!!}
                        </div>                        
                    </div>
                </div>

                <div class="form-row form-group">                
                    <div id="submitForm" class="fly_loading">
                        <!-- <img src="{{ asset('img/submit-form.gif') }}"> -->
                    </div>
                    <div class="col-xs-12" id="formControlls">
                        <button type="submit" class="btn btn-success"><i class='icon-ok icon-white'></i> Update</button>
                        <a href="{{ route('myProfile') }}" class="btn btn-danger"><i class="icon-remove icon-white"></i> Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection