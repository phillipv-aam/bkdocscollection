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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            
            // identifications: photo, ssn
            // real-estates: warranty-deed, deeds-of-trust, mortgate-statement
            // vehicles: vehicle-loan, vehicle-title, vehicle-insurance
            // financial-statements: bank-statement-[1-7],
            // incomes: paycheck-stubs-[1-7], other-income
            // retirement-accounts: recent-statement
            // taxes: last-year, prior-year
            // debts: bills-and-statements
            // marital-status: divorce-decree
            // others: bankruptcy-questionnaire, attorney-aggreement, credit-counseling, additional-creditor, received-child-support-payments, child-support-payments, gov-benefits-statements
            $table->string('category'); 
            $table->string('type'); 
            $table->string('filename');
            $table->string('url');
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
        Schema::dropIfExists('files');
    }
};
