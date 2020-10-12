@extends('layouts.app')
@section('title', 'CRUD :Update Students')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4 style="display:inline-block">{{ __('View Student') }}</h4>
                    </div>
                    <div class="card-body">
                        {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                        {{--{{ session('status') }}--}}
                        {{--</div>--}}
                        {{--@endif--}}

                        {{--{{ __('You are logged in!') }}--}}
<table class="table table-striped table-bordered">
    <tr>
        <th>Name</th>
        <td>{{ $v_student->student_name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $v_student->student_email }}</td>
    </tr>
    <tr>
        <th>Roll</th>
        <td>{{ $v_student->student_roll }}</td>
    </tr>
    <tr>
        <th>Added By </th>
        <td>{{ $v_student->addUserName->name }}</td>
    </tr>
    <tr>
        <th>Added Date</th>
        <td>{{ $v_student->created_at->diffForHumans() }}</td>
    </tr>
    <tr>
        <th>Image</th>
        <td><img src="{{ asset($v_student->student_image)}}" alt="" class ="img-fluid w-50"></td>
    </tr>
</table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
