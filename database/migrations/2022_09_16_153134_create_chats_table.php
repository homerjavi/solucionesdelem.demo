<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'user_id' );
            $table->unsignedBigInteger( 'service_id' );
            $table->timestamps();

            $table->index( 'user_id' );
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete('cascade');
            $table->foreign( 'service_id' )->references( 'id' )->on( 'services' )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
