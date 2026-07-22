<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('voucher_no');
            $table->string('income_cheque');
            $table->string('income_source');
            $table->string('income_sub_source');
            $table->string('income_bot_source');
            $table->date('income_date');
            $table->bigInteger('income_amount');
            $table->string('fiscal_year');
            $table->string('income_descriptation');
            $table->string('income_pred');
            $table->string('submit_by');
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
        Schema::dropIfExists('incomes');
    }
}
