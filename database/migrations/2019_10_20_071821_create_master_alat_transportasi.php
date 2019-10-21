<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterAlatTransportasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create("master_alat_transportasi", function (Blueprint $table) {
            $table->bigIncrements("id")->unsigned();
            $table->string("title" , 100);
            $table->enum('row_status', ["active", "deleted", "notactive"]);
            $table->timestamp("updated_at")->nullable();
            $table->timestamp("created_at")->nullable();
            $table->timestamp("update_by")->nullable();
            $table->timestamp("created_by")->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists("master_alat_transportasi");
    }
}
