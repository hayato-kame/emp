<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//追加
use Illuminate\Support\Facades\DB;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     * 親テーブルです 子がemployeesテーブルです。写真は必須では無いので、null可のカラム 主キーが、子テーブルから参照されてるので、外部キーなので
     * 子テーブルのデータ型と合わせてください。
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('photo_id');
            // このbigIncrementsメソッドは主キーに相当するカラムを作成しますので、これだけで、主キーとなってます。
            // 自動インクリメントUNSIGNED BIGINT（主キー）に相当するので、自動採番します。
            // 従テーブルのemployeesテーブルでは、データ型を合わせるために、unsignedBigIntegerメソッドを使ってください

            // ここで、Blob型を書かないでください。binaryメソッドでは、バイナリーデータが大きくて、間に合わないので。
            // $table->binary('photo_data')->nullable();  // コメントアウトする

            $table->string('mime_type')->nullable;

            $table->timestamps();
        });
        // ここで　書いてください   MEDIUMBLOB　じゃないと、データが保存できないからです
        // Blob型だと小さすぎるからです、  MEDIUMBLOBの書き方はメソッドは無いから
        DB::statement("ALTER TABLE photos ADD photo_data MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
