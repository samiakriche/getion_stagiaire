<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuiviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suivies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre_stage', 60);
            $table->date('date')->format('d/m/Y');
             $table->unsignedBigInteger('creator_id');
             $table->string('commentaires', 3000);
            $table->timestamps();

           // $table->foreign('creator_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suivies');
    }
}
