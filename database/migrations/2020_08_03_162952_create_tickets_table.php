<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // tickets table migration showing only the up() schemas with our modifications
        Schema::create('tickets', function (Blueprint $table) {
            $table->string('job');
            $table->bigIncrements('no')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('clients');
            $table->string('brand');
            $table->string('country');
            $table->string('title');
            $table->string('category_name');
            $table->string('priority');
            $table->text('summary');
            $table->string('objective')->nullable();
            $table->text('reference')->nullable();
            $table->string('otherinfo')->nullable();
            $table->string('deadline')->nullable()->default('N/A');
            $table->string('status')->nullable()->default('N/A');
            $table->text('message');
            $table->string('creative')->nullable();
            $table->string('creative_status')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
