<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class KelasModel extends Model
        {

            protected $table = "master_kelas";

            protected $fillable = [
                "id","title","row_status","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","title","row_status","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("master_kelas", function (Blueprint $table) {
                    $table->bigInteger("id" , 11);
                    $table->string("title" , 200);

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