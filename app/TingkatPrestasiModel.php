<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class TingkatPrestasiModel extends Model
        {

            protected $table = "master_tingkat_prestasi";

            protected $fillable = [
                "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }

        }