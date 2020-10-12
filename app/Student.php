<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_name', 'student_email', 'student_roll','user_id','student_image',
    ];
    public function addUserName(){
        return $this->hasone(User::class,'id','user_id');
    }
}
