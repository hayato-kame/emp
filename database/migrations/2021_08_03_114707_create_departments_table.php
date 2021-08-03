<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     * こっちが、主テーブルになります。employeesの親テーブルです テーブル作成や、シードファイル作成、マイグレーション実行、シード実行は、親テーブルから先にやる。
     * シードのデータ数も、テテなし子が無いように、親のテーブルのデータ数の方が多いようにする。
     * 主キーは 文字列 オートインクリメントはなし。プライマリーキーだけつける。自動生成するのは、コントローラで書く
     * タイムスタンプを使用しない
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            // $table->id();
            // 主キーが 文字列になります。モデルにも、設定が必要です
            $table->string('department_id', 20)->primary(); // 第二引数の数字は、stringメソッドにだけつけてください。ingeterメソッドにつけると、プライマリーキーがtrueとして認識されてしまう、
            $table->string('department_name', 20);
            // $table->timestamps();  // タイムスタンプを使用しません、モデルにも設定が必要です。
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
