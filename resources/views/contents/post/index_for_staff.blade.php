@extends('layouts.main-layout')
@section('title', 'Post Management')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Post management only for super administrator</h4>

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
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id}}</td>
                            <td>{{ $post->name }}</td>
                            <td>{{ $post->short_description }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{!! $post->contents !!}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a type="button"
                                       class="btn btn-sm btn-warning waves-effect waves-light"
                                       target="_blank" href="{{ route('ideas.show', $post->slug) }}">
                                        <i class="ri ri-eye-fill"></i>
                                    </a>
                                    <a type="button" class="btn btn-sm btn-danger waves-effect waves-light"
                                       onclick="event.preventDefault();
                                           document.getElementById('{{ 'delete-post-' . $post->slug }}').submit();">
                                        <i class="ri ri-eraser-fill"></i>
                                    </a>
                                    <form id="{{ 'delete-post-' . $post->slug }}"
                                          action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                                          class="d-none">
                                        @method('DELETE')
                                        @csrf
                                    </form>

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
