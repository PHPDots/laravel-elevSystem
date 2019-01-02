@extends('frontend.layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 info">
        <p>
            Nedenfor kan du gense og downloade det materiale du har fået udleveret ved holdstart. 
        </p>
    </div>
    <div class="clearfix"></div>

    <div class="col-xs-12  info">
        <h3>
            {{ __('Dokumenter') }} 
            <div class="clearfix"></div>
        </h3>
        <table width="100%" style="font-size:14px;" id="server-side-datatables">
            <thead>
                <tr class="table_heading">
                    <th class="bill">{{ __('Title') }}</th>
                    <th class="bill" width="25%">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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
                "url": "{!! route('documents.data') !!}",
                "data": function ( data ) 
                {
                    //data.search_text = $("#search-frm input[name='search_text']").val();
                }
            },
            "order": [[ 0, "ASC" ]],
            columns: [
                { data: 'title', name: 'title' },
                { data: 'action', orderable: false, searchable: false},
            ]
        });
    });
    </script>
@endsection