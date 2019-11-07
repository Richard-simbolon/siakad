<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterJenisMatakuliah extends Migration
{
    public function up(){
        Schema::create("master_jenis_matakuliah", function (Blueprint $table) {
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
        Schema::dropIfExists("master_jenis_matakuliah");
    }
}
