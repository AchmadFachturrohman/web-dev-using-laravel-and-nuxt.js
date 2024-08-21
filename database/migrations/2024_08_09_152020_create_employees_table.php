<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('city_of_birth')->nullable(true);
            $table->string('address')->nullable(true);
            $table->date('birth_date')->nullable(true);
            $table->string ('gender');
            $table->foreignId('gol_id')->constrained('golongans');
            // $table->integer('gol_id');
            $table->foreignId('jabatan_id')->constrained('jabatans')->nullable(true);
            // $table->integer('jabatan_id');
            $table->string('duty_loc')->nullable(true);
            $table->string('religion');
            $table->string('unit_kerja')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->string('npwp')->nullable(true);
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
        Schema::dropIfExists('employees');
    }
};
