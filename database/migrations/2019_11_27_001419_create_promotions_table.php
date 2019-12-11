<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pm_image')->nullable();
            $table->string('pm_name')->unique()->index();
            $table->string('pm_slug')->index()->unique();
            $table->text('pm_description')->nullable();
            $table->string('pm_seo_description')->nullable();
            $table->string('pm_seo_keyword')->nullable();
            $table->string('admin_create');
            $table->integer('pm_status')->default(1);
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
        Schema::dropIfExists('promotions');
    }
}
