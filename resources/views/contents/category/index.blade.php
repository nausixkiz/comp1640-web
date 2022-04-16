@extends('layouts.main-layout')
@section('title', __('Department Management'))

@push('vendor-styles')
    <!-- third party css -->
    <link href="{{ asset( mix('css/plugins.css')) }}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">List of categories on the system </h4>
                    <p class="card-title-desc">Lorem</p>

                    <table id="datatable-buttons"
                           class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a type="button" class="btn btn-sm btn-warning waves-effect waves-light"
                                       href="{{ route('categories.edit', $category->slug) }}">
                                        <i class="ri ri-pencil-fill"></i>
                                    </a>
                                    <a type="button" class="btn btn-sm btn-danger waves-effect waves-light"
                                       onclick="event.preventDefault();document.getElementById('{{ 'delete-category-' . $category->slug }}').submit();">
                                        <i class="ri ri-delete-bin-5-line"></i>
                                    </a>
                                    <form id="{{ 'delete-category-' . $category->slug}}"
                                          action="{{ route('categories.destroy', $category->slug) }}" method="POST"
                                          class="d-none">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create a new category </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name" value="{{ old('name') }}"
                                       required/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="department-select" class="form-label">Department</label>
                                <select class="form-control" id="department-select" name="department">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->slug }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@push('page-scripts')
    <script src="{{ asset( mix('js/plugins/datatable.js')) }}"></script>
    <script>
        $('#department-select').select2({
            placeholder: 'Select a department',
        });
    </script>
@endpush
