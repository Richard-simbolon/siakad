<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class ReportSettingModel extends Model
        {

            protected $table = "report_setting";

            protected $fillable = [
                "id","title","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","title","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("report_setting", function (Blueprint $table) {
                    $table->bigInteger("id" , 11);
$table->null("title" , );

                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("report_setting");
            }


        }