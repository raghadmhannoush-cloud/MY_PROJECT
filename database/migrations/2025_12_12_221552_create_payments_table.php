<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // الطالب الذي دفع
            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');

            // قيمة الدفعة
            $table->decimal('amount', 8, 2);

            // تاريخ الدفعة
            $table->date('payment_date');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
