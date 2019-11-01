<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create("master_ruangan", function (Blueprint $table) {
            $table->bigInteger("id" , 11);
            $table->string("kode_ruangan" , 250);
            $table->string("nama_ruangan" , 250);
            $table->string("keterangan" , 500);
            $table->enum("row_status", ["active", "deleted", "notactive"]);
            $table->timestamp("updated_at")->nullable();
            $table->timestamp("created_at")->nullable();
            $table->timestamp("update_by")->nullable();
            $table->timestamp("created_by")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("master_ruangan");
    }
}
