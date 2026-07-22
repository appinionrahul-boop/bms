<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fiscal_year');
            $table->date('expense_date');
            $table->string('expense_category');
            $table->string('expense_sub_category');
            $table->bigInteger('expense_amount');
            $table->string('voucher_no');
            $table->string('expense_cheque');
            $table->string('descriptation');
            $table->string('expense_vat');
            $table->string('expense_folio');
            $table->string('vat_cheque_descriptation');
            $table->string('vat_amount');
            $table->string('expense_tax');
            $table->string('tax_cheque_descriptation');
            $table->string('tax_amount');
            $table->string('totalExpense');
            $table->string('tax_desriptation');
             $table->string('expense_pred');
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
        Schema::dropIfExists('expenses');
    }
}
