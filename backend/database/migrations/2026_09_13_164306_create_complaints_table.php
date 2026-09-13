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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->constrained('citizen');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('priority_id')->nullable()->constrained('priority');
            $table->foreignId('department_id')->nullable()->constrained('department');
            $table->foreignId('assigned_staff_id')->nullable()->constrained('staff');
            $table->string('subject');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('priority')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('date_submitted')->useCurrent();
            $table->timestamp('date_resolved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
