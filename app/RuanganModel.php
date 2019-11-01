<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class RuanganModel extends Model
        {

            protected $table = "master_ruangan";

            protected $fillable = [
                "id","row_status","kode_ruangan","nama_ruangan","keterangan","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status", "kode_ruangan","nama_ruangan","keterangan","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
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
            public function down()
            {
                Schema::dropIfExists("master_ruangan");
            }


        }