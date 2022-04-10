@extends('layouts.main-layout')
@section('title', 'Post Management')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">List of posts on the system </h4>
                <p class="card-title-desc">Lorem</p>

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
                    @foreach($posts['data'] as $post)
                        <tr>
                            <td>{{ $post['id'] }}</td>
                            <td>{{ $post['name'] }}</td>
                            <td>{{ $post['description'] }}</td>
                            <td>{{ $post['slug'] }}</td>
                            <td>{{ $post['contents'] }}</td>
                            <td>{{ $post['created_at'] }}</td>
                            <td>{{ $post['updated_at'] }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button"
                                            class="btn btn-sm btn-warning waves-effect waves-light"
                                            data-bs-toggle="modal"
                                            data-bs-target="#{{ 'view-user-' . $post['id'] }}">
                                        <i class="ri ri-eye-fill"></i>
                                    </button>
                                    {{--                                                <div id="{{ 'view-user-' . $post['id'] }}" class="modal fade"--}}
                                    {{--                                                     tabindex="-1" role="dialog"--}}
                                    {{--                                                     aria-labelledby="{{ 'view-user-' . $post['id'] }}"--}}
                                    {{--                                                     aria-hidden="true">--}}
                                    {{--                                                    <div class="modal-dialog modal-lg">--}}
                                    {{--                                                        <div class="modal-content">--}}
                                    {{--                                                            <div class="modal-header">--}}
                                    {{--                                                                <h5 class="modal-title"--}}
                                    {{--                                                                    id="{{ 'view-user-' . $post['id'] }}">{{ $post['name'] }}--}}
                                    {{--                                                                    Details</h5>--}}
                                    {{--                                                                <button type="button" class="btn-close"--}}
                                    {{--                                                                        data-bs-dismiss="modal"--}}
                                    {{--                                                                        aria-label="Close"></button>--}}
                                    {{--                                                            </div>--}}
                                    {{--                                                            <div class="modal-body">--}}
                                    {{--                                                                <div class="text-center">--}}
                                    {{--                                                                    <img class="avatar-xl rounded-circle"--}}
                                    {{--                                                                         src="{{ Avatar::create($post['name'])->toBase64() }}"--}}
                                    {{--                                                                         alt="{{ $post['name'] }}"--}}
                                    {{--                                                                         width="100" height="100">--}}
                                    {{--                                                                </div>--}}


                                    {{--                                                                <dl class="row mb-0">--}}
                                    {{--                                                                    <dt class="col-sm-3">Id</dt>--}}
                                    {{--                                                                    <dd class="col-sm-9">{{ $post['id'] }}</dd>--}}

                                    {{--                                                                    <dt class="col-sm-3">Name</dt>--}}
                                    {{--                                                                    <dd class="col-sm-9">{{ $post['name'] }}</dd>--}}

                                    {{--                                                                    <dt class="col-sm-3">Email</dt>--}}
                                    {{--                                                                    <dd class="col-sm-9">{{ $post['email'] }}</dd>--}}

                                    {{--                                                                    <dt class="col-sm-3 text-truncate">Role</dt>--}}
                                    {{--                                                                    <dd class="col-sm-9">{{ $post['role'] }}</dd>--}}

                                    {{--                                                                    <dt class="col-sm-3 text-truncate">Gender</dt>--}}
                                    {{--                                                                    <dd class="col-sm-9">{{ $post['gender'] }}</dd>--}}

                                    {{--                                                                    <dt class="col-sm-3 text-truncate">Phone</dt>--}}
                                    {{--                                                                    <dd class="col-sm-9">{{ $post['phone'] }}</dd>--}}

                                    {{--                                                                    <dt class="col-sm-3 text-truncate">Address</dt>--}}
                                    {{--                                                                    <dd class="col-sm-9">{{ $post['address'] }}</dd>--}}

                                    {{--                                                                    <dt class="col-sm-3 text-truncate">Birthday</dt>--}}
                                    {{--                                                                    <dd class="col-sm-9">{{ $post['birth'] }}</dd>--}}
                                    {{--                                                                </dl>--}}


                                    {{--                                                            </div>--}}
                                    {{--                                                        </div>--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}

                                    <a type="button" class="btn btn-sm btn-primary waves-effect waves-light"
                                       href="{{ route('posts.edit', $post['id']) }}">
                                        <i class="ri ri-edit-box-fill"></i>
                                    </a>
                                    <a type="button" class="btn btn-sm btn-danger waves-effect waves-light"
                                       onclick="event.preventDefault();
                                           document.getElementById('{{ 'delete-post-' . $post['id'] }}').submit();">
                                        <i class="ri ri-eraser-fill"></i>
                                    </a>
                                    <form id="{{ 'delete-post-' . $post['id'] }}"
                                          action="{{ route('posts.destroy', $post['id']) }}" method="POST"
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
