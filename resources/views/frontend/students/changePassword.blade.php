@extends('frontend.layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="widget">
            {!! Form::open(['route' => 'changePassword.data', 'files' => true, 'class' => 'form-horizontal', 'id' => 'submit-form','redirect-url'=>url('/')]) !!}
            <div class="widget-header col-xs-12">
                <h5>{{ __('User account') }}</h5>
            </div>   
            <div class="widget-content col-xs-12 no-padding">
                <div class="form-row form-group">
                    <label class="col-xs-3 field-name">{{ __('Kodeord') }} :</label>
                    <div class="col-xs-9">
                        <div class="col-xs-6">
                            {!! Form::password('password',['data-required' => 'false','class' => 'col-xs-12', 'placeholder' => __('indtast kodeord'),'label' => FALSE]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-row form-group">
                    <label class="col-xs-3">{{ __('Bekræft kodeord') }} :</label>
                    <div class="col-xs-9">
                        <div class="col-xs-6">
                            {!! Form::password('password_confirmation',['data-required' => 'false','class' => 'col-xs-12', 'placeholder' => __('indtast kodeord'),'label' => FALSE]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col-xs-12" id="formControlls">
                        <button type="submit" class="btn btn-success" id="submitBtn"><i class="icon-ok icon-white"></i> {{ __('Opdater') }}</button>
                        <a href="{{ route('myProfile') }}" class="btn btn-danger"><i class="icon-remove icon-white"></i> {{ __('Annuller') }}</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection