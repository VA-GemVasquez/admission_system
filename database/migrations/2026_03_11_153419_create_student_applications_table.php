<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->integer('years_old');
            $table->string('contact_number');
            $table->text('temporary_address');
            $table->text('permanent_address');
            $table->string('guardian_name');
            $table->string('guardian_phone');
            $table->enum('student_type', ['Regular', 'Irregular', 'Transferee']);
            $table->enum('campus', ['Goa', 'San Jose', 'Lagonoy']);
            $table->string('college');
            $table->string('course');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Waitlisted'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_applications');
    }
};