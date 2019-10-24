<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class AgamaModel extends Model
        {

            protected $table = "master_agama";

            protected $fillable = [
                "id","title","row_status","updated_at" ,"created_at","created_by", "updated_by"
            ];

            public function scopeget_row(){
                return [
                    "id","title","row_status","updated_at" ,"created_at","created_by", "updated_by"
                 ];
             }







            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("master_agama", function (Blueprint $table) {
                    $table->bigIncrements("id")->unsigned();
                    $table->string("title" , 100);
                    $table->boolean("status");

                });
            }
            public function down()
            {
                Schema::dropIfExists("master_agama");
            }


        }
