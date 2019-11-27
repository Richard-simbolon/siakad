<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class AdministratorModel extends Model
        {

            protected $table = "administrator";

            protected $fillable = [
                "id","nama","nip","username","password","email","telp","updated_at" ,"created_at","created_by", "update_by"
            ];
            public function scopeget_row(){
                return [
                    "id","nama","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }


        }