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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('office_category_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('district_id')->constrained();
            $table->decimal('opening_dues', 10, 2)->nullable();
            $table->date('deactivation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};