<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class JadwalPerkuliahanModel extends Model
        {

            protected $table = "view_jadwal_kelas_perkuliahan";

            protected $fillable = [
                "id","updated_at" ,"created_at","created_by", "update_by"
            ];
            public function scopeget_row(){
                return [
                    "id","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("view_jadwal_kelas_perkuliahan", function (Blueprint $table) {
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
                Schema::dropIfExists("mahasiswa_jadwal_perkuliahan");
            }


        }