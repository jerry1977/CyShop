<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name', 100)->comment('商品名称');
            $table->unsignedInteger('brand_id')->comment('品牌ID');
            $table->unsignedInteger('cate_id')->comment('分类ID');
            $table->unsignedBigInteger('price')->commnet('商品展示价');
            $table->unsignedBigInteger('original')->comment('商品原价');
            $table->string('tags', 255)->comment('商品标签');
            $table->text('content')->comment('商品内容');
            $table->text('summary')->comment('商品描述');
            $table->tinyInteger('is_sale')->defalut(\App\Codes\GoodsStatusCode::ON_SALE)->comment('上架状态: 1是0是');
            $table->timestamps();

            $table->foreign('brand_id') // 分类外键关联
                ->references('id')
                ->on('brand')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cate_id') // 分类外键关联
            ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('goods');
    }
}
