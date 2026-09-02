@extends('admin.main')

@section('title', 'Admin Customer')

@section('style')
    <style>
        .table-card-line {
            height: 4px !important;
        }
        .customer-count{
            color: #6F6F6F;
            font-weight: 700;
        }
    </style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid p-5 pb-0">
        <h4 class="mb-sm-0 font-size-18">
        Code Detail
            {!! ($codeDetail->status==1) ? '<span class="badge badge-sm badge-success">Active</span>' : '<span class="badge badge-sm badge-danger">Inactive</span>' !!}
            @can('code_edit')
            <a href="{{ route('admin.generate-codes.edit', $codeDetail->id) }}" class="text-primary btn btn-rounded flush-soft-hover edit-button p-0" data-toggle="tooltip"
                data-placement="top" title="Edit" data-original-title="Edit"><i class="ri-pencil-fill"></i></a>
            @endcan
            <!-- <span class="badge badge-sm badge-success">Active</span> -->
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
                                        <th scope="row">Code :</th>
                                        <td>{{ $codeDetail->code }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Value:</th>
                                        <td>{{ $codeDetail->value }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Is Used:</th>
                                            @if($codeDetail->is_used == 1)
                                            <td><span class="badge badge-pill badge-soft-success font-size-11">Yes</span></td>
                                            @else
                                            <td><span class="badge badge-pill badge-soft-warning font-size-11">No</span></td>
                                            @endif
                                    </tr>
                                    <tr>
                                        <th scope="row">WD Code:</th>
                                            @if($codeDetail->wd_id)
                                              <td><a href="{{ route('admin.wds.show',$codeDetail->wd->id) }}">{{ $codeDetail->wd->code }}</a></td>
                                            @else
                                            <td><i class="text-danger">NA</i></td>
                                            @endif
                                    </tr>
                                    <tr>
                                        <th scope="row">Batch:</th>
                                        <td>{{ $codeDetail->batch }}</td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Brand:</th>
                                            @if($codeDetail->brand_id)
                                              <td><a href="{{ route('admin.brands.show',$codeDetail->brand->id) }}">{{ $codeDetail->brand->name }}</a></td>
                                            @else
                                            <td><i class="text-danger">NA</i></td>
                                            @endif
                                    </tr>
                                    @if($order)
                                    <tr>
                                        <th scope="row">Used By Wholesaler:</th>
                                        <td><a href="{{ route('admin.wholesalers.show',$order->wholesaler->id) }}">{{ $order->wholesaler->full_name }}</a></td>
                                    </tr>
                                    @endif
                                    @if($order)
                                    <tr>
                                        <th scope="row">Code Used On Date:</th>
                                        <td>{{ date('F d, Y h:i', strtotime($order->created_at)) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th scope="row">Created at :</th>
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
        </div>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready(function() {
            created_at_data = "{{ $codeDetail->created_at }}";
            result = formattedDateTime(created_at_data);
            $(".created_at").html(result);

        });
    </script>
@endsection
