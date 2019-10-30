<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create("master_kelas", function (Blueprint $table) {
            $table->bigInteger("id" , 11);
            $table->string("title" , 200);
            $table->string("jurusan_id" , 11);
            $table->enum("row_status", ["active", "deleted", "notactive"]);
            $table->timestamp("updated_at")->nullable();
            $table->timestamp("created_at")->nullable();
            $table->timestamp("update_by")->nullable();
            $table->timestamp("created_by")->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists("master_kelas");
    }
}
