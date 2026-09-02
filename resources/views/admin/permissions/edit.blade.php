@extends('admin.main')

@section('title', 'Edit Permission')

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
                Edit Permission
            </h4>
            <div class="hk-pg-body mt-2">
                <div class="tab-pane fade show active" id="tab_block_1">
                    <form action="{{ route('admin.permissions.update', [$permission->id]) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card card-wth-line">
                                    <div class="card-line bg-primary"></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="name">Name.:</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $permission->name }}" id="name" name="name" required>
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
                                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') ?? $permission->slug }}" id="slug" name="slug" required readonly>
                                                    @error('slug')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-wth-line">
                                            <div class="card-line bg-success"></div>
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">Permission</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input
                                                                    class="form-check-input @error('is_parent') is-invalid @enderror"
                                                                    value="1" type="checkbox" id="is_parent" name="is_parent"
                                                                    @if(old('is_parent', true)) checked @endif>
                                                                <label class="form-check-label" for="is_parent">
                                                                    Is Parent?
                                                                </label>
                                                            </div>
                                                            @error('is_parent')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="parent_permission" style="display: none;">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="slug">Parent Permission.:</label>
                                                            <select class="form-select @error('parent_id') is-invalid @enderror js-example-basic-single" id="parent_id" name="parent_id">
                                                                <option value="">-- Select anyone --</option>
                                                                @foreach ($permissions as $permission)
                                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('parent_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-muted"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card card-wth-line">
                                            <div class="card-line bg-warning"></div>
                                            <div class="card-body">
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
                            </div>
                        </div>
                        <button type="submit" style="float:right;" class="btn btn-success btn-rounded">Submit</button>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '_');
                $('#slug').val(slug);
            });

            if ($('#is_parent').is(':checked')) {
                $('#parent_permission').hide();
            } else {
                $('#parent_permission').show();
                $('.select2-container').css('width', '100%')
            }

            $('#is_parent').change(function() {
                if ($(this).is(':checked')) {
                    $('#parent_permission').hide();
                } else {
                    $('#parent_permission').show();
                    $('.select2-container').css('width', '100%')
                }
            });
        });
    </script>
@endsection
