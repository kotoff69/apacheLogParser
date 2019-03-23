<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApacheLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apache_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('ip')
                ->nullable(true)
                ->default(null)
                ->comment('IP address');

            $table->string('identity', 255)
                ->nullable(true)
                ->default(null)
                ->comment('Identity');

            $table->string('user', 255)
                ->nullable(true)
                ->default(null)
                ->comment('User');

            $table->string('date_time', 255)
                ->comment('Date time');

            $table->string('timezone', 10)
                ->comment('Timezone');

            $table->string('method', 10)
                ->comment('Method');

            $table->text('path')
                ->comment('Path');

            $table->string('protocol', 10)
                ->comment('Protocol');

            $table->unsignedSmallInteger('status')
                ->comment('Status');

            $table->string('bytes', 50)
                ->nullable(true)
                ->default(null)
                ->comment('Bytes');

            $table->text('referer')
                ->nullable(true)
                ->default(null)
                ->comment('Referer');

            $table->text('agent')
                ->nullable(true)
                ->default(null)
                ->comment('Agent');

            $table->index('ip');
            $table->index('date_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apache_log');
    }
}
