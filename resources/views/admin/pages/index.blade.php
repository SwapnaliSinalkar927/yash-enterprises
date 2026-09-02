@extends('admin.main')

@section('title', 'Dashboard')

@section('style')
<style type="text/css">
    #wholesaler-login-history {
    width: 100%;
    height: 300px;
    }
    #chartdiv {
        width: 100%;
         height: 300px;
    }
    #no-wholesaler{
        width: 100%;
        height: 350px;
        display: none;
        justify-content: center; /* Horizontally center */
        align-items: center; /* Vertically center */
        display: none;
        margin: auto;
    }
    div.dataTables_wrapper div.dataTables_info {
        display: flex;
        align-items: center;
        height: auto;
    }
    .chart-container {
        width: 450px;
        height: 360px;
        padding: 10px;
    }
    #orderHistory {
        width: 100%;
        height: 500px;
        max-width: 100%
    }
    #noOfOutletsPurchasedOnDailyBasis, #maps, #outletsInfo {
        width: 100%;
        height: 500px;
    }
    .dschart {
        font-size: 14px;
        font-weight: 900;
       fill: rgb(55, 61, 63);
    }
    .pack40 {
        background-color: #ff36ab;
    }
    .pack100 {
        background-color: #72ddf7;

    }
    .pack200 {
        background-color: #c02ff3;

    }
    .pack400 {
        background-color: #0069f7;

    }
    #datable_1_filter{
      margin-left:30px !important;
    }
    #targetchart{
        width: 100%;
        height: 300px;
    }

    #ds_chart {
        max-width: 650px;
        margin-left:20px;
        margin-top:1px;
    }


    /**/
    .mini-stat-icon {
        overflow: hidden;
        position: relative;
    }
    .avatar-sm {
        height: 3rem;
        width: 3rem;
    }
    .mini-stats-wid .mini-stat-icon {
        overflow: hidden;
        position: relative;
    }
    .mini-stat-icon::after, .mini-stat-icon::before {
        content: "";
        position: absolute;
        width: 8px;
        height: 54px;
        background-color: rgba(255,255,255,.1);
        left: 16px;
        -webkit-transform: rotate(32deg);
        transform: rotate(32deg);
        top: -5px;
        -webkit-transition: all .4s;
        transition: all .4s;
    }
    .mini-stat-icon::after {
        left: -12px;
        width: 12px;
        -webkit-transition: all .2s;
        transition: all .2s;
    }
    .avatar-title {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background-color: #556ee6;
        color: #fff;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        font-weight: 500;
        height: 100%;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 100%;
    }
    .font-size-24 {
        font-size: 24px!important;
    }
    .wid12per{
        width: 15%;
    }
    .ce_ixelgen_progress_bar {
	max-width: 800px;
	margin: 0 auto;
    .progress_bar_item {
        margin-bottom: 2rem;
    }
    .item_label,
    .item_value {
		font-size: 15px;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }
	.item_value {
		font-weight: 400;
	}
    .item_bar {
        position: relative;
        height: 14px;
        width: 100%;
        background-color: #d9d0d0;
        border-radius: 4px;
        
    }
    .progress {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
			height: 14px;
			margin: 0;
            background-color: #6771DC !important;
            border-radius: 4px;
            transition: width 100ms ease;
        }
}
#chartdiv {
  width: 100%;
  height: 500px;
}
#coupon-utilization {
  width: 100%;
  height: 500px;
}
</style>
@endsection

@section('content')

