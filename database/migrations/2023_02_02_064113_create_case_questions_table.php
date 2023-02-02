<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_questions', function (Blueprint $table) {
            $table->id();
            
            // For yes-no question
            $table->string('question'); 
            $table->string('answer'); 
            $table->string('answer_long_form'); 
            $table->json('metadata');

            $table->unsignedBigInteger('case_record_id');
            $table->foreign('case_record_id')->references('id')->on('case_records');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_questions');
    }
};
