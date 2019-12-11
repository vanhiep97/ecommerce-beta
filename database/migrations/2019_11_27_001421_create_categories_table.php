<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cat_image')->nullable();
            $table->string('cat_name')->index()->unique();
            $table->string('cat_slug')->index()->unique();
            $table->integer('cat_parent_id')->default(0)->nullable();
            $table->text('cat_description')->nullable();
            $table->string('cat_seo_description')->nullable();
            $table->string('cat_seo_keyword')->nullable();
            $table->integer('cat_status')->default('1');
            $table->string('admin_create');
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
        Schema::dropIfExists('categories');
    }
}
