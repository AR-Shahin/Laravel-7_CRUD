@extends('layouts.app')
@section('title', 'CRUD : Update User Profile')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Change Password</h5></div>
                    <div class="card-body">
                        @if(session('update'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('update') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{route('changePass')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Old Password : </label>
                                <input type="password" class="form-control @error('old_pass') is-invalid @enderror" name="old_pass">
                                @error('old_pass')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if(session('error'))
                                    <span class="text-danger">{{ session('error') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">New Password : </label>
                                <input type="password" class="form-control @error('new_pass') is-invalid @enderror" name="new_pass" >
                                @error('new_pass')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password : </label>
                                <input type="password" class="form-control @error('confirm_pass') is-invalid @enderror" name="confirm_pass" >
                                @error('confirm_pass')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if(session('errorpass'))
                                    <span class="text-danger">{{ session('errorpass') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Change Password">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
