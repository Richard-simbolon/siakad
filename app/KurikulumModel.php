<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class KurikulumModel extends Model
        {

            protected $table = "kurikulum";

            //protected $fillable = ["id","row_status","updated_at" ,"created_at","created_by", "update_by"];
            protected $guarded = [];


            public function scopeget_row(){
                return [
                    "id","row_status","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("kurikulum", function (Blueprint $table) {
                    $table->bigIncrements("id")->unsigned();
$table->enum("row_status" , 11);

                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("kurikulum");
            }


        }