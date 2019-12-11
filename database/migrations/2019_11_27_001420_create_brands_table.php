<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('br_image')->nullable();
            $table->string('br_name')->unique()->index();
            $table->string('br_slug')->unique()->index();
            $table->text('br_description')->nullable();
            $table->string('br_seo_description')->nullable();
            $table->string('br_seo_keyword')->nullable();
            $table->integer('br_status')->default(1);
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
        Schema::dropIfExists('brands');
    }
}
