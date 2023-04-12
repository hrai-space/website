@extends('layouts.app')

@section('main_content')

<div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{old('email', $user->email)}}">
                        @foreach($errors->get('email') as $error)
                        <div id="emailHelp" class="form-text">{{$error}}</div>
                        @endforeach
                    </div>
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="form-text">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="form-text">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                    <div class="form-text">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                    @endif
                    @endif
                    <div class="mb-3">
                        <label for="exampleInputusername1" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="{{old('username', $user->username)}}">
                        @foreach($errors->get('username') as $error)
                        <div id="emailHelp" class="form-text">{{$error}}</div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="col-lg-4">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Current password</label>
                        <input type="password" class="form-control" name="current_password">
                        @foreach($errors->updatePassword->get('current_password') as $error)
                        <div class="form-text">{{$error}}</div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputusername1" class="form-label">New password</label>
                        <input type="password" class="form-control" name="password">
                        @foreach($errors->updatePassword->get('password') as $error)
                        <div class="form-text">{{$error}}</div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputusername1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @foreach($errors->get('username') as $error)
                        <div class="form-text">{{$error}}</div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Change password</button>
                </form>
            </div>
            <div class="col-lg-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Delete account
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('delete')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    @foreach($errors->userDeletion->get('password') as $error)
                                    <div class="form-text">{{$error}}</div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{Storage::disk('do')->url('images/' . Auth::user()->avatar)}}" alt="">

                <form method="post" action="{{ route('profile.image.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input id="ImageFile" type="file" class="form-control" name="ImageFile" required autocomplete="avatar">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Upload Profile') }}
                    </button>
                    <x-input-error class="mt-2" :messages="$errors->get('ImageFile')" />
                </form>
            </div>
        </div>
    </div>

    @endsection