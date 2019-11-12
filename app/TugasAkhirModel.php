<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TugasAkhirModel extends Model
{
    protected $table = "mahasiswa_tugas_akhir";

    protected $fillable = [
        "id","row_status","mahasiswa_id","judul","updated_at" ,"created_at","created_by", "update_by"
    ];
}