<div class="hk-pg-wrapper">
    <div class="container-fluid p-5 pb-0">
        <!-- Page Header -->
        <div class="hk-pg-header">
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
            <div class="d-flex">
                <div class="d-flex flex-wrap justify-content-between flex-1">
                    <div class="mb-lg-0 mb-2 me-8">
                        <h1 class="pg-title">Welcome back</h1>
                    </div>
                  
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Page Body -->
        <div class="hk-pg-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab_block_1">
                    <div class="row">
                    <div class="col-md-4 mb-md-4 mb-3">
                            <a href="{{ route('admin.orders.index') }}">
                                <div class="card card-shadow mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Total WD Codes</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h2 class="mb-0" id="total_wd">0</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-md-4 mb-3">
                            <a href="{{ route('admin.wholesalers.index') }}">
                                <div class="card card-shadow mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Total SWD</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center text-align-center">
                                            <div class="flex-grow-1">
                                                <h2 class="mb-0" id="total_swds">0</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-md-4 mb-3">
                            <a href="{{ route('admin.wholesalers.index') }}">
                                <div class="card card-shadow mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Total Retailer</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center text-align-center">
                                            <div class="flex-grow-1">
                                                <h2 class="mb-0" id="total_retailers">0</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                         <div class="col-md-4 mb-md-4 mb-3">
                            <a href="{{ route('admin.wholesalers.index') }}">
                                <div class="card card-shadow mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Total Hawkers</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center text-align-center">
                                            <div class="flex-grow-1">
                                                <h2 class="mb-0" id="total_hawkers">0</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-md-4 mb-3">
                            <a href="{{ route('admin.generate-codes.index') }}">
                                <div class="card card-shadow mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Total Codes</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h2 class="mb-0" id="total_codes">0/0</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-md-4 mb-3">
                            <a href="{{ route('admin.orders.index') }}">
                                <div class="card card-shadow mb-0 h-100">
                                    <div class="card-header card-header-action">
                                        <h6>Total Orders</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h2 class="mb-0" id="total_order">0</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-md-4 mb-3">
                            <div class="card card-shadow mb-0 h-100" style="padding:10px;">
                                <h5 class="">Orders Per Day</h5>
                                <div id="participation-card">
                                    <canvas id="loginChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 mb-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="">Location Wise Sale</h5>
                                    </div>
                                    <div class="list-group" id="topLocation" style="display: block;"> 
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-6 mb-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="">Pincode Wise Sale</h5>
                                        </div>
                                        <div class="list-group" id="topLocation" style="display: block;"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="">WD Wise Sale</h5>
                                        </div>
                                        <div class="list-group" id="topWd" style="display: block;"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="">Order By User Type</h5>
                                        </div>
                                        <div class="list-group" id="userType" style="display: block;"> 
                                            <div id="chartdiv"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="">Coupon Utilization</h5>
                                        </div>
                                        <div class="list-group" id="couponUtilization" style="display: block;"> 
                                            <!-- <canvas id="doubleBarChart" height="300"></canvas> -->
                                             <div id="coupon-utilization"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6 mb-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="">WD Wise Sale</h5>
                                        </div>
                                        <div class="list-group" id="topWd" style="display: block;"> 
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <!-- <div class="col-md-5 mb-md-4 mb-3">
                            <div class="card card-shadow mb-0 h-100" style="padding:10px;">
                                <h5 class="">Brand Wise Sale</h5>
                                <div id="brand-sale">
                                    <div id="chartdiv"></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <!-- <div class="col-md-6 mb-md-4 mb-3">
                            <div class="card card-shadow mb-0 h-100" style="padding:10px;">
                                <h5 class="">Brand Wise Sale</h5>
                                <div id="brand-sale">
                                    <div id="chartdiv"></div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6 mb-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="">Location Wise Sale</h5>
                                    </div>
                                    <div class="list-group" id="topLocation" style="display: block;"> 
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6 mb-md-4 mb-3">
                            <div class="card card-shadow mb-0 h-100" style="padding:10px;">
                                <h5 class="">Wholesaler Login History</h5>
                                <div id="wholesaler-login-history-section">
                                    <div id="wholesaler-login-history"></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-md-4 mb-3">
                            <div class="card card-shadow mb-0 h-100" style="padding:10px;">
                                <h5 class="">Top 10 Wholesalers</h5>
                                <table  id="example" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile Number</th>
                                            <th>Pincode</th>
                                            <th>Order Count</th>
                                            <th>Order Values</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile Number</th>
                                            <th>Pincode</th>
                                            <th>Order Count</th>
                                            <th>Order Values</th>
                                            <th>Created At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Body -->
    </div>
@endsection

@section('script')

<script src="{{ asset('admin/js/dashboard-data.js') }}"></script>

