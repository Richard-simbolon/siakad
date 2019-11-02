<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatakuliahModel extends Model
{

    protected $table = "mata_kuliah";

    protected $fillable = [
        "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
    ];

    public function scopeget_row(){
        return [
            "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
        ];
    }

    public static function tabel_column(){
        return [
            "id","kode_mata_kuliah","nama_mata_kuliah","bobot_mata_kuliah","program_studi_id","jenis_mata_kuliah_id","row_status"
        ];
    }

    /**************************************/
    /*COPY THIS FUNCTION TO YOUR MIGRATION*/
    /**************************************/
    public function up(){
        Schema::create("", function (Blueprint $table) {
            $table->bigInteger("id" , 11);
            $table->string("title" , 250);
            $table->enum("row_status", ["active", "deleted", "notactive"]);
            $table->timestamp("updated_at")->nullable();
            $table->timestamp("created_at")->nullable();
            $table->timestamp("update_by")->nullable();
            $table->timestamp("created_by")->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists("");
    }


}
