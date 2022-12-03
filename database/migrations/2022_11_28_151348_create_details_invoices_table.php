<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_invoices");
            $table->string('invoice_number', 50);
            $table->string('product', 50);
            // $table->bigInteger( 'section_id' )->unsigned();
            $table->foreign('id_invoices')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('section',8,2);
            $table->string('Status', 50);
            $table->integer('Value_Status');
            $table->text('note')->nullable();
            // $table->date('Payment_Date')->nullable();
            // $table->softDeletes();
            $table->string('user', 250);
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
        Schema::dropIfExists('details_invoices');
    }
}
