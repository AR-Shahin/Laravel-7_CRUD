@extends('layouts.app')
@section('title', 'CRUD : Update User Profile')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Update Profile</h5></div>
                    <div class="card-body">
                        @if(session('update'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('update') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{url('updateUserProfile')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">User Name : </label>
                                <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name"value="{{ $user->name  }}">
                                @error('user_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">User Email : </label>
                                <input type="email" class="form-control @error('user_email') is-invalid @enderror" name="user_email" value="{{ $user->email  }}">
                                @error('user_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top img-fluid" src="{{ asset('images/1680257352969610.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Name : <span style="font-size:14px">{{Auth::user()->name}}</span></h5>

                        <h5 class="card-title">Email : <span style="font-size:14px"> {{Auth::user()->email}}</span></h5>
                        <h5 class="card-title">Last Update : <span style="font-size:14px"> {{ Auth::user()->updated_at->diffForHumans() }}</span></h5>
                        <a href="{{route('changePass_UI')}}" class="btn btn-primary btn-block">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
