<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    //primaryKeyの変更
    protected $primaryKey = 'photo_id';

    // fillメソッドを使う時に、このカラムを一気にセットして、保存できる
    protected $fillable = ['photo_data', 'mime_type'];
    // フォームから、送信された後、登録または更新する時に、$guarded フィールドに書いてある カラムのセットがなくても、エラーにならずに、保存可能になる
    // 何も設定しなかったら、各々のデータ型の初期値とか、nullになるのかな 新規で nullable　に設定したのは、nullになる。更新の時は、そのカラムはそのまま。
    protected $guarded = ['photo_id', 'mime_type', 'photo_data']; // 'photo_id'カラムは 自動採番 後から変更もしない

    // Photoモデルは、主データです。 Employeeが　従データです。先に Employeeモデルを作成する
    // １対１のリレーションです  hasOne設定   employee() というふうにメソッド名は単数型にする
    public function employee() {
        return $this->hasOne(Employee::class, 'employee_id'); // 第二引数外部キー
    }

    // 本来は、モデルクラスに、バリデーションルールと、バリデーション時のエラーメッセージの設定を書くと扱いやすいが、
    // 今回は、フォームリクエストを使って、そちらで管理する。HTTPフォルダ下に Requestsフォルダ作成 その中に、EmployeeFormRequest.php作る
    // クラスフィールドとして、宣言する。使用するときは、クラス名.クラスフィールド名 で参照できる。

// 今回は、php.iniファイル開けて upload_max_filesize = 30M  にしました。Mac Finderの移動から  /usr/local/etc に移動してください、
// /usr/local/etc/php/7.4/php.ini にあります。
// php.iniファイルを開いてpost_max_sizeを探します。post_max_size = 20M にします。



    // public static $rules = [
    //     'photo_data' => [ 'nullable','file', 'image', 'max:5120', 'mimes:jpeg, png, jpg, tmp' ],
    // ];

    // 'file'     ファイルはアップロードされたファイルであること
    // 'image'     画像ファイルであること
    // 'mimes:jpeg, png, jpg, tmp'     MIMEタイプの指定
    //  'max:5120'       (1MB = 1024KB 2MB =2048KB 5MB =5120KB  となります)



    // public static $messages = [
    //     'photo_data.file' => '画像ファイルを選んでください',
    //     'photo_data.image' => '画像ファイルを選んでください',
    //     'photo_data.max' => '5Mを超えています',
    //     'photo_data.mimes' => '画像ファイルは、jpeg png jpg tmpのいずれかにして下さい',
    // ];

}


        // post_max_size　　　POSTリクエストの上限サイズ
        //  post_max_size   POSTリクエストの中身が8MBを超えてますよという  ログを見るとこんなWarningが出力されています。
        //     PHPではセキュリティなどの都合でリクエストの上限サイズが設定されています。
        // 上限サイズを変更したい場合はphp.iniの設定を変更する必要があります。
        // php.iniファイルを開いてpost_max_sizeを探します。post_max_size = 20M
        // 大きなファイルをアップロードすると403になってしまったりする場合はこれが原因である場合が多いです。

        // アップロード画像が php.ini　デフォルトだと upload_max_filesize = 2M  これも  upload_max_filesize = 30M  にするなどする必要もあるかも時によって
        // 2つの値を設定したらサーバーを再起動するのを忘れないように
        // もしこれらを、変更し無いのなら。The photo data failed to upload.　のエラーメッセージが出ますので、
        //  resource/lang\en/validation.php ファイルを修正して日本語にします。

        // 今回は、php.iniファイル開けて upload_max_filesize = 30M  にしました。
        // 今回は、php.iniファイル開けて upload_max_filesize = 30M  にしました。Mac Finderの移動から  /usr/local/etc に移動してください、
        // /usr/local/etc/php/7.4/php.ini にあります。



