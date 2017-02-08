<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('type');
            $table->timestamps();
        });

        Schema::create('attribute_group_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('attribute_group_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('value');
            $table->timestamps();
            $table->unique(['attribute_group_id', 'locale']);
            $table->foreign('attribute_group_id')->references('id')->on('attribute_groups')->onDelete('cascade');

        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('attribute_group_id')->unsigned();
            $table->string('image')->nullable();
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
            $table->foreign('attribute_group_id')->references('id')->on('attribute_groups')->onDelete('cascade');
        });

        Schema::create('attribute_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('value');
            $table->timestamps();
            $table->unique(['attribute_id', 'locale']);
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attribute_translations');
        Schema::drop('attributes');

        Schema::drop('attribute_group_translations');
        Schema::drop('attribute_groups');
    }
}
