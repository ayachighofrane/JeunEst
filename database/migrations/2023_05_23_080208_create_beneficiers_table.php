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
         Schema::create('beneficiers', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('user_id');
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->unsignedBigInteger('numero_de_carte')->nullable();
             $table->integer('code_pin')->nullable();
             $table->integer('code_postal');
             $table->string('ville');
             $table->date('date_naissance');
             $table->decimal('solde_dispo')->nullable();
             //$table->string('qr_code')->nullable();
             $table->timestamps();
             $table->longText('image');

         });
     }
 
     public function down()
     {
         Schema::dropIfExists('beneficiers');
     }
};



