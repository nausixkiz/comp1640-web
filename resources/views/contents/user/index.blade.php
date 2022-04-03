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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Birthday</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($users['data'] as $user)
                                    <tr>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ $user['role'] }}</td>
                                        <td>{{ $user['gender'] }}</td>
                                        <td>{{ $user['phone'] }}</td>
                                        <td>{{ $user['address'] }}</td>
                                        <td>{{ $user['birth'] }}</td>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-primary waves-effect waves-light" href="{{ route('users.edit', $user['id']) }}">
                                                <i class="mdi mdi-account-edit"></i> Edit
                                            </a>
                                            <a type="button" class="btn btn-sm btn-danger waves-effect waves-light"  onclick="event.preventDefault();
                                                     document.getElementById('{{ 'delete-user-' . $user['id'] }}').submit();">
                                                <i class="mdi mdi-account-remove"></i> Remove
                                            </a>
                                            <form id="{{ 'delete-user-' . $user['id'] }}"  action="{{ route('users.destroy', $user['id']) }}" method="POST" class="d-none">
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
