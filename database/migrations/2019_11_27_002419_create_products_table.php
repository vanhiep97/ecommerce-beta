<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pro_code')->index();
            $table->string('pro_avatar')->nullable();
            $table->string('pro_name')->index()->unique();
            $table->string('pro_slug')->index()->unique();
            $table->string('pro_seo_description')->nullable();
            $table->string('pro_seo_keyword')->nullable();
            $table->integer('pro_status')->default('1');
            $table->string('admin_create');
            $table->unsignedBigInteger('type_pro_id');
            $table->foreign('type_pro_id')->references('id')->on('type_products')->onDelete('cascade');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
