@extends('layouts.app')
@section('title', 'CRUD : Users')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4 style="display:inline-block">{{ __('All Users') }}</h4>
                        <b style="float:right">Total Users : <span class="text-info">{{ count($count) }}</span></b>
                    </div>

                    <div class="card-body">
                        {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                        {{--{{ session('status') }}--}}
                        {{--</div>--}}
                        {{--@endif--}}

                        {{--{{ __('You are logged in!') }}--}}
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Image</th>
                                <th scope="col">Created date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{  $users->firstItem()+$loop->index }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>Otto</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
