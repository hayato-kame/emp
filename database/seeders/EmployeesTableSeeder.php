<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// 追加
use App\Models\Employee;
// こっちの  DB を useしてください。
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * photosテーブルが親テーブル１対１リレーションだから、まず、photosテーブルのシードデータを同じ数作らないといけません。
     * 今回employeesテーブルには 12データ作るので、その前に、親テーブルのシーダーで、12データ作らないとだめ。
     * 外部キーで 'photo_id'カラムは　親データの　'photo_id'カラムを参照しているので、親テーブルのデータを先に作らないと、
     * 親テーブルの 'photo_id'カラムには、その登録はない、と怒られます。
     * 子テーブルよりも先に、親テーブルを作成して、シードの実行も、親テーブルから実行しないと、エラーです。しかも、親テーブルに登録してある、参照先がない、子データは作れません。
     * データの整合性を保つために、外部キー制約では、子テーブルのデータを作成する際に、
     * 親テーブルに子テーブルの外部キーに紐づいているキーが存在するかチェックしてから行っているからです、
     * 子テーブルに、テテなし子状態のデータが登録されるのを防ぐ機能があります。
     *
     * @return void
     */
    public function run()
    {
        // 1つ目データ
        $param = [
            'employee_id' => 'EMP0001',
            'name' => '山田 太郎',
            'age' => 35,
            'gender' => 1,  // 男
            'photo_id' => 1,  // 外部キー設定したカラム
            'zip_number' => '100-0001',
            'pref' => '東京都',
            'address1' => '千代田区',
            'address2' => '千代田',
            'address3' => 'ちよだ',
            'department_id' => 'D01',  // 外部キー設定したカラム
            'hire_date' => '2000-11-11',  // モデルにて$datesプロパティをオーバーライドすることで Carbonインスタンスへ変換します
            'retire_date' => null,
        ];
        $employee = new Employee();
        $employee->fill($param)->save();

        // ２つ目のデータ
        $param = [
            'employee_id' => 'EMP0002',
            'name' => '日本 花子',
            'age' => 27,
            'gender' => 2,  // 女
            'photo_id' => 2,  // 外部キー設定したカラム
            'zip_number' => '330-0841',
            'pref' => '埼玉県',
            'address1' => 'さいたま市',
            'address2' => '大宮区',
            'address3' => '東町',
            'department_id' => 'D03',  // 外部キー設定したカラム
            'hire_date' => '1999-01-01',
            'retire_date' => '2003-03-03',
        ];
        // $employee = new Employee();
        // $employee->fill($param)->save();
        // こっちのやり方でもいい
        DB::table('employees')->insert($param);

        // 3つ目のデータ
        $param = [
            'employee_id' => 'EMP0003',
            'name' => '東京 次郎',
            'age' => 41,
            'gender' => 1,  // 男
            'photo_id' => 3,  // 外部キー設定したカラム
            'zip_number' => '251-0013',
            'pref' => '神奈川県',
            'address1' => '川崎市',
            'address2' => '麻生区',
            'address3' => '王禅区',
            'department_id' => 'D03',
            'hire_date' => '1998-12-12',
            'retire_date' => null,
        ];
        $employee = new Employee();
        $employee->fill($param)->save();


        // 4つ目から12つ目のデータ
        $fnames = ['伊藤', '山本', '中村', '小林'];
        $gnames = ['三郎', '四郎', '友子'];
        $prefArray = ['東京都', '千葉県', '茨城県', '神奈川県'];
        $departmentIdArray = ['D01', 'D02', 'D03'];

        for ($i = 1; $i <= 9; $i++) {
            $employee_id = sprintf("EMP%04d", $i + 3);  // 'EMP0001' 'EMP0002' 'EMP0003' までは作成済みなので
            // 文字列の中で変数展開する時は、必ずダブルクオーテーションで囲むこと シングルクオーテーションだとだめ
            


        }



    }
}
