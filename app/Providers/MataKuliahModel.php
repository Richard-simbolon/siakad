<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class MataKuliahModel extends Model
        {

            protected $table = "mata_kuliah";

            protected $fillable = [
                "id","row_status","kode_mata_kuliah","nama_mata_kuliah","program_studi_id","jenis_mata_kuliah_id","bobot_mata_kuliah","bobot_tatap_muka","bobot_praktikum","bobot_praktek_lapangan","bobot_simulasi","metode_pembelajaran","tanggal_mulai_efektif","taggal_akhir_efektif","created_by","created_at","modified_by","updated_at"
            ];


            public function scopeget_row(){
               return [
                    "id","kode_mata_kuliah","nama_mata_kuliah","row_status","program_studi_id","jenis_mata_kuliah_id","bobot_mata_kuliah","bobot_tatap_muka","bobot_praktikum","bobot_praktek_lapangan","bobot_simulasi","metode_pembelajaran","tanggal_mulai_efektif","taggal_akhir_efektif","created_by","created_at","modified_by","updated_at"
                ];
            }

            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("mata_kuliah", function (Blueprint $table) {
                    $table->bigIncrements("id")->unsigned();

                    $table->timestamp("update_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("mata_kuliah");
            }


        }
