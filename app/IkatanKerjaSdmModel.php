<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class IkatanKerjaSdmModel extends Model
        {

            protected $table = "master_ikatan_kerja_sdm";

            protected $fillable = [
                "id","row_status","nama_ikatan_kerja","updated_at" ,"created_at","created_by", "update_by"
            ];

            public $incrementing = false;

            public function scopeget_row(){
                return [
                    "id","row_status","nama_ikatan_kerja","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("master_ikatan_kerja_sdm", function (Blueprint $table) {
                    $table->bigIncrements("id")->unsigned();
                    $table->string("nama_ikatan_kerja" , 200);
                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("master_ikatan_kerja_sdm");
            }


        }