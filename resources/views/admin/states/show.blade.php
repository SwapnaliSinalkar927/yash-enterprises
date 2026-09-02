@extends('admin.main')

@section('title', 'States Details')

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
        State's Detail
            {!! ($state->status==1) ? '<span class="badge badge-sm badge-success">Active</span>' : '<span class="badge badge-sm badge-danger">Inactive</span>' !!}
            @can('state_edit')
            <a href="{{ route('admin.states.edit', $state->id) }}" class="text-primary btn btn-rounded flush-soft-hover edit-button p-0" data-toggle="tooltip"
                data-placement="top" title="Edit" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            @endcan
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card card-wth-line">
                            <div class="card-line bg-primary table-card-line"></div>
                            <!-- <div class="card-body"></div> -->
                            <table class="table mb-0 mt-2" style="overflow-x:auto;display:table;">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name :</th>
                                        <td>{{ $state->name }}</td>
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
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card-line bg-primary table-card-line"></div>
                                <a href="{{ route('admin.wholesalers.index',['state_id' =>$state->id ]) }}">
                                    <div class="card card-shadow mb-0">
                                        <div class="card-header card-header-action">
                                            <h6>Total Wholesalers</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h2 class="mb-0">{{ $data['wholesaler'] }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card-line bg-primary table-card-line"></div>
                                <a href="{{ route('admin.generate-codes.index',['state_id' =>$state->id ]) }}">
                                    <div class="card card-shadow mb-0">
                                        <div class="card-header card-header-action">
                                            <h6>Code Used Count</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h2 class="mb-0">{{ $data['codeUsedCount'] }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card-line bg-primary table-card-line"></div>
                                <a href="{{ route('admin.orders.index',['state_id' => $state->id ]) }}">
                                    <div class="card card-shadow mb-0">
                                        <div class="card-header card-header-action">
                                            <h6>Order Count</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h2 class="mb-0">{{ $data['orderCount'] }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-wth-line p-3">
                            <h5 class="mb-3">Wholesalers in {{ $state->name }}</h5>
                            <!-- <div class="card-line bg-primary table-card-line"></div> -->
                            <!-- <div class="card-body"></div> -->
                            <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Order Count/Code Used</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>                                                 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Order Count/Code Used</th>
                                        <th>Created At</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="card-footer text-muted"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-wth-line p-3">
                            <h5 class="mb-3">Orders in {{ $state->name }}</h5>
                            <!-- <div class="card-line bg-primary table-card-line"></div> -->
                            <!-- <div class="card-body"></div> -->
                            <table id="order" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code Used</th>
                                        <th>Reward Staus</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>                                                 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code Used</th>
                                        <th>Reward Staus</th>
                                        <th>Created At</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="card-footer text-muted"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
         $(document).ready(function() {    
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
                ajax: "{{ route('admin.state.wholesalers.list',['state_id'=> $state->id]) }}",
                order: [[2, 'desc']],
                columns: [
                    { 
                        data: 'full_name',
                        name: 'full_name',
                        render: function(data, type, row) {
                            var full_name = row.full_name;
                            @can('wholesaler_show')
                                var showUrl = '{{ route('admin.wholesalers.show',':wholesalerID') }}'.replace(':wholesalerID', row.id);
                                full_name = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.full_name+'</a>';
                            @endcan
                            return full_name;
                        }
                    },
                    { 
                        data: 'mobile_number', 
                        name: 'mobile_number'
                    },
                    { data: 'orders_count', name: 'orders_count'},
                    { 
                        data: 'id',
                        render: function(data, type, row) {
                            var edit = '';
                            var show = '';
                            @can('wholesaler_edit')
                                var editURL = '{{ route('admin.wholesalers.edit',':wholesalerID') }}'.replace(':wholesalerID', row.id);
                                edit = '<a href="'+editURL+'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover edit-button" data-bs-original-title="Edit"> <span class="nav-icon-wrap"><i class="ri-pencil-fill"></i></span></a>';
                            @endcan
                            @can('wholesaler_show')
                                var showUrl = '{{ route('admin.wholesalers.show',':wholesalerID') }}'.replace(':wholesalerID', row.id);
                                show = '<a href="'+showUrl+'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover view-button" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="View"> <span class="nav-icon-wrap"><i class="ri-eye-fill"></i></span></a>';
                            @endcan
                            return edit + show;
                        }
                    }
                ]
            });

            // Apply the search
            $("#example thead").on("keyup", "input", function() {
                table.column($(this).parent().index())
                    .search(this.value)
                    .draw();
            });

            $("#order tfoot th").each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable initialisation
            var table = $("#order").DataTable({
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
                    var footer = $("#order tfoot tr");
                    $("#order thead").append(footer);
                },
                ajax: "{{ route('admin.state.orders.list',['state_id'=> $state->id]) }}",
                columns: [
                    { 
                        data: 'wholesaler.name', 
                        name: 'wholesaler',
                        render: function(data, type, row) {
                            var name = row.wholesaler.full_name;
                            @can('wholesaler_show')
                                var showUrl = '{{ route('admin.wholesalers.show',':wholesalerID') }}'.replace(':wholesalerID', row.wholesaler.id);
                                name = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.wholesaler.full_name+'</a>';
                            @endcan
                            return name;
                        }
                    },
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
            $("#order thead").on("keyup", "input", function() {
                table.column($(this).parent().index())
                    .search(this.value)
                    .draw();
            });

            created_at_data = "{{  $state->created_at }}";
            result = formattedDateTime(created_at_data);
            $(".created_at").html(result);
        });
    </script>
@endsection