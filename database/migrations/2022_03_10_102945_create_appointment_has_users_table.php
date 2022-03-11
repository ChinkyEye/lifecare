<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentHasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_has_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors'); 
            $table->unsignedBigInteger('doctor_has_day_id');
            $table->foreign('doctor_has_day_id')->references('id')->on('doctor_has_days'); 
            $table->unsignedBigInteger('doctor_has_day_time_id');
            $table->foreign('doctor_has_day_time_id')->references('id')->on('doctor_has_day_times'); 
            $table->boolean('is_active')->default(True); // 1 active, 0 non active
            $table->string('date_np',10);
            $table->string('date',10);
            $table->string('time',8);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('appointment_has_users');
    }
}
