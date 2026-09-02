@extends('admin.main')

@section('title', 'Login History')

@section('style')
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid p-5 pb-0">
        <div class="hk-pg-body">
            <section id="sec_10" class="hk-section">
                <div class="hk-example card card-shadow card-wth-tabs">
                    <div class="card-header">
                        <h4>Login History</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content m-0">
                            <div class="tab-pane fade show active" id="prev_tab_9">
                                <div class="container py-3">
                                    <div class="row">
                                        <div class="col">
                                            <table id="promoter" class="table table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Logged In At</th>
                                                        <th>Source IP</th>
                                                        <th>Browser</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                                 
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Logged In At</th>
                                                        <th>Source IP</th>
                                                        <th>Browser</th>
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
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Only needed for the filename of export files.
            //Normally set in the title tag of your page.
            document.title = "City Data";
            // Create search inputs in footer
            $("#promoter tfoot th").each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });
            // DataTable initialisation
            var table = $("#promoter").DataTable({
                dom: '<"dt-buttons"Bf><"clear">lirtp',
                paging: true,
                autoWidth: true,
                responsive: true,
                stateSave: true,
                processing: true,
                serverSide: true,
                //    scrollX:true,
                language: { search: "",
                    searchPlaceholder: "Search",
                    sLengthMenu: "_MENU_items",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>', // or '→'
                        previous: '<i class="ri-arrow-left-s-line"></i>' // or '←'
                    }
                },
                buttons: [
                    "colvis",
                    // "copyHtml5",
                    "csvHtml5",
                    "excelHtml5",
                    // "pdfHtml5",
                    // "print"
                ],
                initComplete: function(settings, json) {
                    var footer = $("#promoter tfoot tr");
                    $("#promoter thead").append(footer);
                },
                // scrollX:  true,
                type: 'GET',
                ajax: "{{ route('admin.login_history_list') }}",
                columns: [
                    { data: 'user.name', name: 'user.name' ,
                        render : function(data, type, row) {
                        
                            user_name = row.user.name;
                            @can('user_show')
                                showUrl = '{{ route('admin.users.show',':userID') }}'.replace(':userID', row.id);
                                user_name = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.user.name+'</a>'
                            @endcan
                            return user_name;
                        }
                    },
                    { data: 'created_at', name: 'created_at' ,
                        render : function(data, type, row) {
                        
                            var d = new Date(row.created_at);
                            month = ("0" + (d.getMonth() + 1)).slice(-2);
                            day = ("0" + d.getDate()).slice(-2);
                            return d.getFullYear() + '-' + month + '-' + day + ' ' + d.toTimeString().split(' ')[0];
                        }
                    },
                    { data: 'ip_address', name: 'ip_address' ,
                        render : function(data, type, row) {
                        
                            return row.ip_address;
                        }
                    },
                    { data: 'browser', name: 'browser' ,
                        render : function(data, type, row) {
                        
                            return row.browser;
                        }
                    },
                ]
            });
            $("#promoter thead").on("keyup", "input", function() {
                table.column($(this).parent().index())
                    .search(this.value)
                    .draw();
            });
        });
    </script>
@endsection