<script src="https://cdn.amcharts.com/lib/5/themes/Responsive.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#region').on('change', function() {
             var selectedRegion = $(this).val();
               $.ajax({
                    url: '/admin/set-region-session', // your route
                    type: 'GET',
                    data: { region: selectedRegion },
                    success: function(response) {
                        console.log(response);
                          if (response.success) {
                            location.reload();
                        }
                    }
                });
        });
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
            // stateSave: true,
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
            ajax: "{{ route('admin.top-wholesalers.list') }}",
            order: [[2, 'desc']],
            columns: [
                { 
                    data: 'full_name', 
                    name: 'full_name',
                    render: function(data, type, row) {
                        var name = row.full_name;
                        @can('wholesaler_show')
                            var showUrl = '{{ route('admin.wholesalers.show',':wholesalerID') }}'.replace(':wholesalerID', row.id);
                            name = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.full_name+'</a>';
                        @endcan
                        return name;
                    }
                },
                { data: 'mobile_number', name: 'mobile_number'},
                // { data: 'orders_count', name: 'orders_count'},
                { data: 'pincode', name: 'pincode'},
                 { data: 'latest_orders_count', name: 'latest_orders_count'},
                {
                    data: 'brand_sums',
                    name: 'brand_sums',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                         function formatNumberValue(num) {
                            num = parseFloat(num);
                            return (num % 1 !== 0) ? num.toFixed(2) : num;
                        }
                        if (!data || data.length === 0) {
                            return '<span class="text-muted">No Orders</span>';
                        }

                        return data.map(function(brand) {
                            return brand.brand_name + ' : ' + formatNumberValue(brand.total_value);;
                        }).join(', ');
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

        $.ajax({
            url: "{{ route('admin.count_data') }}",
            type: 'GET',
            success: function(data) {
                // Process the received data and render it on your graph
                console.log(data);
                // $("#total_wholesalers").html(data.wholesalerCount);
                $("#total_codes").html( data.usedCode + ' \\ ' +  data.totalCode);
                $("#total_wd").html(data.wds);
                $("#total_order").html(data.orders);
                $("#total_swds").html(data.swd);
                $("#total_retailers").html(data.retailer);
                $("#total_hawkers").html(data.hawker);
            },
        });

        $.ajax({
            url: "{{ route('admin.location-wise-sale') }}",
            type: 'GET',
            success: function(data) {
                console.log(data);
                resultLength = data.length;
                if(resultLength == 0){
                    $("#topLocation").html('<p>Required Data not available</p>');
                    $("#topLocation").css({
                        height: "300px",
                        textAlign: "center",
                        display: "flex",
                        justifyContent: "center",
                        alignItems: "center",
                    });
                }else{
                    var $container = $('#topLocation');
                    $container.empty(); // Clear existing content
                    data.forEach(function (item) {
                        var html = `
                            <div class="list-group-item top-download-item">
                                <a class="content-achor-link" href="javascript:void(0)">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-grow-1" id="content_file_name">
                                            <h6 class="mb-0 line-clamp-2">${item.wholesaler_pincode}</h6>
                                            <p class="mb-0 text-muted">wholesaler count: ${item.wholesaler_count}</p>
                                        </div>
                                        <div class="text-end top-download-count">
                                            <h5 title="Order Value" class="mb-0">${item.total_value}</h5>
                                            <p class="text-muted mb-0">Order Value</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;

                        $container.append(html);
                    });

                    $container.show(); // Make sure it's visible if hidden
                }
            },
        });

        //  $.ajax({
        //     url: "{{ route('admin.wd-wise-sale') }}",
        //     type: 'GET',
        //     success: function(data) {
        //         console.log(data);
        //         resultLength = data.length;
        //         if(resultLength == 0){
        //             $("#topWd").html('<p>Required Data not available</p>');
        //             $("#topWd").css({
        //                 height: "300px",
        //                 textAlign: "center",
        //                 display: "flex",
        //                 justifyContent: "center",
        //                 alignItems: "center",
        //             });
        //         }else{
        //             var $container = $('#topWd');
        //             $container.empty(); // Clear existing content
        //             data.forEach(function (item) {
        //                 var html = `
        //                     <div class="list-group-item top-download-item">
        //                         <a class="content-achor-link" href="javascript:void(0)">
        //                             <div class="d-flex justify-content-between align-items-center">
        //                                 <div class="flex-grow-1" id="content_file_name">
        //                                     <h6 class="mb-0 line-clamp-2">${item.wd_code}</h6>
        //                                     <p class="mb-0 text-muted">wholesaler count: ${item.unique_wholesalers}</p>
        //                                 </div>
        //                                 <div class="text-end top-download-count">
        //                                     <h5 title="Order Value" class="mb-0">${item.total_value}</h5>
        //                                     <p class="text-muted mb-0">Order Value</p>
        //                                 </div>
        //                             </div>
        //                         </a>
        //                     </div>
        //                 `;

        //                 $container.append(html);
        //             });

        //             $container.show(); // Make sure it's visible if hidden
        //         }
        //     },
        // });

        $.ajax({
            url: "{{ route('admin.wd-wise-sale') }}",
            type: 'GET',
            success: function(data) {

                // Number Format Function
                function formatNumber(num) {
                    num = parseFloat(num);

                    // If number has decimal, show 2 decimal places
                    if (num % 1 !== 0) {
                        return num.toFixed(2);
                    }

                    // If whole number, return as is
                    return num;
                }

                console.log(data);
                resultLength = data.length;

                if (resultLength == 0) {
                    $("#topWd").html('<p>Required Data not available</p>');
                    $("#topWd").css({
                        height: "300px",
                        textAlign: "center",
                        display: "flex",
                        justifyContent: "center",
                        alignItems: "center",
                    });
                } else {
                    var $container = $('#topWd');
                    $container.empty(); // Clear existing content

                    data.forEach(function(item) {

                        var html = `
                            <div class="list-group-item top-download-item">
                                <a class="content-achor-link" href="javascript:void(0)">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-grow-1" id="content_file_name">
                                            <h6 class="mb-0 line-clamp-2">${item.wd_code}</h6>
                                            <p class="mb-0 text-muted">wholesaler count: ${item.unique_wholesalers}</p>
                                        </div>
                                        <div class="text-end top-download-count">
                                            <h5 title="Order Value" class="mb-0">${formatNumber(item.total_value)}</h5>
                                            <p class="text-muted mb-0">Order Value</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;

                        $container.append(html);
                    });

                    $container.show();
                }
            },
        });


        // let week = $('#weekSelect').val();
        fetchWholesalerParticipation();
        // Declare the loginChart variable globally
        let loginChart = null;

        // Function to handle the AJAX request
        function fetchWholesalerParticipation(week) {
            $.ajax({
                url: "{{ route('admin.wholesaler_participation') }}",
                type: 'GET',
                success: function(result) {
                    console.log(result);
                    const allOrderCountsAreZero = result.every(item => item.order_count === 0);
                    if(allOrderCountsAreZero){
                        $("#participation-card").html('<p>Required Data not available</p>');
                        $("#participation-card").css({
                            height: "300px",
                            textAlign: "center",
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                        });
    
                    }else{
                        console.log(result);
                        // Initialize the chart
                        const ctx = document.getElementById('loginChart').getContext('2d');
                        loginChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [], // Days of the week
                                datasets: [{
                                    label: 'Orders',
                                    data: [],
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });

                        const dataArray = result; // Access the first (and only) element of the result array

                        const labels = [];
                        const data = [];

                        // Loop through the dataArray to fill labels and data
                        dataArray.forEach(item => {
                            labels.push(item.date); // Extract date
                            data.push(item.order_count); // Extract login count
                        });

                        // Update the chart with the fetched data
                        loginChart.data.labels = labels;
                        loginChart.data.datasets[0].data = data;

                        // Refresh the chart
                        loginChart.update();
                    }
                },
            });
        }
        progress_bar();
    });

 
function progress_bar() {
    var speed = 10;
    var items = $('.progress_bar').find('.progress_bar_item');

    items.each(function() {
        var item = $(this).find('.progress');
        var itemValue = parseFloat(item.data('progress')).toFixed(2); // Ensure decimal format
        var orderCount = item.data('ordercount');
        var target = item.data('target');
        console.log(itemValue);
        var i = 0;
        var value = $(this);

        var count = setInterval(function() {
            if (i <= itemValue) {
                var iStr = i.toFixed(2); // Format as decimal
                item.css({
                    'width': iStr + '%'
                });
                // Display percentage and order count
                value.find('.item_value').html(itemValue + '% (' + orderCount + ' / ' + target +')');
            } else {
                clearInterval(count);
            }
            i += 0.1; // Increment in decimals for smooth progress
        }, speed);
    });
}

 $.ajax({
    url: "{{ route('admin.order-by-usertype') }}",
    type: 'GET',
    success: function(data) {
        console.log(data);
        swdOrders = data.swdOrders;
        retailerOrders = data.retailerOrders;
        hawkerOrders = data.hawkerOrders;
        if(swdOrders == 0 && retailerOrders == 0 && hawkerOrders == 0){
            $("#userType").html('<p>Required Data not available</p>');
            $("#userType").css({
                height: "300px",
                textAlign: "center",
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
            });
        }else{
            am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
            am5themes_Animated.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "none",
            wheelY: "none",
            paddingLeft: 0
            }));

            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xRenderer = am5xy.AxisRendererX.new(root, { 
            minGridDistance: 30,
            minorGridEnabled: true
            });

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0,
            categoryField: "name",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
            }));

            xRenderer.grid.template.set("visible", false);

            var yRenderer = am5xy.AxisRendererY.new(root, {});
            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0,
            min: 0,
            extraMax: 0.1,
            renderer: yRenderer
            }));

            yRenderer.grid.template.setAll({
            strokeDasharray: [2, 2]
            });

            // Create series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Series 1",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            sequencedInterpolation: true,
            categoryXField: "name",
            tooltip: am5.Tooltip.new(root, { dy: -25, labelText: "{valueY}" })
            }));


            series.columns.template.setAll({
            cornerRadiusTL: 5,
            cornerRadiusTR: 5,
            strokeOpacity: 0
            });

            series.columns.template.adapters.add("fill", (fill, target) => {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", (stroke, target) => {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            // Set data
            var data = [
            {
                name: "SWD",
                value: swdOrders,
                // bulletSettings: { src: "https://www.amcharts.com/lib/images/faces/A04.png" }
            },
            {
                name: "Retailer",
                value: retailerOrders,
                // bulletSettings: { src: "https://www.amcharts.com/lib/images/faces/C02.png" }
            },
            {
                name: "Hawker",
                value: hawkerOrders,
                // bulletSettings: { src: "https://www.amcharts.com/lib/images/faces/D02.png" }
            },
            ];

            series.bullets.push(function() {
            return am5.Bullet.new(root, {
                locationY: 1,
                sprite: am5.Picture.new(root, {
                templateField: "bulletSettings",
                width: 50,
                height: 50,
                centerX: am5.p50,
                centerY: am5.p50,
                shadowColor: am5.color(0x000000),
                shadowBlur: 4,
                shadowOffsetX: 4,
                shadowOffsetY: 4,
                shadowOpacity: 0.6
                })
            });
            });

            xAxis.data.setAll(data);
            series.data.setAll(data);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

            }); 
        }
    },
});

 $.ajax({
    url: "{{ route('admin.coupon-utilization') }}",
    type: 'GET',
    success: function(response) {
        console.log(response);
        if(response.couponHalf == 0 && response.coupon1 == 0){
            $("#couponUtilization").html('<p>Required Data not available</p>');
            $("#couponUtilization").css({
                height: "300px",
                textAlign: "center",
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
            });
        }else{
            const wdCodes = ['0.6 M Coupon', '2 M Coupon', '5 M Coupon'];

            am5.ready(function() {

                // Create root element
                var root = am5.Root.new("coupon-utilization");

                // Set themes
                root.setThemes([
                    am5themes_Animated.new(root)
                ]);

                // Create chart
                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                    panX: false,
                    panY: false,
                    paddingLeft: 0,
                    wheelX: "panX",
                    wheelY: "zoomX",
                    layout: root.verticalLayout
                }));

                // Add legend
                var legend = chart.children.push(
                    am5.Legend.new(root, {
                    centerX: am5.p50,
                    x: am5.p50
                    })
                );
                var data = [
                    {
                    "couponType": "0.2 M Coupon",
                    "used": response.couponUsed06,
                    "total": response.coupon06
                    },
                    {
                    "couponType": "2 M Coupon",
                    "used": response.couponUsed20,
                    "total": response.coupon20
                    },
                     {
                    "couponType": "5 M Coupon",
                    "used": response.couponUsed50,
                    "total": response.coupon50
                    },
                ];

                // Create axes
                var xRenderer = am5xy.AxisRendererX.new(root, {
                    cellStartLocation: 0.1,
                    cellEndLocation: 0.9
                });

                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                    categoryField: "couponType",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(root, {})
                }));

                xRenderer.grid.template.setAll({
                    location: 1
                });

                xAxis.data.setAll(data);

                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                    renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                    })
                }));

                // ✅ Function to create each bar series
                function makeSeries(name, fieldName, color) {
                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: fieldName,
                    categoryXField: "couponType"
                    }));

                    series.columns.template.setAll({
                    tooltipText: "{name}\n{categoryX}: {valueY}",
                    width: am5.percent(45), // Make bars wider and closer
                    tooltipY: 0,
                    strokeOpacity: 0,
                    fill: color
                    });

                    series.data.setAll(data);
                    series.appear();

                    // Show value labels
                    series.bullets.push(function() {
                    return am5.Bullet.new(root, {
                        locationY: 0,
                        sprite: am5.Label.new(root, {
                        text: "{valueY}",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: 0,
                        centerX: am5.p50,
                        populateText: true
                        })
                    });
                    });

                    legend.data.push(series);
                }

                // ✅ Only two bars per category
                makeSeries("Used Coupon", "used", am5.color(0x3366cc));   // Blue
                makeSeries("Total Coupon", "total", am5.color(0xff9933));  // Orange

                // Animate chart
                chart.appear(1000, 100);

                });
        }
    },
});



</script>
@endsection
