<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iljtm extends Model
{
    //
    public $timestamps = true;

    protected $table = 'iljtms';

    protected $primaryKey = 'iljtm_id';

    public $incrementing = true;

    protected $fillable = ['iljtm_code','iljtm_name'];
}
