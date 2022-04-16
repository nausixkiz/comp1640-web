@extends('layouts.main-layout')
@section('title', 'User Management')

@section('content')
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
                                    <th>Info</th>
                                    <th>Role</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($users['data'] as $user)
                                    <tr>
                                        <td>{{ $user['id'] }}</td>
                                        <td>
                                            <div class="d-flex mb-4">
                                                <div class="flex-shrink-0 me-3">
                                                    <img class="rounded-circle avatar-sm"
                                                         src="{{ Avatar::create($user['name'])->toBase64() }}"
                                                         alt="{{ $user['name'] }}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h4 class="font-size-16">{{ $user['name'] }}</h4>
                                                    <p class="text-muted font-size-13">{{ $user['email'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user['role'] }}</td>
                                        <td>{{ $user['gender'] }}</td>
                                        <td>{{ $user['phone'] }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button"
                                                        class="btn btn-sm btn-warning waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#{{ 'view-user-' . $user['id'] }}">
                                                    <i class="mdi mdi-account-question"></i>
                                                </button>
                                                <div id="{{ 'view-user-' . $user['id'] }}" class="modal fade"
                                                     tabindex="-1" role="dialog"
                                                     aria-labelledby="{{ 'view-user-' . $user['id'] }}"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="{{ 'view-user-' . $user['id'] }}">{{ $user['name'] }}
                                                                    Details</h5>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center">
                                                                    <img class="avatar-xl rounded-circle"
                                                                         src="{{ Avatar::create($user['name'])->toBase64() }}"
                                                                         alt="{{ $user['name'] }}"
                                                                         width="100" height="100">
                                                                </div>


                                                                <dl class="row mb-0">
                                                                    <dt class="col-sm-3">Id</dt>
                                                                    <dd class="col-sm-9">{{ $user['id'] }}</dd>

                                                                    <dt class="col-sm-3">Name</dt>
                                                                    <dd class="col-sm-9">{{ $user['name'] }}</dd>

                                                                    <dt class="col-sm-3">Email</dt>
                                                                    <dd class="col-sm-9">{{ $user['email'] }}</dd>

                                                                    <dt class="col-sm-3 text-truncate">Role</dt>
                                                                    <dd class="col-sm-9">{{ $user['role'] }}</dd>

                                                                    <dt class="col-sm-3 text-truncate">Gender</dt>
                                                                    <dd class="col-sm-9">{{ $user['gender'] }}</dd>

                                                                    <dt class="col-sm-3 text-truncate">Phone</dt>
                                                                    <dd class="col-sm-9">{{ $user['phone'] }}</dd>

                                                                    <dt class="col-sm-3 text-truncate">Address</dt>
                                                                    <dd class="col-sm-9">{{ $user['address'] }}</dd>

                                                                    <dt class="col-sm-3 text-truncate">Birthday</dt>
                                                                    <dd class="col-sm-9">{{ $user['birth'] }}</dd>
                                                                </dl>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a type="button" class="btn btn-sm btn-primary waves-effect waves-light"
                                                   href="{{ route('users.edit', $user['id']) }}">
                                                    <i class="mdi mdi-account-edit"></i>
                                                </a>
                                                <a type="button" class="btn btn-sm btn-danger waves-effect waves-light"
                                                   onclick="event.preventDefault();
                                                       document.getElementById('{{ 'delete-user-' . $user['id'] }}').submit();">
                                                    <i class="mdi mdi-account-remove"></i>
                                                </a>
                                                <form id="{{ 'delete-user-' . $user['id'] }}"
                                                      action="{{ route('users.destroy', $user['id']) }}" method="POST"
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
                </div>
@stop

@push('page-scripts')
    <script src="{{ asset( mix('js/plugins/datatable.js')) }}"></script>
@endpush
