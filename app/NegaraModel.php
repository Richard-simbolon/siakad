<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class NegaraModel extends Model
        {

            protected $table = "master_negara";

            protected $fillable = [
                "id","title","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","title","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }

        }