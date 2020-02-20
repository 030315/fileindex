<?php
/**
 * ファイルインデックスの取得クラス
 */
class FileIndex
{
    // フォルダパス指定
    const DIR = '.';

    // ディレクトリパス
    protected $dir_path;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->dir_path = self::DIR;
    }

    /**
     * ファイルの一覧を取得
     */
    public function index($dir_path)
    {
        if (empty($dir_path)) {
            $dir_path = $this->dir_path;
        }

        $dir = opendir($dir_path);

        $file_array = [];
        while ($name = readdir($dir)) {
            // '.'や'..'をスキップ
            if (strpos($name, '.') === 0) {
                continue;
            }

            $type = 'file';
            if (is_dir($dir_path. DIRECTORY_SEPARATOR .$name)) {
                $type = 'directory';
            }

            $file_array[] = [
                'name' => $name,
                'type' => $type,
                'path' => $dir_path. DIRECTORY_SEPARATOR .$name,
            ];
        }

        return $file_array;
    }

    /**
     * ディレクトリのインデックスを取得する
     * @return Array $dir_array ディレクトリの配列
     */
    public function getDirIndex()
    {
        $dir_array[$this->dir_path] = $this->dirTree($this->dir_path);
        return $dir_array;
    }

    /**
     * ディレクトリのツリー構造を取得する（再帰処理）
     * @param String $dir_path ディレクトリパス
     * @return Array $dir_array ディレクトリの配列
     */
    private function dirTree($dir_path)
    {
        $dir = opendir($dir_path);

        $dir_array = [];
        while ($dir_name = readdir($dir)) {
            // '.'や'..'をスキップ
            if (strpos($dir_name, '.') === 0) {
                continue;
            } 
            if (is_dir($dir_path . DIRECTORY_SEPARATOR . $dir_name)) {
                $dir_array[$dir_name] = $this->dirTree($dir_path . DIRECTORY_SEPARATOR . $dir_name);
            }
        }

        return $dir_array;
    }
}
