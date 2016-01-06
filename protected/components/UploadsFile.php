<?php

class UploadsFile {

    //导入Excel文件
    public static function uploadFile($file, $filetempname, $filePath) {
        //自己设置的上传文件存放路径
        //$filePath = UPLOAD_TEMP_PATH;
        if (!file_exists($filePath)) {
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($filePath, 0770, true);
        }
        //获取上传文件的文件名扩展名
        $filename = mb_substr($file, 0, (strpos($file, '.')));
        $extend = strrchr($file, '.');

        //检查文件后缀名不为xlsx
        if (strtolower($extend) != '.xlsx' && strtolower($extend) != '.xls') {
            return array('success' => false, 'error' => '对不起,您上传文件的格式不正确!!');
        }

        //注意设置时区,取当前上传的时间
        $time = date("y-m-d-H-i-s");

        //上传后的文件名
        $name = $filename . '-' . $time . $extend;
        //上传后的文件名地址
        $uploadfile = $filePath . $name;
        //函数将上传的文件移动到新位置
        $result = false;
        $error = "";
        try {
            $result = move_uploaded_file($filetempname, $uploadfile);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        if ($result) {
            return array('success' => true, 'uploadfile' => $uploadfile);
            //if (file_exists($uploadfile))
            //unlink($uploadfile);
        } else {
            return array('success' => false, 'error' => '文件上传失败!!' . $file . $uploadfile);
        }
    }

    // 上传图片
    public static function uploadImage($uploadimeage, $file, $filetempname, $path) {
        if (!empty($file)) { //提取文件域内容名称，并判断
            if (!file_exists($path)) {
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir("$path", 0770, true);
            }//END IF
            //允许上传的文件格式
            $tp = array("image/gif", "image/pjpeg", "image/jpeg", "image/png");
            //检查上传文件是否在允许上传的类型
            if (!in_array($uploadimeage["type"], $tp)) {
                return array('success' => false, 'error' => '对不起,您上传图片的格式不正确!!');
                exit();
            }//END IF
            $filetype = $uploadimeage['type'];
            if ($filetype == 'image/jpeg') {
                $type = '.jpg';
            }
            if ($filetype == 'image/jpg') {
                $type = '.jpg';
            }
            if ($filetype == 'image/pjpeg') {
                $type = '.jpg';
            }
            if ($filetype == 'image/gif') {
                $type = '.gif';
            }
            if ($filetype == 'image/png') {
                $type = '.png';
            }
            if ($uploadimeage["name"]) {
                $today = self::random_filename(); //获取时间并赋值给变量 
                $file2 = $path . $today . $type; //图片的完整路径
                $img = $today . $type; //图片名称
                $flag = 1;
               
            }//END IF
            if ($flag)
                $result = move_uploaded_file($uploadimeage["tmp_name"], $file2);
            //特别注意这里传递给move_uploaded_file的第一个参数为上传到服务器上的临时文件
        }//END IF 
        return $img;
    }

    
    /**
     * 为上传文件生成随机名称
     * @return  string
     */
    static public function random_filename() {
    	return date("YmdHis") . rand(10000, 99999);
    }
}