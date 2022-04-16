@extends('layouts.main-layout')
@section('title', 'Update User')

@section('content')
    <div class="row justify-content-center">
        <div class="col-5 align-self-center">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('UPDATE USER') }}</h4>
                    <p class="card-title-desc">Lorem</p>
                </div>
                <div class="card-body">
                    <form class="create-new-idea-form" action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   name="name" value="{{ old('name', $user->name) }}"
                                   required/>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                   name="email" value="{{ old('email', $user->email) }}"
                                   required/>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"/>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="password_confirmation"
                                   name="password_confirmation"/>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">Telephone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                   name="phone" value="{{ old('phone', $user->phone) }}"
                                   required/>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role-select" class="form-label @error('role') is-invalid @enderror">Role</label>
                            <select class="form-control" id="role-select" name="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}"
                                            @if($user->getRoleName() === $role) selected @endif>{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="birth">Birthday</label>
                            <input class="form-control @error('birth') is-invalid @enderror"
                                   id="birth" name="birth"
                                   value="{{ old('birth', $user->birth) }}">
                            @error('birth')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gender-select"
                                   class="form-label @error('gender') is-invalid @enderror">Gender</label>
                            <select class="form-control" id="gender-select" name="gender">
                                <option value="Male" @if($user->gender === "Male") selected @endif>Male</option>
                                <option value="Female" @if($user->gender === "Female") selected @endif>Female</option>
                                <option value="Other" @if($user->gender === "Other") selected @endif>Other</option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                   name="address" value="{{ old('address', $user->address) }}"/>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Submit
                                    </button>
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary waves-effect">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@push('page-scripts')
    <script>
        $('#birth').flatpickr({
            enableTime: false,
        });
        $('#role-select').select2({
            placeholder: 'Select a role',
        });
        $('#gender-select').select2({
            placeholder: 'Select a gender',
        });
    </script>
@endpush
