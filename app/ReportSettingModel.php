<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class ReportSettingModel extends Model
        {

            protected $table = "report_setting";

            protected $fillable = [
                "id","row_status","kepala_bagian_ad_akademik","kepala_bagian_ad_akademik_nip","ketua_jurusan","ketua_jurusan_nip","direktur","direktur_nip","wakil_direktur_i_bidang_akademik","wakil_direktur_i_bidang_akademik_nip","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","kepala_bagian_ad_akademik","kepala_bagian_ad_akademik_nip","ketua_jurusan","ketua_jurusan_nip","direktur","direktur_nip","wakil_direktur_i_bidang_akademik","wakil_direktur_i_bidang_akademik_nip","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            


        }