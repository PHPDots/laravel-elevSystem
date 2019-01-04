@extends('frontend.layouts.app')

@section('content')

<?php $authUser = \Auth::user(); ?>
<div class="row">
    <div class="col-xs-12 col-sm-8 info">

        <h3>{{ __('Hej ') }}
        	{{ ucfirst($authUser->firstname) }} {{ ucfirst($authUser->lastname) }}
        </h3>
        
        <p>
            Velkommen til vores online elev system.
            Via systemet kan du få adgang til at se dine køretider, overblik over din økonomi, ændre dine
            stamdata, samt se og genfinde det materiale du har fået udleveret til holdstart.
            Systemet er under opbygning og test, hvorfor der kan forekomme enkelte fejl. Skulle du støde
            på system fejl, eller har forslag til forbedringer mv. til systemet, bedes du henvende dig pr. mail
            <a href="mailto:morten.s@lisbeth.dk">morten.s@lisbeth.dk</a>
        </p>
    </div>
    <div class="col-xs-12 col-sm-4">
        <?php 
        $class = ($authUser->balance < 0) ? 'green' : 'red'; 
        if($message != '') { ?>
        <div class="<?php echo $class; ?>-block col-xs-12">
            <h3>{{ $message }}</h3>
        </div>
        <?php } ?>
        <?php if(isset($nextBooking) && !empty($nextBooking)) { ?>
        <div class="white-block col-xs-12">
            <h3>{{ __('Din næste køretid :') }}<br/>
                <span>{{ date('d/m/Y',strtotime($nextBooking->date)) }} <br/> {{ date('H:i',strtotime($nextBooking->time_slot)) }}</span>
            </h3>
        </div>
        <?php } ?>
    </div>
</div>    


@endsection