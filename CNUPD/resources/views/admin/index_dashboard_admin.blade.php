@extends('layouts.appAdmin')
@section('title', CNUPD)
@section('content')
// File: resources/views/admin/users/index.blade.php

@extends('admin.layout')

@section('content')
    <h1>Unapproved Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.approve', $user->id) }}" class="btn btn-success">Approve</a>
                        <a href="{{ route('admin.users.deny', $user->id) }}" class="btn btn-danger">Deny</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@endsection