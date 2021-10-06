<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PacklistContainers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('packlist_containers', function (Blueprint $table) {
        $table->biginteger('packlist_id')->unsigned();
        $table->biginteger('container_id')->unsigned();
        $table->timestamps();

        $table->unique(['packlist_id', 'container_id']);
        $table->foreign('packlist_id')->references('id')->on('packlists')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade')->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('packlist_containers');
    }
}
