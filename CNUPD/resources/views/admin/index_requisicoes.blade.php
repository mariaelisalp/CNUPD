@extends('layouts.appPeople')
@section('title', 'CNUPD')
@section('content')


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
            @foreach($user_requests as $user_request)
                <tr>
                    <td>{{ $user_request->full_name }}</td>
                    <td>{{ $user_request->email }}</td>
                    <td>
                        <form action="{{ route('admin.aprova_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Aprova</button>
                        </form>
                        <form action="{{ route('admin.rejeita_requisicao', $user_request->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Rejeita</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection