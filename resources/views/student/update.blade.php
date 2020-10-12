@extends('layouts.app')
@section('title', 'CRUD :Update Students')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4 style="display:inline-block">{{ __('Update Student') }}</h4>
                    </div>
                    <div class="card-body">
                        {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                        {{--{{ session('status') }}--}}
                        {{--</div>--}}
                        {{--@endif--}}

                        {{--{{ __('You are logged in!') }}--}}
                        <form action="{{ url('update-student/'.base64_encode($student->id)) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value ="{{$student->student_image}}" name = "old_image">
                            <div class="form-group">
                                <label for="">Student Name : </label>
                                <input type="text" class="form-control @error('student_name') is-invalid @enderror" name="student_name" placeholder="Enter Student Name" value="{{ $student->student_name }}">
                                @error('student_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Student Email : </label>
                                <input type="text" class="form-control @error('student_email') is-invalid @enderror" name="student_email" placeholder="Enter Student Email" value="{{ $student->student_email }}">
                                @error('student_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Student Roll : </label>
                                <input type="text" class="form-control @error('student_roll') is-invalid @enderror" name="student_roll" placeholder="Enter Student Roll" value="{{ $student->student_roll }}">
                                @error('student_roll')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Student Image : </label>
                                <input type="file" class="form-control @error('student_image') is-invalid @enderror" name="student_image" >
                                @error('student_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <img src="{{ asset($student->student_image)}}" alt="" style = "width:80px">
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Update Student">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
