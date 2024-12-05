@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                       List of total users ({{ $user_count }}) of Role: {{ $role->name }}
                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-light text-primary">
                            <i class="fas fa-plus"></i> Add New User
                        </a>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-light text-primary">
                            <i class="fas fa-plus"></i> Back to Roles
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><a href="{{ route('admin.users.show', $user->id) }}" class="text-dark">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection