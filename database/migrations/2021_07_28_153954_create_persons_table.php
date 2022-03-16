<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->default(0);
            $table->foreignId('father_id')->default(0);
            $table->foreignId('mother_id')->default(0);
            $table->foreignId('user_id')->nullable();
            $table->string('photo')->nullable();
            $table->string('name', 255);
            $table->string('gender', 1);
            $table->date('birthday')->nullable();
            $table->string('phone', 20);
            $table->text('address');
            $table->integer('village')->nullable();
            $table->integer('subdistrict')->nullable();
            $table->integer('district')->nullable();
            $table->integer('province')->nullable();
            $table->integer('country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->dateTime('dateOfDeath')->nullable(); //Untuk mengetahui apakah sudah meninggal atau belum


            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
