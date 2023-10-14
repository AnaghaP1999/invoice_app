<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->double('amount',15,2)->default(0);
            $table->double('total_amount',15,2)->default(0);
            $table->integer('tax_perc');
            $table->double('tax_amount',15,2)->default(0);
            $table->double('net_amount',15,2)->default(0);
            $table->string('customer_name', 200);
            $table->date('invoice_date');
            $table->string('customer_email', 200);
            $table->string('image', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
