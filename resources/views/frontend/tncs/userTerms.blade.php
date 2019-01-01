@extends('admin.layouts.app')
@section('content')
<div class="inner-content">
  <div class="row-fluid">
    <div class="row-fluid">
      <div class="widget">
        <div class="widget-header"><h5>{{ __('Meddelser') }}</h5></div>
        <div class="widget-content  termsForm">
          
          {!! Form::open(['url'=>route('userTermsUpdate'),'class'=>'form-horizontal','id'=>'submit-form','redirect-url'=>route('userTerms')]) !!}
          <?php $i = 1; ?>
          @if(count($notifications['details']) > 0)
            @foreach($notifications['details'] as $notification)
            <div class="form-row">
              <label class="span12">{{ $notification['terms'] }}</label>
              <div class="clearfix"></div>
              <div class="centerAlignedArea span12">
                <div class="radioStyle">
                  {!! Form::radio('data['.$notification["tnc_id"].']','yes',null,['id'=>'term'.$notification["id"].'No'])!!}
                  {{ __('Accepter') }}
                  {!! Form::radio('data['.$notification["tnc_id"].']','no',null,['id'=>'term'.$notification["id"].'No'])!!}
                  {{ __('Accepter ikke') }}
                </div>
              </div>
              <div class="clearfix"></div>
              <label class="span3 pull-right onDate"><b><i>
                [  {{ __('Date : ') }} {{ date('d.m.Y',  strtotime($notification['created'])) }} ]
              </i></b></label>
            </div>

            <?php $i++; ?>
            @endforeach
          @endif
          <div class="form-row centerAlignedArea">
            <div class="radioStyle">
              <button class="button button-green" type="submit" id="acceptedTerms">{{ __('Submit') }}</button>
              <a href="{{ route('logout') }}" class="button button-red">{{ __('Fortryd') }}</a>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')

@endsection