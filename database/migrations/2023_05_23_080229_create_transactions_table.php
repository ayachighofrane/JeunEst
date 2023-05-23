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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partenaire_id');
            $table->foreign('partenaire_id')->references('id')->on('partenaires')->onDelete('cascade');
            $table->unsignedBigInteger('beneficier_id');
            $table->foreign('beneficier_id')->references('id')->on('beneficiers')->onDelete('cascade');
            $table->string('statut');
            $table->date('date_RMH');  
            $table->integer('numero_ticket');
            $table->decimal('montant');
            $table->string('Pm');
            $table->integer('numero_de_dossier');
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
        Schema::dropIfExists('transactions');
    }};