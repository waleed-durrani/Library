<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('edition')->nullable();
            $table->string('publisher')->nullable();
            $table->string('author')->nullable();
            $table->boolean('available');
            $table->timestamp('added_on','CURRENT_TIMESTAMP');
            $table->unique( array('category_id','name','edition') );
            $table->foreign('category_id')
            ->references('id')->on('categories')
                            ->onDelete('cascade')
                            ->onUpdate('cascade');
                            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
