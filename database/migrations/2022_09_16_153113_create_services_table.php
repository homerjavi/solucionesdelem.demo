<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'user_id' );
            $table->string( 'title', 80 );
            $table->string( 'description' );
            $table->float( 'price' )->unsigned();
            $table->timestamps();

            $table->index( 'user_id' );
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
