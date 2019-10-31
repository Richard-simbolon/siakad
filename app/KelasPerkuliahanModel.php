<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasPerkuliahanModel extends Model
{
    protected $table = "kelas_perkuliahan";

    protected $fillable = [
        "id","row_status","program_studi_id","semester_id", "mata_kuliah_id", "kelas_id", "pembahasan", "tanggal_efektif","tanggal_akhir_efektif","updated_at" ,"created_at","created_by", "update_by"
    ];

    public function scopeget_row(){
        return [
            "id","row_status","program_studi_id","semester_id", "mata_kuliah_id", "kelas_id", "pembahasan", "tanggal_efektif","tanggal_akhir_efektif","updated_at" ,"created_at","created_by", "update_by"
        ];
    }
}
