<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $students = Student::orderBy('id', 'desc')->paginate(5);
        return view('student.index',compact('students'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => ['required', 'unique:students', 'max:255'],
            'student_email' => ['required','email'],
            'student_roll' => ['required', 'unique:students','Integer'],
            'student_image' => ['required','mimes:jpg,png,jpeg','max:5000'],

        ],[
            'student_name.required' =>"Field Must not be empty",
            'student_name.unique' =>"Name must be unique",
            'student_roll.unique' =>"Roll must be unique",
            'student_email.required' =>"Field Must not be empty",
            'student_email.email' =>"Please Enter a valid Email",
            'student_roll.required' =>"Field Must not be empty",
            'student_roll.Integer' =>"Roll should be an Integer",
            'student_image.required' =>"Field Must not be empty",
            'student_image.mimes' =>"Extension Should be JPG,PNG,JPEG",
            'student_image.max' =>"Image size should be less than 5000kb",
        ]);
        $student_image = $request->file('student_image');
        $name_gen = hexdec(uniqid());
       $img_ext = strtolower($student_image->getClientOriginalExtension());
       $img_name = $name_gen . '.' .$img_ext;
       $upload = 'images/student/';
       Image::make($student_image)->resize(200,200)->save($upload.$img_name);
        $last_image = $upload.$img_name;


        $insert =  Student::insert([
            'student_name' => $request->student_name,
            'student_email' => $request->student_email,
            'student_roll' => $request->student_roll,
            'user_id' => Auth::user()->id,
            'student_image' => $last_image,
            'created_at' => Carbon::now()
        ]);
        if($insert){
            $student_image->move($upload,$img_name);
        }
        return Redirect()->back()->with('success','Student Added Successfully!');
    }

    public function edit($id){
        $id = base64_decode($id);
        $student = Student::findorFail($id);
        return view('student.update',compact('student'));
    }
    public function view($id){
        $id = base64_decode($id);
        $v_student = Student::findorFail($id);
        return view('student.view',compact('v_student'));
    }
    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $request->validate([
            'student_name' => ['required', 'max:255'],
            'student_email' => ['required', 'email'],
            'student_roll' => ['required', 'Integer'],
            'student_image' => ['mimes:jpg,png,jpeg', 'max:8000'],

        ], [
            'student_name.required' => "Field Must not be empty",
            'student_email.required' => "Field Must not be empty",
            'student_email.email' => "Please Enter a valid Email",
            'student_roll.required' => "Field Must not be empty",
            'student_roll.Integer' => "Roll should be an Integer",
            'student_image.mimes' => "Extension Should be JPG,PNG,JPEG",
            'student_image.max' => "Image size should be less than 5000kb",
        ]);
        $student_image = $request->file('student_image');
        if ($student_image) {
            $old_image = $request->old_image;
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($student_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $upload = 'images/student/';
            $last_image = $upload . $img_name;

            $update =Student::findorFail($id)->update([
                'student_name' => $request->student_name,
                'student_email' => $request->student_email,
                'student_roll' => $request->student_roll,
                'user_id' => Auth::user()->id,
                'student_image' => $last_image,
                'updated_at' => Carbon::now()
            ]);
            if($update){
                $student_image->move($upload,$img_name);
                unlink($old_image);
            }
    }else{
            $update =Student::findorFail($id)->update([
                'student_name' => $request->student_name,
                'student_email' => $request->student_email,
                'student_roll' => $request->student_roll,
                'user_id' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);
        }
         return redirect('all-students')->with('update','Student Updated Successfully!');

    }

    public function delete($id)
    {
        $id = base64_decode($id);
        $img = Student::findorFail($id);
        $old_img = $img->student_image;
        $delete = Student::findorFail($id)->delete();
        if($delete){
            unlink($old_img);
            return redirect('all-students')->with('delete','Student Delete Successfully!');
        }
    }
}
