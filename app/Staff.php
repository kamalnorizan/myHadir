<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    public $timestamps = true;

    protected $table = 'staffs';

    protected $primaryKey = 'staff_id';

    public $incrementing = true;

    protected $fillable = ['staff_department'];

    public function user()
    {
        return $this->morphOne('App\User', 'profileable');
    }
}
