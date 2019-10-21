<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{

    protected $table = "module";

    protected $fillable = [
        'id', 'title','description','link','mval','status','created_at','updated_at','create_by'
    ];
}
