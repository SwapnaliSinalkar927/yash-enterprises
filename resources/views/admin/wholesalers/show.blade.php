@extends('admin.main')

@section('title', 'Wholesaler Details')

@section('style')
    <style>
        .status{
            border-bottom:white !important;
        }
        @media only screen and (min-width: 1160px) {
            #example {
                display : inline-table;
            }
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
                                                <th scope="row">Pincode :</th>
                                                <td>{{ $wholesaler->pincode }}</td>
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
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card-line bg-primary table-card-line"></div>
                                <a href="{{ route('admin.orders.index',['wholesaler_id' =>$wholesaler->id ]) }}">
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
                            @foreach($data_count['total_brand_count'] as $brand)
                            <div class="col-md-6 mb-3">
                                <div class="card-line bg-primary table-card-line"></div>
                                <a href="{{ route('admin.orders.index',['wholesaler_id' => $wholesaler->id, 'brand_id' => $brand->brand_id ]) }}">
                                    <div class="card card-shadow mb-0">
                                        <div class="card-header card-header-action">
                                            <h6>{{ $brand->brand_name }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h2 class="mb-0">{{ $brand->total_value }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="card card-wth-line p-3">
                            <h5>Total Orders</h5>
                            <!-- <div class="card-line bg-primary table-card-line"></div> -->
                                <table id="example" class="table table-bordered p-3" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Code Used</th>
                                        <th>Brand</th>
                                        <th>Value</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>                                                 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Code Used</th>
                                        <th>Brand</th>
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
                ajax: "{{ route('admin.wholesaler.orders.list', ['wholesaler_id' => $wholesaler->id])  }}",
                columns: [
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
                        data: 'brand.name', 
                        name: 'brand.name',
                        render: function(data, type, row) {
                            var brand = row.brand.name;
                            return brand;
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
