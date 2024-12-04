@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Details</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Roles:</strong>
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </p>
                        <p><strong>Created At:</strong> {{ $user->created_at->diffForHumans() }}</p>
                        <p><strong>Updated At:</strong> {{ $user->updated_at->diffForHumans() }}</p>
                        <div class="mt-3">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                </div>
            </div>
        </div>
        </div>
    @endsection
