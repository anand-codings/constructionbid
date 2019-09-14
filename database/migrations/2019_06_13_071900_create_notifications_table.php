<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('from_user')->nullable()->unsigned();
            $table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('to_user')->nullable()->unsigned();
           $table->foreign('to_user')->references('id')->on('users')->onDelete('cascade');
           $table->bigInteger('proposal_id')->nullable()->unsigned();
           $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->enum('type', ['proposal', 'quote', 'review','admin']);
            $table->longText('title')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notifications');
    }

}
