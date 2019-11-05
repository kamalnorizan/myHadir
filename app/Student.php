<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    public $timestamps = true;

    protected $table = 'students';

    protected $primaryKey = 'student_id';

    public $incrementing = true;

    protected $fillable = ['student_ndp','course_id','student_semester','student_session'];

    public function user()
    {
        return $this->morphOne('App\User', 'profileable');
    }
}
