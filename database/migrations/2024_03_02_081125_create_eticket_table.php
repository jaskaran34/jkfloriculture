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
        Schema::create('eticket', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->unique();
            $table->string('division_code');
            $table->string('garden_code');
            $table->string('visitor_name');
            $table->date('visit_date');
            $table->integer('total_adults');
            $table->integer('total_child');
            $table->integer('amount');
            $table->string('email');
            $table->integer('mobile_no');
            $table->string('flag');
            $table->string('bank_ref_no');
            $table->timestamp('bank_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eticket');
    }
};
