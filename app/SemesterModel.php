<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class SemesterModel extends Model
        {

            protected $table = "master_semester";

            protected $fillable = [
                "id","row_status","title","status_semester","tanggal_mulai_berlaku","tanggal_akhir","tanggal_mulai_penilaian","tanggal_akhir_penilaian", "updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","title","status_semester","tanggal_mulai_berlaku","tanggal_akhir","tanggal_mulai_penilaian","tanggal_akhir_penilaian", "updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("master_semester", function (Blueprint $table) {
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
                Schema::dropIfExists("master_semester");
            }


        }