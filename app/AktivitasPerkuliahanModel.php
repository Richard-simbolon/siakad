<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktivitasPerkuliahanModel extends Model
{
    protected $table = "mahasiswa_aktivitas_perkuliahan";

    protected $fillable = [
        "id","row_status","mahasiswa_id","semester_id","status","ips","ipk","sks_semester","sks_total","updated_at" ,"created_at","created_by", "update_by","is_sinc"
    ];

    public function scopeget_row(){
        return [
            "id","row_status","id_mahasiswa","semester_id","status","ips","ipk","sks_semester","sks_total","updated_at" ,"created_at","created_by", "update_by","is_sinc"
        ];
    }

}
