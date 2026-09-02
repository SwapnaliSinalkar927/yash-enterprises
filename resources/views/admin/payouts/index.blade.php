@extends('admin.main')

@section('title', 'View Payouts')

@section('style')
<style>
    
</style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid pb-0">
        <div class="hk-pg-body">
            <div class="row mb-3 mt-3">
                <div class="col-md-12" id="error_section">
                    @if(\Session::get('status') == 'failed')
                        @include('admin.components.server-alert', ['status' => \Session::get('status')])
                    @endif
                    @if(\Session::get('status') == 'success')
                        @include('admin.components.server-alert', ['status' => \Session::get('status')])
                    @endif
                </div>
            </div>
            <section id="sec_10" class="hk-section" >
                <div class="hk-example card card-shadow card-wth-tabs  mt-3" >
                    <div class="card-header">
                        <h4>Payout List</h4>
                        @can('payout_create')
                        <div class="page-title-right">
                                <!-- Example split danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary add">Add Payout</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#uploadCSV">Add Bulk
                                        Payout</a>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content m-0">
                            <div class="tab-pane fade show active" id="prev_tab_9">
                                <div class="container py-3">
                                    <div class="row">
                                        <div class="col">
                                            <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Wholesaler</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Reason</th>
                                                        <th>UTR</th>
                                                        <th>Processed At</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                                 
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Wholesaler</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Reason</th>
                                                        <th>UTR</th>
                                                        <th>Processed At</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="html_tab_9">
                                <div class="hk-code-block">
                                    <button class="btn btn-icon btn-xs btn-flush-light btn-rounded flush-soft-hover"
                                        data-clipboard-snippet><span class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="copy"></i></span></span></button>
                                    <pre class="language-markup"></pre>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="script_tab_9">
                                <div class="hk-code-block">
                                    <button class="btn btn-icon btn-xs btn-flush-light btn-rounded flush-soft-hover"
                                        data-clipboard-snippet><span class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="copy"></i></span></span></button>
                                    <pre class="language-javascript"></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="uploadCSV" tabindex="-1" role="dialog" aria-labelledby="uploadCSVTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadCSVTitle">Upload CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bulk_payouts_upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Download a <a href="{{ asset('sample_csv/payouts.csv') }}" download>sample CSV template</a> to see an example of the format required.</p>
                                <div class="mt-3">
                                    <label for="formFile" class="form-label">Import CSV</label>
                                    <input class="form-control" type="file" name="file" accept=".csv" required="">
                                    <small>Only <code>.csv</code> files.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary waves-effect waves-light">Upload</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Only needed for the filename of export files.
            // Normally set in the title tag of your page.
            // document.title = "Payout Data";
            
            // Create search inputs in footer
            $("#example tfoot th").each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable initialisation
            var table = $("#example").DataTable({
                dom: '<"dt-buttons"Bf><"clear">lirtp',
                paging: true,
                autoWidth: true,
                responsive: true,
                stateSave: true,
                processing: true,
                serverSide: true,
                deferRender: true,  // Delay rendering of table
                language: { 
                    search: "",
                    searchPlaceholder: "Search",
                    sLengthMenu: "_MENU_ items",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>', // or '→'
                        previous: '<i class="ri-arrow-left-s-line"></i>' // or '←'
                    }
                },
                buttons: [
                    "colvis",
                    "csvHtml5",
                    "excelHtml5",
                ],
                initComplete: function(settings, json) {
                    var footer = $("#example tfoot tr");
                    $("#example thead").append(footer);
                },
                ajax: {
                url: "{{ route('admin.payouts.list') }}",
                data: function (d) {
                    // Append the outlet_id and payout_status to the data sent to the server
                    d.wholesaler_id = "{{ request()->get('wholesaler_id') }}"; // Replace with your method of getting outlet_id
                    d.payout_status = "{{ request()->get('payout_status') }}"; // Replace with your method of getting payout_status
                    }
                },
                columns: [
                    { 
                        data: 'wholesaler.name', 
                        name: 'wholesaler.name',
                        render: function(data, type, row) {
                            var name = row.wholesaler.name;
                            @can('wholesaler_show')
                                var showUrl = '{{ route('admin.wholesalers.show',':wholesalerID') }}'.replace(':wholesalerID', row.wholesaler.id);
                                name = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.wholesaler.name+'</a>';
                            @endcan
                            return name;
                        }
                    },
                    { data: 'amount', name: 'amount'},
                    { data: 'status', name: 'status' ,
                    render : function(data, type, row) {
                        if(row.status == 1)
                            return '<span class="badge badge-pill badge-soft-success font-size-11">Processed</span>';
                        else if(row.status == 2)
                            return '<span class="badge badge-pill badge-soft-danger font-size-11">Processing</span>';
                        else
                            return '<span class="badge badge-pill badge-soft-danger font-size-11">Failed</span>';
                    }
                },
               {
                    data: 'reason',
                    name: 'reason',
                    render: function(data, type, row) {
                        reason = row.reason ? row.reason : '<p class="text-danger">NA</p>';
                        return reason;
                    }
                },
                {
                    data: 'utr',
                    name: 'utr',
                    render: function(data, type, row) {
                        utr = row.utr ? row.utr : '<p class="text-danger">NA</p>';
                        return utr;
                    }
                },
                { data: 'processed_at', name: 'processed_at' ,
                    render : function(data, type, row) {
                        var d = new Date(row.processed_at);
                        month = ("0" + (d.getMonth() + 1)).slice(-2);
                        day = ("0" + d.getDate()).slice(-2);
                        return d.getFullYear() + '-' + month + '-' + day + ' ' + d.toTimeString().split(' ')[0];
                    }
                },
                ]
            });

            // Apply the search
            $("#example thead").on("keyup", "input", function() {
                table.column($(this).parent().index())
                    .search(this.value)
                    .draw();
            });
        });

    </script>
@endsection
