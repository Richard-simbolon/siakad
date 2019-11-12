<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TugasAkhirDetailModel extends Model
{
    protected $table = "mahasiswa_tugas_akhir_detail";

    protected $fillable = [
        "id","row_status","tugas_akhir_id","dosen_id","status_dosen","updated_at" ,"created_at","created_by", "update_by"
    ];
}
