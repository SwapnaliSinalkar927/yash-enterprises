@extends('admin.main')

@section('title', 'Admin Role')

@section('style')
<style>
    .table-card-line{
        height: 4px !important;
    }
</style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
	<div class="container-fluid p-5 pb-0">
		<h4 class="mb-sm-0 font-size-18">
        {{ $role->name }}'s Detail
        {!! ($role->status==1) ? '<span class="badge badge-sm badge-success">Active</span>' : '<span class="badge badge-sm badge-danger">Inactive</span>' !!}
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
                                        <td>{{ $role->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Slug :</th>
                                        <td>{{ $role->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Permissions&nbsp;:</th>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                                <a href="{{ route('admin.permissions.show', $permission->id) }}">
                                                    <span class="me-1 badge bg-info">{{ $permission->slug }}</span>
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Created At  :</th>
                                        <td class="created_at">   </td>
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
            created_at_data = "{{  $role->created_at }}";
            result = formattedDateTime(created_at_data);
            $(".created_at").html(result);
        });
    </script>
@endsection