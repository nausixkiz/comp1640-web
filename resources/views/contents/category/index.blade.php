@extends('layouts.main-layout')
@section('title', __('Category Management'))

@push('vendor-styles')
    <!-- third party css -->
    <link href="{{ asset( mix('css/plugins.css')) }}" rel="stylesheet"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Category management only for Quality Assurance Manager</h4>

                    @livewire('category-table-view')
                </div>
            </div>
        </div>
        <div class="col-3">
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

        const table = $('#datatable-buttons').DataTable({
            select: true,
            // responsive: true,
            lengthChange: false,
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            },
            // buttons: ['copy', 'excel', 'pdf', 'colvis']
        });

        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        $(".dataTables_length select").addClass('form-select form-select-sm');
    </script>
@endpush
