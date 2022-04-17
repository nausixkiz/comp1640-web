@extends('layouts.main-layout')
@section('title', 'Idea Management')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Idea management only for super administrator</h4>

                <table id="datatable-buttons"
                       class="table table-striped table-bordered dt-responsive nowrap"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Contents</th>
                        <th>Create Date</th>
                        <th>Update Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($ideas as $idea)
                        <tr>
                            <td>{{ $idea->id}}</td>
                            <td>{{ $idea->name }}</td>
                            <td>{{ $idea->short_description }}</td>
                            <td>{{ $idea->slug }}</td>
                            <td>{!! $idea->contents !!}</td>
                            <td>{{ $idea->created_at }}</td>
                            <td>{{ $idea->updated_at }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a type="button"
                                       class="btn btn-sm btn-warning waves-effect waves-light"
                                       target="_blank" href="{{ route('ideas.show', $idea->slug) }}">
                                        <i class="ri ri-eye-fill"></i>
                                    </a>
                                    <a type="button" class="btn btn-sm btn-primary waves-effect waves-light"
                                       href="{{ route('ideas.edit', $idea->slug) }}">
                                        <i class="ri ri-edit-box-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
@stop

@push('page-scripts')
    <script src="{{ asset( mix('js/plugins/datatable.js')) }}"></script>
@endpush
