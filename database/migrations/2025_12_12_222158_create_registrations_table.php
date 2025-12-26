<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('registrations', function (Blueprint $table) {
        $table->id();

        // الطالب المسجّل
        $table->foreignId('student_id')
              ->constrained('students')
              ->onDelete('cascade');

        // الصف المسجّل فيه
        $table->foreignId('class_id')
              ->constrained('classes')
              ->onDelete('cascade');

        // تاريخ التسجيل
        $table->date('registration_date');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
