<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create("dosen", function (Blueprint $table) {
            $table->bigIncrements("id")->unsigned();
            $table->enum("row_status", ["active", "deleted", "notactive"]);
            $table->timestamp("updated_at")->nullable();
            $table->timestamp("created_at")->nullable();
            $table->timestamp("update_by")->nullable();
            $table->timestamp("created_by")->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists("dosen");
    }
}
