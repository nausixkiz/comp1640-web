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

                    <h4 class="card-title">List of departments on the system </h4>
                    <p class="card-title-desc">Lorem</p>

                    <table id="datatable-buttons"
                           class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Closure Date (Start)</th>
                            <th>Closure Date (End)</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->start_closure_date }}</td>
                                <td>{{ $department->end_closure_date }}</td>
                                <td>
                                    <a type="button" class="btn btn-sm btn-warning waves-effect waves-light" href="{{ route('departments.edit', $department->slug) }}">
                                        <i class="ri ri-pencil-fill"></i>
                                    </a>
                                    <a type="button" class="btn btn-sm btn-danger waves-effect waves-light"
                                       onclick="event.preventDefault();document.getElementById('{{ 'delete-department-' . $department->slug }}').submit();">
                                        <i class="ri ri-delete-bin-5-line"></i>
                                    </a>
                                    <form id="{{ 'delete-department-' . $department->slug}}"
                                          action="{{ route('departments.destroy', $department->slug) }}" method="POST"
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
                    <h4 class="card-title">Create a new department </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('departments.store') }}" method="POST"  enctype="multipart/form-data">
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
                                <label class="form-label" for="start_closure_date">Closure Date (Start)</label>
                                <input class="form-control @error('start_closure_date') is-invalid @enderror" id="start_closure_date" name="start_closure_date" value="{{ old('start_closure_date') }}">
                                @error('start_closure_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="form-label" for="end_closure_date">Closure Date (End)</label>
                                <input class="form-control @error('end_closure_date') is-invalid @enderror" id="end_closure_date"  name="end_closure_date" value="{{ old('end_closure_date') }}">
                                @error('end_closure_date')
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
        $('#start_closure_date').flatpickr({
            enableTime: false,
        });
        $('#end_closure_date').flatpickr({
            enableTime: false,
        });
    </script>
@endpush
