<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class JabatanFungsionalModel extends Model
        {

            protected $table = "master_jabatan_fungsional";

            protected $fillable = [
                "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }

        }