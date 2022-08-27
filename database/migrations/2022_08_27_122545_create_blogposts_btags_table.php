<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogpostsBtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogpost_btag', function (Blueprint $table) {
            $table->unsignedBigInteger('blogpost_id');
            $table->unsignedBigInteger('btag_id');
            $table->timestamps();

            $table->foreign('blogpost_id')->references('id')->on('blogposts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('btag_id')->references('id')->on('btags')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogposts_btags');
    }
}
