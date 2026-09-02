@extends('admin.main')

@section('title', 'Wholesaler Details')

@section('style')
    <style>
        .status{
            border-bottom:white !important;
        }
    </style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid p-5 pb-0">
        <h4 class="mb-sm-0 font-size-18">
        Wholesaler's Detail
            {!! ($wholesaler->status==1) ? '<span class="badge badge-sm badge-success">Active</span>' : '<span class="badge badge-sm badge-danger">Inactive</span>' !!}
            @can('wholesaler_edit')
            <a href="{{ route('admin.wholesalers.edit', $wholesaler->id) }}" class="text-primary btn btn-rounded flush-soft-hover edit-button p-0" data-toggle="tooltip"
                data-placement="top" title="Edit" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            @endcan
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-wth-line">
                                    <div class="card-line bg-primary table-card-line"></div>
                                    <h5 class="p-3">Personal Info</h5>
                                    <table class="table mb-0 mt-2" style="overflow-x:auto;display:table;">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Name :</th>
                                                <td>{{ $wholesaler->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobile Number :</th>
                                                <td>{{ $wholesaler->mobile_number }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">WD Code :</th>
                                                @if($wholesaler->wd)
                                                <td><a href="{{ route('admin.wds.show',$wholesaler->wd?->id) }}">{{ $wholesaler->wd?->code }}</a></td>
                                                @else
                                                <td><span class="badge badge-pill badge-soft-danger font-size-11">N/A</span></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th scope="row">Created At  :</th>
                                                <td class="created_at">

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="card-footer text-muted"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-wth-line">
                                            <div class="card-line bg-primary table-card-line"></div>
                                            <h5 class="p-3">Wholesaler Location Details</h5>
                                            <table class="table mb-0" style="overflow-x:auto;display:table;">
                                                <tbody>
                                                <tr>
                                                    <th scope="row">Pincode :</th>
                                                    <td>
                                                        @if($wholesaler->pincode)
                                                            <a href="{{ route('admin.pincodes.show', $wholesaler->pincode->id) }}">
                                                                {{ $wholesaler->pincode->code }}
                                                            </a>
                                                        @else
                                                            <span class="badge badge-pill badge-soft-danger font-size-11">N/A</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">City :</th>
                                                    <td>
                                                        @if($wholesaler->city)
                                                            <a href="{{ route('admin.cities.show', $wholesaler->city->id) }}">
                                                                {{ $wholesaler->city->name }}
                                                            </a>
                                                        @else
                                                            <span class="badge badge-pill badge-soft-danger font-size-11">N/A</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">State :</th>
                                                    <td>
                                                        @if($wholesaler->state)
                                                            <a href="{{ route('admin.states.show', $wholesaler->state->id) }}">
                                                                {{ $wholesaler->state->name }}
                                                            </a>
                                                        @else
                                                            <span class="badge badge-pill badge-soft-danger font-size-11">N/A</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="card-footer text-muted"></div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 mb-3">
                                        <div class="card-line bg-primary table-card-line"></div>
                                        <div class="card card-shadow mb-0">
                                            <div class="card-header card-header-action">
                                                <h6>Total Amount Won</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <h2 class="mb-0">₹ {{ $data['total_amount_won'] }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card-line bg-primary table-card-line"></div>
                                        <a href="{{ route('admin.payouts.index', ['wholesaler_id' => $wholesaler->id, 'payout_status' => '1']) }}">
                                            <div class="card card-shadow mb-0">
                                                <div class="card-header card-header-action">
                                                    <h6>Payout Credited</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h2 class="mb-0">₹ {{ $data['payout_credited'] }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card-line bg-primary table-card-line"></div>
                                        <a href="{{ route('admin.payouts.index', ['wholesaler_id' => $wholesaler->id, 'payout_status' => '0']) }}">
                                            <div class="card card-shadow mb-0">
                                                <div class="card-header card-header-action">
                                                    <h6>Payout Failed</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h2 class="mb-0">₹ {{ $data['payout_failed'] }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card-line bg-primary table-card-line"></div>
                                        <div class="card card-shadow mb-0">
                                            <div class="card-header card-header-action">
                                                <h6>Payout Pending</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <h2 class="mb-0">₹ {{ $data['payout_pending'] }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="card card-wth-line">
                                    <div class="card-line bg-primary table-card-line"></div>
                                    <h5 class="p-3">Wholesaler Payment Details</h5>
                                    <table class="table mb-0" style="overflow-x:auto;display:table;">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Payment Method :</th>
                                                <td>{{ $wholesaler->wholesalerPaymentDetails[0]->payment_method }}</td>
                                            </tr>
                                            @if($wholesaler->wholesalerPaymentDetails[0]->upi_id)
                                            <tr>
                                                <th scope="row">UPI ID :</th>
                                                <td>{{ $wholesaler->wholesalerPaymentDetails[0]->upi_id }}</td>
                                            </tr>
                                            @endif
                                            @if($wholesaler->wholesalerPaymentDetails[0]->ifsc_code)
                                            <tr>
                                                <th scope="row">IFSC Code</Code> :</th>
                                                <td>{{ $wholesaler->wholesalerPaymentDetails[0]->ifsc_code }}</td>
                                            </tr>
                                            @endif
                                            @if($wholesaler->wholesalerPaymentDetails[0]->account_number)
                                            <tr>
                                                <th scope="row">Account Number :</th>
                                                <td>{{ $wholesaler->wholesalerPaymentDetails[0]->account_number }}</td>
                                            </tr>
                                            @endif
                                            @if($wholesaler->wholesalerPaymentDetails[0]->account_holder_name)
                                            <tr>
                                                <th scope="row">Account Holder Name :</th>
                                                <td>{{ $wholesaler->wholesalerPaymentDetails[0]->account_holder_name }}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="card-footer text-muted"></div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card-line bg-primary table-card-line"></div>
                                        <a href="{{ route('admin.generate-codes.index',['wholesaler_id' =>$wholesaler->id ]) }}">
                                            <div class="card card-shadow mb-0">
                                                <div class="card-header card-header-action">
                                                    <h6>Code Used Count</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h2 class="mb-0">{{ $code_used }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card-line bg-primary table-card-line"></div>
                                        <a href="{{ route('admin.orders.index',['wholesaler_id' => $wholesaler->id ]) }}">
                                            <div class="card card-shadow mb-0">
                                                <div class="card-header card-header-action">
                                                    <h6>Order Count</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h2 class="mb-0">{{ $wholesaler->orders_count }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- @if($wholesaler->orders_count>0) -->
                            <div class="col-md-12">
                                <div class="card card-wth-line">
                                    <div class="card-line bg-primary table-card-line"></div>
                                    <h5 class="p-3">Order History</h5>
                                    <div class="p-3">
                                        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Code Used</th>
                                                    <th>Reward Status</th>
                                                    <th>Ordered At</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                                 
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Code Used</th>
                                                    <th>Reward Status</th>
                                                    <th>Ordered At</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="card-footer text-muted"></div>
                                </div>
                            </div>
                            <!-- @endif -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready(function() {
            created_at_data = "{{  $wholesaler->created_at }}";
            result = formattedDateTime(created_at_data);
            $(".created_at").html(result);

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
                ajax: "{{ route('admin.wholesaler.orders.list', ['wholesaler_id' =>  $wholesaler->id ])  }}",
                columns: [
                    { 
                        data: 'code.code', 
                        name: 'code.code',
                        render: function(data, type, row) {
                            var code = row.code.code;
                            @can('wholesaler_show')
                                var showUrl = '{{ route('admin.generate-codes.show',':codeID') }}'.replace(':codeID', row.code.id);
                                code = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.code.code+'</a>';
                            @endcan
                            return code;
                        }
                    },
                    { 
                        data: 'reward_status', 
                        name: 'reward_status',
                        render: function(data, type, row) {
                            var reward_status = row.reward_status;
                           if(reward_status == 1){
                                return '<span class="badge badge-pill badge-soft-success font-size-11">Yes</span>';
                           }
                           else{
                                return '<span class="badge badge-pill badge-soft-danger font-size-11">No</span>';
                           }
                        }
                    },
                    { 
                        data: 'created_at', 
                        name: 'created_at',
                        render: function(data, type, row) {
                            var d = new Date(row.created_at);
                            var month = ("0" + (d.getMonth() + 1)).slice(-2);
                            var day = ("0" + d.getDate()).slice(-2);
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
