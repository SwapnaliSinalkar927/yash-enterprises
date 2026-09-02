@extends('admin.main')

@section('title', 'Add Roles')

@section('style')
<style>
    label,
    .status-title {
        font-weight: 700 !important;
        font-size: 13px !important;
        margin-bottom: 0.3rem;
    }
</style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid p-5 pb-0">
        <h4 class="mb-sm-0 font-size-18">
            Add Roles
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <form action="{{ route('admin.roles.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card card-wth-line">
                                <div class="card-line bg-primary"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name">Name.:</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" required>
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="slug">Slug.:</label>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" id="slug" name="slug" required readonly>
                                                @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="slug">Permissions.:</label>
                                            <div class="" style="background-color: #ececec;width: 100%;height: 250px;overflow-y: scroll;padding: 10px;">
                                                <ul class="permissions" id="permissions">
                                                    @foreach($permissions as $permission)
                                                        @if(!$permission->parent_id)
                                                            <li>
                                                                <input type="checkbox" id="{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" @if(in_array($permission->id, old('permissions', []))) checked @endif>
                                                                {{ $permission->name }}
                                                                @if($permission->children->count() > 0)
                                                                    @include('admin.roles.partials.create_permission_children', ['children' => $permission->children])
                                                                @endif
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @error('permissions')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                     
                                </div>
                                <div class="card-footer text-muted"></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card card-wth-line">
                                <div class="card-line bg-warning"></div>
                                <div class="card-body mb-1">
                                    <h5 class="card-title status-title">Status:</h5>
                                    <select name="status" id="activeStatus" class="form-select">
                                        <option value="1" {{ old('status')== "1" ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status')== "0" ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="card-footer text-muted"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-rounded" style="float:right;">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $('#name').on('keyup', function() {
                var slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g,'_');
                $('#slug').val(slug);
            });

            $('#permissions input[type="checkbox"]').click(function() {
                $(this).next().find('input[type="checkbox"]').prop('checked', this.checked);

                // Go up the hierarchy and check/uncheck depending on the number of children checked/unchecked
                $(this).parents('ul').prev('input[type="checkbox"]').prop({
                    'checked': function() {
                        return $(this).next().find(':checked').length === $(this).next().find('input[type="checkbox"]').length;
                    },
                    'indeterminate': function() {
                        const checkedCount = $(this).next().find(':checked').length;
                        return checkedCount > 0 && checkedCount < $(this).next().find('input[type="checkbox"]').length;
                    }
                });

                // Collect indeterminate checkboxes and update the parent_permissions array
                const indeterminateCheckboxes = $('#permissions input[type="checkbox"]:indeterminate');
                const indeterminateValues = indeterminateCheckboxes.map(function() {
                    return $(this).val();
                }).get();

                $('input[name="parent_permissions[]"]').remove(); // Clear the existing parent_permissions array

                // Create hidden input fields for each value in the parent_permissions array
                indeterminateValues.forEach(function(value) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'parent_permissions[]',
                        value: value
                    }).appendTo('#permissions');
                });
            });
        });
    </script>
@endsection