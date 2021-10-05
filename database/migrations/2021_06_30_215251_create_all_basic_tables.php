<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllBasicTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('rfidTag')->nullable();
            $table->float('weight')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('contents');
            $table->integer('status');
            $table->boolean('checkedIn')->default(false);
            //$table->string('location')->nullable();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
          $table->id();
          $table->string('title');
          $table->mediumText('description')->nullable();
          $table->timestamps();
        });

        Schema::create('packlists', function (Blueprint $table) {
          $table->id();
          $table->string('title');
          $table->mediumText('description')->nullable();
          $table->datetime('packingDate')->nullable();
          // TODO: add container list
          $table->timestamps();
        });

        Schema::create('packlist_templates', function (Blueprint $table) {
          $table->id();
          $table->string('title');
          $table->mediumText('description')->nullable();
          // TODO: add container list
          $table->timestamps();
        });

        Schema::create('paths', function (Blueprint $table) {
          $table->id();
          $table->string('title');
          $table->mediumText('description')->nullable();
          $table->integer('location_id')->nullable();
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
        Schema::dropIfExists('containers');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('packlists');
        Schema::dropIfExists('packlist_templates');
        Schema::dropIfExists('paths');
    }
}
