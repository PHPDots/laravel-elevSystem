@extends('frontend.layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-7 info">
        <h3>{{ __('Din Profil') }}</h3>
        <div class="profile">
            <p>{{ __("Navn : ") }} {{ $user->firstname }} {{ $user->lastname}}<br/></p>
            <p>
                {{ __('Telefon nr. 1 : ') }} {{ $user->phone_no }} <br/>
            
                @if(!empty($user->other_phone_no))
                    {{ __('Telefon nr. 2 : ') }} {{ $user->other_phone_no }} <br/>
                @endif

                {{ __('E-mail : ') }} {{ $user->email_id }} <br/>
                {{ __('Adresse : ') }} {{ $user->address }} <br/>

                @if(!empty($user->city))
                    {{ __('By : ') }}{{ $user->city }} <br/>
                @endif

                @if(!empty($user->zip))
                    {{ __('Post nr. : ') }}{{ $user->zip }} <br/>
                @endif

                {{ __('Elev nummer : ') }} {{ $user->student_number }} <br/>            
          </p>
        </div>
        <a href="{{ route('editProfile') }}" class="btn btn-success">{{ __('Rediger') }}</a>
    </div>

    <div class="col-xs-12 col-sm-5 ">
        <div class="col-xs-12 grey-block" >
            <div class="col-xs-12 col-md-4 profile_pic">
                <?php if(isset($teacher->avatar_id) && $teacher->avatar_id != 0){ ?>
                    <img src="{{ $teacherImg }}" />
                <?php
                }else{ ?>
                    <img src="{{ asset('img/default-medium.png')}}" />
                <?php }
                ?>
            
            </div>
            <div class="col-xs-12 col-md-8">
                <h3>{{ __('Din kørelærer') }}</h3>
                <h4>
                    <?php
                    echo (isset($teacher) && !empty($teacher)) ? $teacher->firstname.' '.$teacher->lastname : 'Kommer senere';
                    ?>
                    <?php if(isset($teacher) && !empty($teacher->phone_no)) { ?>
                    <span><br/>
                        {{ __('Telefon : ') }} {{ $teacher->phone_no }}
                    </span>
                    <?php } ?>
                </h4>
            </div>
        </div>
    </div>    
 </div>

@endsection