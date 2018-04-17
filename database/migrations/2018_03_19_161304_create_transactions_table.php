<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(0);
            $table->integer('user_id')->default(0);
            $table->char('user_name')->charset='utf8';
            $table->char('user_email');
            $table->char('user_phone');
            $table->decimal('amount')->default(0.000);/*0.000*/
            $table->char('payment')->charset='utf8';
            $table->char('payment_info');
            $table->char('security')->charset='utf8';
            $table->char('message');
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
        Schema::dropIfExists('transactions');
    }
}
