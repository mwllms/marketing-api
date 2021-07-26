<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id');
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('subject')->nullable();
            $table->longText('content')->nullable();
            $table->longText('html')->nullable();
            $table->json('json')->nullable();
            $table->dateTimeTz('planned')->nullable();
            $table->dateTimeTz('send')->nullable();
            $table->string('status')->default('draft');
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
        Schema::dropIfExists('newsletters');
    }
}
