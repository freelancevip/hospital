<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('speciality_id')->nullable();
            $table->foreign('speciality_id', 'speciality_fk_6626142')->references('id')->on('specialities');
        });
    }
}
