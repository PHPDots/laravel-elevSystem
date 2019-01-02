@extends('frontend.layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="grey-block">
                    <h3>{{ __('Du har') }}</h3>
                    <h4>{{ $bookings }} {{ __('tider booket') }}<br/></h4>
                </div>
            </div>
        </div>

        <div class="col-xs-6 ">
            <?php if(isset($nextBooking) && !empty($nextBooking)) { ?>
            <div class="white-block">
                <h3>{{ __('Din næste køretid : ') }}<br/><span><?php echo (isset($nextBooking)) ? date('d.m.Y H:i',strtotime($nextBooking)): ''; ?></span></h3>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php  
        $statuses   = array(
            'met'       => __('Complete'),
            'not_met'   => __('Not Met')
        );
        $class      = ($authUser->role == STUDENT)?'col-sm-12':'';
    ?>
    <div class="col-xs-12 <?php echo $class; ?> info">
        <h3 class="table_title">
            {{ __('Dine bestilte og afholdte lektioner') }}
            <div class="clearfix">&nbsp;</div>
        </h3>
        <table class="notable rtable" id="server-side-datatables" width="100%" style="font-size:14px;">
		    <thead class="cf">
                <tr class="table_heading">
                    <th class="bill">{{ __('Lærer') }}</th>
                    <th class="bill">{{ __('Type') }}</th>
                    <th class="bill">{{ __('Start dato') }}</th>
                    <th class="bill">{{ __('Lektions tid') }}</th>
                    <th class="bill">{{ __('Status') }}</th>
                </tr>
            </thead>
		    <tbody>
		    </tbody>
		</table>
    </div>
    <div class="clearfix"></div>
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
                "url": "{!! route('drivingLessons.data') !!}",
                "data": function ( data ) 
                {
                    //data.search_text = $("#search-frm input[name='search_text']").val();
                }
            },
            "order": [[ 2, "ASC" ]],
            columns: [
                { data: 'teacherName', name: '{{ TBL_USERS }}.firstname' },
                { data: 'booking_type', name: 'booking_type' },
                { data: 'start_time', name: 'start_time' },
                { data: 'lesson_type', name: 'lesson_type' },
                { data: 'status', name: 'status' },
            ]
        });
    });
    </script>
@endsection