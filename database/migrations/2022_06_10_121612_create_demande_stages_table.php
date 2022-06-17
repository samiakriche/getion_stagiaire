<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandeStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_stages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 60);
            
            $table->date('date_debut')->format('d/m/Y');
            $table->date('date_fin')->format('d/m/Y');
            $table->string('societe', 60);

            $table->string('name_file', 60);
            $table->string('path_file', 60);
            $table->string('status', 60);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->string('encadrant_id')->nullable();
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('restrict');
           // $table->foreign('encadrant_id')->references('id')->on('encadrants')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande_stages');
    }
}
