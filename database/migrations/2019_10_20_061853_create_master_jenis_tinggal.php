<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterJenisTinggal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create("master_jenis_tinggal", function (Blueprint $table) {
            $table->bigIncrements("id")->unsigned();
            $table->string("title" , 100);
            //$table->enum("row_status" , 100);
            $table->enum('row_status', ["active", "deleted", "notactive"]);
            $table->timestamp("update_at")->nullable();
            $table->timestamp("created_at")->nullable();
            $table->timestamp("update_by")->nullable();
            $table->timestamp("created_by")->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists("master_jenis_tinggal");
    }
}
