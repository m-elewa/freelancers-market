<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->uuid('id')->primary()->unique();
            $table->uuid('user_id');
            $table->unsignedBigInteger('status_id');
            $table->text('title');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();

            # Constrains
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
