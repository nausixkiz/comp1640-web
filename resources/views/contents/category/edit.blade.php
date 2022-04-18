@extends('layouts.main-layout')
@section('title', __('Category Management'))

@push('vendor-styles')
    <!-- third party css -->
    <link href="{{ asset( mix('css/plugins.css')) }}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Category management only for Quality Assurance Manager</h4>

                    @livewire('category-table-view')
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update {{ $category->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->slug) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name" value="{{ old('name', $category->name) }}"
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
                                        <option value="{{ $department->slug }}"
                                                @if($category->department->name === $department->name) selected @endif>{{ $department->name }}</option>
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
