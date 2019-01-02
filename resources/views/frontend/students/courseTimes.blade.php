@extends('frontend.layouts.app')

@section('content')
<div class="row">
    <?php  
        $statuses   = array(
            'met'       => __('Complete'),
            'not_met'   => __('Not Met')
        );
    ?>
    <div class="col-xs-12 col-sm-12 info">
        <p>
            Hvis du skal på bane på Kolding køretekniske anlæg, kan du nedenfor se hvilen tid der er reserveret til dig på anlægget. Anvender din kørelærer andre køretekniske anlæg, har du fået besked om din banetid på anden vis.
        </p>
        <p style="color: red;">
            Vær opmærksom på at tiden nedenfor er det tidspunkt du skal være på Kolding Køretekniske anlæg. Du skal følge den aftale du har lavet med din kørelærer om transport og evt tidspunkt herfor. 
        </p>
    </div>

    <div class="col-xs-12 col-sm-7 info">
        <h3>
            {{ __('Banetider') }}
        </h3>
        <table class="notable rtable" id="server-side-datatables" width="100%" style="font-size:14px;">
            <thead>
                <tr class="table_heading">
                    <th class="bill">{{ __('Date') }}</th>
                    <th class="bill">{{ __('Tid') }}</th>
                    <th class="bill">{{ __('Område') }}</th>
                    <th class="bill">{{ __('Kørelærer') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-xs-12 col-sm-5">
        <div class="col-xs-12 grey-block">
            <h3>{{ __('Du har') }}</h3>
            <h4>				
				{{ $bookings }}{{ __(' banetider') }}
				<br/>
			</h4>
        </div>
        @if(isset($nextBooking) && !empty($nextBooking))
        <div class="col-xs-12 white-block">
            <h3>{{ __('Din næste køretid er: ') }}<br/>
                <span>{{ date('d/m/Y',strtotime($nextBooking->date)) }} <br/> {{ $nextBooking->time_slot }}
                </span>
            </h3>
        </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">

    $(document).ready(function(){

        $.fn.dataTableExt.sErrMode = 'throw';

        var oTableCustom = $('#server-side-datatables').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                "url": "{!! route('courseTimes.data') !!}",
                "data": function ( data ) 
                {
                    //data.search_text = $("#search-frm input[name='search_text']").val();
                }
            },
            "order": [[ 0, "ASC" ]],
            columns: [
                { data: 'date', name: 'date' },
                { data: 'time_slot', name: 'time_slot' },
                { data: 'area_slug', name: 'area_slug' },
                { data: 'user_id', name: '{{ TBL_USERS }}.firstname' },
            ]
        });
    });
    </script>
@endsection