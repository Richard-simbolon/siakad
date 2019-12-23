<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class KategoriKegiatanModel extends Model
        {

            protected $table = "master_kategori_kegiatan";

            protected $fillable = [
                "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }


        }