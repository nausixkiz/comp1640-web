@extends('layouts.main-layout')
@section('title', 'User Management')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">List of members on the system </h4>
                            <p class="card-title-desc">Lorem</p>

                            <table id="datatable-buttons"
                                   class="table table-striped table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Contents</th>
                                    <th>Like Count</th>
                                    <th>Dislike Count</th>
                                    <th>User Comment</th>
                                    <th>Post Name</th>
                                    <th>Create Date</th>
                                    <th>Update Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($comments['data'] as $comment)
                                    <tr>
                                        <td>{{ $comment['id'] }}</td>
                                        <td>{{ $comment['contents'] }}</td>
                                        <td>{{ $comment['like_count'] }}</td>
                                        <td>{{ $comment['dislike_count'] }}</td>
                                        <td>{{ $comment['user_name'] }}</td>
                                        <td>{{ $comment['post_name'] }}</td>
                                        <td>{{ $comment['created_at'] }}</td>
                                        <td>{{ $comment['updated_at'] }}</td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-danger waves-effect waves-light"
                                               onclick="event.preventDefault();
                                                   document.getElementById('{{ 'delete-comment-' . $comment['id'] }}').submit();">
                                                <i class="ri ri-chat-delete-fill"></i>
                                            </a>
                                            <form id="{{ 'delete-comment-' . $comment['id'] }}"
                                                  action="{{ route('comments.destroy', $comment['id']) }}" method="POST"
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
                </div> <!-- end col -->
            </div>

        </div>
    </div>
@stop

@push('page-scripts')
    <script src="{{ asset( mix('js/plugins/datatable.js')) }}"></script>
@endpush
