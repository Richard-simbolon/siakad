<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class PangkatGolonganModel extends Model
        {

            protected $table = "master_pangkat_golongan";

            protected $fillable = [
                "id","title","row_status","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","title","row_status","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }

        }