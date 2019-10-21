<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class JenisKelaminModel extends Model
        {

            protected $table = "master_jenis_kelamin";

            protected $fillable = [
                "id","title","updated_at" ,"created_at","created_by", "updated_by"
            ];








            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("jenis_kelamin", function (Blueprint $table) {
                    $table->bigIncrements("id")->unsigned();
                    $table->string("title" , 100);

                    $table->timestamp("update_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("jenis_kelamin");
            }


        }
