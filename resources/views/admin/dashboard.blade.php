@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <div class="form-inline">
                            <form action="{{route('profile.ban', $user)}}" method="POST">@method('PUT') @csrf<button type="submit" class="btn btn-danger">@if($user->is_banned) Unban @else Ban @endif</button></form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $users->links() !!}
    </div>
</main>


@endsection