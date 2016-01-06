<?php

//ftp上传
class Ftp {

    private $hostname = '172.23.3.29';
    private $port = 21;
    private $username = 'ftpuser';
    private $passwd = 'ftpuser';
    private $ftp = FALSE;
    private $visiturl = 'http://172.23.3.29:82/upload/';

    //连接ftp及登录
    public function __construct() {
        if (!function_exists('ftp_connect')) {
            die('不支持ftp_connect方法');
        }
        $parmas = Yii::app()->params['ftpserver'];
        //初始化参数
        if ($parmas) {
            $this->_init($parmas);
        }
        //连接ftp
        $this->ftp = @ftp_connect($this->hostname, $this->part) or die($this->hostname . ' FTP服务器连接失败,端口:' . $this->port);
        //登录ftp
        $login = @ftp_login($this->ftp, $this->username, $this->passwd) or die($this->hostname . 'FTP服务器登陆失败');
        //不添加则在172.23.3.29上传时报错  Failed to establish connection.
        @ftp_pasv($this->ftp, true);  //开启被动模式    
    }

    /**
     * FTP成员变量初始化
     *
     * @access  private
     * @param   array   配置数组    
     * @return  void
     */
    private function _init($config = array()) {
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                $this->$key = $val;
            }
        }

        //特殊字符过滤
        $this->hostname = preg_replace('|.+?://|', '', $this->hostname);
    }

    /**
     * 上传
     *
     * @access  public
     * @param   string  本地文件目录
     * @param   string  远程目录(ftp)
     * @param   string  上传模式 auto || ascii
     * @param   int     上传后的文件权限列表(如:0777) 
     * @return  array
     */
    public function uploadfile($localpath, $remotepath, $mode = 'auto', $permissions = 0777) {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        if (!file_exists($localpath)) {
            return array('success' => false, 'msg' => '要上传的文件不存在');
        }
        if (strpos($remotepath, '/') !== false) {  //检查字符串是否存在
            //如果$remotepath带目录,则判断目录是否存在,不存在则创建 
            if (strpos($remotepath, '/') == 0)
                $remotepath = ltrim($remotepath, '/');
            $dirres = $this->dir_mkdirs($remotepath);
            if ($dirres['success'] == false)
                return $dirres;
        }
        if ($mode == 'auto') {
            $ext = $this->getext($localpath);
            $mode = $this->setmode($ext);
        }
        $mode = ($mode == 'ascii') ? FTP_ASCII : FTP_BINARY;
        $result = @ftp_put($this->ftp, $remotepath, $localpath, $mode);
        if ($result === FALSE) {
            $pwd = $this->getpwd();
            return array('success' => false, 'msg' => '无法上传到' . $pwd . '/' . $remotepath);
        }
        $this->chmod($remotepath, (int) $permissions);
//        if (!is_null($permissions)) {
//            $this->chmod($remotepath, (int) $permissions);
//        }
        return array('success' => true, 'msg' => '上传成功', 'url' => $this->visiturl . $remotepath);
    }

    /**
     * 下载
     *
     * @access  public
     * @param   string  远程目录标识(ftp)
     * @param   string  本地目录标识
     * @param   string  下载模式 auto || ascii 
     * @return  boolean
     */
    public function download($remotepath, $localpath, $mode = 'auto') {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        if ($mode == 'auto') {
            $ext = $this->getext($remotepath);
            $mode = $this->setmode($ext);
        }

        $mode = ($mode == 'ascii') ? FTP_ASCII : FTP_BINARY;

        $result = @ftp_get($this->ftp, $localpath, $remotepath, $mode);

        if ($result === FALSE) {
            return array('success' => false, 'msg' => "ftp_unable_to_download:localpath[" . $localpath . "]-remotepath[" . $remotepath . "]");
        }

        return array('success' => true);
    }

    //ftp上传检查目录是否存在并新建
    private function dir_mkdirs($path) {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        $paths = $path;
        $path = explode('/', $path);
        array_pop($path);
        foreach ($path as $k => $dir) {
            //判断目录是否存在   ftp_chdir($this->ftp, $dir) == false可能是目录不存在或者权限不够
            if (@ftp_chdir($this->ftp, $dir) == false) {
                //判断目录是否创建成功  
                if (@ftp_mkdir($this->ftp, $dir) == false) {
                    return array('success' => false, 'msg' => $this->getpwd() . '/' . $dir . ' 创建失败或者权限不够不能访问');
                }
                @ftp_chmod($this->ftp, 0777, $dir);
                @ftp_chdir($this->ftp, $dir);
            }
        }
        $path_div = count($path);
        // 回退到初始目录 
        for ($i = 1; $i <= $path_div; $i++) {
            @ftp_cdup($this->ftp);
        }
        return array('success' => true, 'msg' => $paths . '创建成功');
    }

    /**
     * 重命名/移动
     *
     * @access  public
     * @param   string  远程目录标识(ftp)
     * @param   string  新目录标识
     * @param   boolean 判断是重命名(FALSE)还是移动(TRUE)
     * @return  boolean
     */
    public function rename($oldname, $newname, $move = FALSE) {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        if ($move) {
            if (strpos($newname, '/') !== false) {  //检查字符串是否存在
                //如果带目录,则判断目录是否存在,不存在则创建 
                if (strpos($newname, '/') == 0)
                    $newname = ltrim($newname, '/');
                $dirres = $this->dir_mkdirs($newname);
                if ($dirres['success'] == false)
                    return $dirres;
            }
        }
        $result = @ftp_rename($this->ftp, $oldname, $newname);
        if ($result === FALSE) {
            $msg = ($move == FALSE) ? 'ftp 重命名失败' : 'ftp移动失败';
            return array('success' => false, 'msg' => $msg);
        }
        $msg = ($move == FALSE) ? 'ftp 重命名成功' : 'ftp移动成功';
        return array('success' => true, 'msg' => $msg);
    }

    /**
     * 删除文件
     *
     * @access  public
     * @param   string  文件标识(ftp)
     * @return  boolean
     */
    public function delete_file($file) {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        $result = @ftp_delete($this->ftp, $file);
        if ($result === FALSE) {
            return array('success' => false, 'msg' => 'ftp_unable_to_delete_file:file[' . $file . ']');
        }
        return array('success' => true, 'msg' => $file . '删除成功');
    }

    /**
     * 删除文件夹
     *
     * @access  public
     * @param   string  目录标识(ftp)
     * @return  boolean
     */
    public function delete_dir($path) {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        //对目录宏的'/'字符添加反斜杠'\'
        $path = preg_replace("/(.+?)\/*$/", "\\1/", $path);
        //获取目录文件列表
        $filelist = $this->filelist($path);
        if ($filelist !== FALSE && count($filelist) > 0) {
            foreach ($filelist as $item) {
                //如果我们无法删除,那么就可能是一个文件夹
                //所以我们递归调用delete_dir()
                if (!$this->delete_file($item)) {
                    $this->delete_dir($item);
                }
            }
        }
        //删除文件夹(空文件夹)
        $result = @ftp_rmdir($this->ftp, $path);
        if ($result === FALSE) {
            return array('success' => false, 'msg' => ' ftp_unable_to_delete_dir:dir[' . $path . ']');
        }
        return array('success' => true, 'msg' => $path . ' 删除成功');
    }

    /**
     * 修改文件权限
     *
     * @access  public
     * @param   string  目录标识(ftp)
     * @return  boolean
     */
    public function chmod($path, $perm) {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        //只有在PHP5中才定义了修改权限的函数(ftp)
        if (!function_exists('ftp_chmod')) {
            return array('success' => false, 'msg' => 'ftp不支持ftp_chmod函数');
        }
        $result = @ftp_chmod($this->ftp, 0777, $path);
        if ($result === FALSE) {
            return array('success' => false, 'msg' => 'ftp_unable_to_chmod:path[' . $path . ']-chmod[' . $perm . ']');
        }
        return array('success' => true, 'msg' => $path . '修改权限为' . $perm . '成功');
    }

    //获取文件目录
    public function filelist($path = '.') {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        return ftp_nlist($this->ftp, $path);
    }

    /**
     * 从文件名中获取后缀扩展
     *
     * @access  private
     * @param   string  目录标识
     * @return  string
     */
    private function getext($filename) {
        if (FALSE === strpos($filename, '.')) {
            return 'txt';
        }
        $extarr = explode('.', $filename);
        return end($extarr);
    }

    /**
     * 从后缀扩展定义FTP传输模式  ascii 或 binary
     *
     * @access  private
     * @param   string  后缀扩展
     * @return  string
     */
    private function setmode($ext) {
        $text_type = array('txt', 'text', 'php', 'phps', 'php4', 'js', 'css', 'htm', 'html', 'phtml', 'shtml', 'log', 'xml');
        return (in_array($ext, $text_type)) ? 'ascii' : 'binary';
    }

    //获取当前目录
    private function getpwd() {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        return ' ' . $this->hostname . ' : ' . @ftp_pwd($this->ftp);
    }

    //判断ftp是否连接
    private function isconn() {
        if (!is_resource($this->ftp)) {
            return FALSE;
        }
        return TRUE;
    }

    //关闭ftp连接
    public function close() {
        if (!$this->isconn()) {
            return array('success' => false, 'msg' => 'ftp未连接');
        }
        return @ftp_close($this->ftp);
    }

    //ftp文件用户下载  使用方法: Ftp::down('a/a.txt','aa.txt');
    public static function down($fileurl, $filename) {
        $visiturl = Yii::app()->params['ftpserver']['visiturl'];
        $ch = curl_init();
        if (!$fileurl)
            return array('success' => false, 'msg' => '请输入正确的文件路径');
        if (strpos($fileurl, 'http://') !== false) {
            $url = $fileurl;
        } else {
            $url = $visiturl . $fileurl;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            curl_close($ch);
        } else {
            curl_close($ch);
            if (preg_match("/404/", $content)) {
                return array('success' => false, 'msg' => '文件不存在');
            }
            $ua = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : '';
            //通知浏览器下载文件
            $encoded_filename = urlencode($filename);
            $encoded_filename = str_replace("+", "%20", $encoded_filename);
            header('Content-Type: application/octet-stream');
            if (preg_match("/MSIE/", $ua) || preg_match("/Trident\/7.0/", $ua)) {
                header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
            } else if (preg_match("/Firefox/", $ua)) {
                header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
            } else {
                header('Content-Disposition: attachment; filename="' . $filename . '"');
            }
            exit($content); //输出数据流
        }
    }

    //判断远程文件是否存在
    public static function ifexist($fileurl) {
        $visiturl = Yii::app()->params['ftpserver']['visiturl'];
        $ch = curl_init();
        if (!$fileurl)
            return array('success' => false, 'msg' => '请输入正确的文件路径');
        if (strpos($fileurl, 'http://') !== false) {
            $url = $fileurl;
        } else {
            $url = $visiturl . $fileurl;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            curl_close($ch);
        } else {
            curl_close($ch);
            if (preg_match("/404/", $content)) {
                return array('success' => false, 'msg' => '文件不存在');
            } else {
                return array('success' => true, 'msg' => '文件存在');
            }
        }
    }

}

?>
