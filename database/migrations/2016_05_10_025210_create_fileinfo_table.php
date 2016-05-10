<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('filetype');
            $table->string('mime');
            $table->integer('filesize');
            $table->string('filepath');
            $table->string('downloadid');
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
        Schema::drop('fileinfo');
    }
}
