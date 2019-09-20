<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title")->comment("标题");
            $table->string("path")->comment("图片地址");
            $table->string("link")->default("")->comment("图片链接");
            $table->unsignedTinyInteger("is_show")->default(0)->comment("是否显示");
            $table->unsignedTinyInteger("type")->default("1")->comment("类型");
            $table->unsignedTinyInteger("sort")->default(100)->comment("排序, 越小越靠前");
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
        Schema::dropIfExists('banners');
    }
}
