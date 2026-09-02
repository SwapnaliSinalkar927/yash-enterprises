@extends('admin.main')

@section('title', 'Brand Details')

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
        Brand's Detail
            {!! ($brand->status==1) ? '<span class="badge badge-sm badge-success">Active</span>' : '<span class="badge badge-sm badge-danger">Inactive</span>' !!}
            @can('brand_edit')
            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="mr-3 text-primary" data-toggle="tooltip"
                data-placement="top" title="Edit" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            @endcan
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-wth-line">
                            <div class="card-line bg-primary table-card-line"></div>
                            <!-- <div class="card-body"></div> -->
                            <table class="table mb-0 mt-2" style="overflow-x:auto;display:table;">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name :</th>
                                        <td>{{ $brand->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Short Code :</th>
                                        <td>{{ $brand->short_code }}</td>
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
                     <div class="col-md-5">
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card-line bg-primary table-card-line"></div>
                                <a href="{{ route('admin.generate-codes.index',['brand_id' =>$brand->id ]) }}">
                                    <div class="card card-shadow mb-0">
                                        <div class="card-header card-header-action">
                                            <h6>Total Codes</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h2 class="mb-0">{{ $data_count['total_codes_used'] }}/{{ $data_count['total_codes'] }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card-line bg-primary table-card-line"></div>
                                <a href="{{ route('admin.orders.index',['brand_id' =>$brand->id ]) }}">
                                    <div class="card card-shadow mb-0">
                                        <div class="card-header card-header-action">
                                            <h6>Total Orders</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h2 class="mb-0">{{ $data_count['total_orders'] }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card-line bg-primary table-card-line"></div>
                                <a href="{{ route('admin.orders.index',['brand_id' =>$brand->id ]) }}">
                                    <div class="card card-shadow mb-0">
                                        <div class="card-header card-header-action">
                                            <h6>Total Order Values</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h2 class="mb-0">{{ $data_count['total_order_values'] }}</h2>
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
                            <!-- <div class="card-line bg-primary table-card-line"></div> -->
                             <h5>Total Codes</h5>
                                <table id="code" class="table table-bordered p-3" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Value</th>
                                        <th>WD</th>
                                        <th>Is Used</th>
                                        <th>Batch</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>                                                 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Value</th>
                                        <th>WD</th>
                                        <th>Is Used</th>
                                        <th>Batch</th>
                                        <th>Created At</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="card-footer text-muted"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-wth-line p-3">
                            <!-- <div class="card-line bg-primary table-card-line"></div> -->
                             <h5>Total Orders</h5>
                                <table id="example" class="table table-bordered p-3" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Wholesaler</th>
                                        <th>Code Used</th>
                                        <!-- <th>WD Code</th> -->
                                        <th>Value</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>                                                 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Wholesaler</th>
                                        <th>Code Used</th>
                                        <!-- <th>WD Code</th> -->
                                        <th>Value</th>
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
        $( document ).ready(function() {
            created_at_data = "{{  $brand->created_at }}";
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
                ajax: "{{ route('admin.brand.orders.list', ['brand_id' => $brand->id])  }}",
                columns: [
                    { 
                        data: 'wholesaler.full_name', 
                        name: 'wholesaler.full_name',
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
                            @can('code_show')
                                var showUrl = '{{ route('admin.generate-codes.show',':codeID') }}'.replace(':codeID', row.code.id);
                                code = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.code.code+'</a>';
                            @endcan
                            return code;
                        }
                    },
                    // { 
                    //     data: 'wd.code', 
                    //     name: 'wd.code',
                    //     render: function(data, type, row) {
                    //         if(row.wd_id){
                    //             var wdCode = row.brand.name;
                    //             @can('wd_show')
                    //             var url = '{{ route('admin.wds.show',':wdID') }}'.replace(':wdID', row.wd_id);
                    //             wdCode = '<a href="'+url+'">'+row.wd.name+'</a>'
                    //             @endcan
                    //             return wdCode;
                    //         }
                    //         else{
                    //             return '<i class="text-danger">NA</i>';
                    //         }
                    //     }
                    // },
                    { 
                        data: 'value',
                        name: 'value',
                        render: function(data, type, row) {
                            if(row.value)
                                return row.value;
                            else{
                                return '<i class="text-danger">NA</i>';
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

            $("#code tfoot th").each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable initialisation
            var table = $("#code").DataTable({
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
                    var footer = $("#code tfoot tr");
                    $("#code thead").append(footer);
                },
                ajax: "{{ route('admin.brand.codes.list', ['brand_id' => $brand->id])  }}",
                columns: [
                     {
                        data: 'code',
                        name: 'code',
                        render: function(data, type, row) {
                            var code = row.code;
                            @can('code_show')
                            var url = '{{ route('admin.generate-codes.show',':codeID') }}'.replace(':codeID', row.id);
                            code = '<a href="'+url+'">'+row.code+'</a>'
                            @endcan
                            return code;
                        }
                    },
                    {
                        data: 'value',
                        name: 'value',
                        render: function(data, type, row) {
                            return row.value;
                        }
                    },
                    {
                        data: 'wd.code',
                        name: 'wd.code',
                        render: function(data, type, row) {
                            if(row.wd_id){
                                var wdCode = row.wd.name;
                                @can('wd_show')
                                var url = '{{ route('admin.wds.show',':wdID') }}'.replace(':wdID', row.wd_id);
                                wdCode = '<a href="'+url+'">'+row.wd.code+'</a>'
                                @endcan
                                return wdCode;
                            }
                            else{
                                return '<i class="text-danger">NA</i>';
                            }
                        }
                    },
                    {
                        data: 'is_used',
                        name: 'is_used',
                        render: function(data, type, row) {
                            if(row.is_used == 1) {
                                return '<span class="badge badge-pill badge-soft-success font-size-11">Yes</span>';
                            } else {
                                return '<span class="badge badge-pill badge-soft-danger font-size-11">No</span>';
                            }
                        }
                    },
                    {
                        data: 'batch',
                        name: 'batch',
                        render: function(data, type, row) {
                            return row.batch;
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
            $("#code thead").on("keyup", "input", function() {
                table.column($(this).parent().index())
                    .search(this.value)
                    .draw();
            });
        });
    </script>
@endsection
