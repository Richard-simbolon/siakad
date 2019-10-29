<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class TahunAjaranModel extends Model
        {

            protected $table = "master_tahun_ajaran";

            protected $fillable = [
                "id","row_status","title","angkatan","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","title","angkatan","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("maser_tahun_ajaran", function (Blueprint $table) {
                    $table->bigIncrements("id")->unsigned();
                    $table->string("title" , 200);
                    $table->integer("angkatan" , 5);
                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("maser_tahun_ajaran");
            }


        }