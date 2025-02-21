@extends('backend.layout.app')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Manage Roles & Permissions</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Create Role -->
        <div class="col-md-4">
            <h4>Create Role</h4>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <input type="text" name="name" class="form-control" placeholder="Role Name" required>
                <button class="btn btn-primary mt-2">Create</button>
            </form>
        </div>

        <!-- Create Permission -->
        <div class="col-md-4">
            <h4>Create Permission</h4>
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <input type="text" name="name" class="form-control" placeholder="Permission Name" required>
                <button class="btn btn-primary mt-2">Create</button>
            </form>
        </div>
    </div>

    <hr>

    <div class="row">
        <!-- Assign Permissions to Role -->
        <div class="col-md-6">
            <h4>Assign Permissions to Role</h4>
            <form action="{{ route('roles.assign.permissions', ['role' => 1]) }}" method="POST">
                @csrf
                <select name="role" class="form-control" required>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>

                <label>Select Permissions:</label>
                @foreach($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                    <label>{{ $permission->name }}</label>
                </div>
                @endforeach

                <button class="btn btn-success mt-2">Assign Permissions</button>
            </form>
        </div>

        <!-- Assign Role to User -->
        <div class="col-md-6">
            <h4>Assign Role to User</h4>
            <form action="{{ route('users.assign.role', ['user' => 1]) }}" method="POST">
                @csrf
                <select name="user" class="form-control" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->employeeName }}</option>
                    @endforeach
                </select>

                <select name="role" class="form-control mt-2" required>
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>

                <button class="btn btn-success mt-2">Assign Role</button>
            </form>
        </div>
    </div>

    <hr>

    <!-- Assign Individual Permission to User -->
    <div class="row">
        <div class="col-md-6">
            <h4>Assign Permission to User</h4>
            <form action="{{ route('users.assign.permission', ['user' => 1]) }}" method="POST">
                @csrf
                <select name="user" class="form-control" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->employeeName }}</option>
                    @endforeach
                </select>

                <select name="permission" class="form-control mt-2" required>
                    @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>

                <button class="btn btn-warning mt-2">Assign Permission</button>
            </form>
        </div>
    </div>
</div>
@endsection