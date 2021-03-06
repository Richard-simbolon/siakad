<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class KalenderAkademikModel extends Model
        {

            protected $table = "kalender_akademik";

            protected $fillable = [
                "id","row_status","start","end","title","keterangan","warna","display","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","start","end","title","keterangan","warna","display","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }

            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("kalender_akademik", function (Blueprint $table) {
                    $table->null("id" , 11);

                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("start")->nullable();
                    $table->timestamp("end")->nullable();
                    $table->string("title" , 200);
                    $table->string("warna" , 200);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("kalender_akademik");
            }


        }