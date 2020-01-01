<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class SinkronisasiModel extends Model
        {

            protected $table = "sinkronisasi";

            protected $fillable = [
                "id","row_status","sync_code","url","name","description","jumlah_sync","last_sync","last_sync_by" ,"last_sync_status"
            ];
            public function scopeget_row(){
                return [
                    "id","row_status","sync_code","url","name","description","jumlah_sync","last_sync","last_sync_by" ,"last_sync_status"
                 ];
             }


        }