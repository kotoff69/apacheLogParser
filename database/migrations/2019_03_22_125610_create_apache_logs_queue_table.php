<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApacheLogsQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apache_logs_queue', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file', 255)
                ->unique()
                ->nullable(false)
                ->comment('File name');
            $table->boolean('done')
                ->nullable(false)
                ->default(false)
                ->comment('Is done?');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apache_logs_queue');
    }
}
