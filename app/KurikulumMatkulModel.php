<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class KurikulumMatkulModel extends Model
        {

            protected $table = "kurikulum_mata_kuliah";

            //protected $fillable = ["id","row_status","updated_at" ,"created_at","created_by", "update_by"];
            protected $guarded = [];


            public function scopeget_row(){
                return [
                    "id","row_status","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }


        }