@extends('layouts.app')
@section('title', 'CRUD : Students')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center no-gutters">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h4 style="display:inline-block">{{ __('All Students') }}</h4>
                    </div>
                    <div class="card-body">
                        {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                        {{--{{ session('status') }}--}}
                        {{--</div>--}}
                        {{--@endif--}}

                        {{--{{ __('You are logged in!') }}--}}
                        @if(session('update'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('update') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session('delete'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('delete') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roll</th>
                                <th scope="col">Image</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Created date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <th scope="row">{{  $students->firstItem()+$loop->index }}</th>
                                    <td>{{ $student->student_name }}</td>
                                    <td>{{ $student->student_email }}</td>
                                    <td>{{ $student->student_roll }}</td>
                                    <td><img src="{{ asset($student->student_image)}}" alt="" style = "width:80px"></td>
                                    <td>{{ $student->addUserName->name }}</td>
                                    <td>{{ $student->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ url('studentView/'.base64_encode($student->id)) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ url('studentEdit/'.base64_encode($student->id)) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ url('studentDelete/'.base64_encode($student->id)) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure ?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $students->links() }}


                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header"><h4 style="display:inline-block">{{ __('Add Student') }}</h4>
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            @endif
                    </div>
                    <div class="card-body">
                        {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                        {{--{{ session('status') }}--}}
                        {{--</div>--}}
                        {{--@endif--}}

                        {{--{{ __('You are logged in!') }}--}}
                        <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Student Name : </label>
                                <input type="text" class="form-control @error('student_name') is-invalid @enderror" name="student_name" placeholder="Enter Student Name" value="{{ old('student_name') }}">
                                @error('student_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Student Email : </label>
                                <input type="text" class="form-control @error('student_email') is-invalid @enderror" name="student_email" placeholder="Enter Student Email" value="{{ old('student_email') }}">
                                @error('student_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Student Roll : </label>
                                <input type="text" class="form-control @error('student_roll') is-invalid @enderror" name="student_roll" placeholder="Enter Student Roll" value="{{ old('student_roll') }}">
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
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Add Student">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
