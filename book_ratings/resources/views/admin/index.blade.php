@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $user->name }}</h2>
                        <p class="card-text">Email: {{ $user->email }}</p>
                        <p class="card-text">Joined: {{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">User Roles</div>
                    <div class="card-body">
                        @foreach($user->roles as $role)
                            <p class="card-text">{{ $role->name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection