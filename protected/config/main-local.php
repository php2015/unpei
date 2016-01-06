<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'components' => array(
            'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=ht',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            //'tablePrefix' => 'tbl_',
            'schemaCachingDuration' => 3600, //表概要缓存时间，单位秒
        ),
//        'db' => array(
//            'class' => 'CDbConnection',
//            'connectionString' => 'mysql:host=172.23.3.29;dbname=unipei',
//            'emulatePrepare' => true,
//            'username' => 'unipei',
//            'password' => 'jiaparts',
//            'charset' => 'utf8',
//            'tablePrefix' => 'tbl_',
//            'schemaCachingDuration' => 3600, //表概要缓存时间，单位秒
//        ),
        'csdb' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=172.23.3.29;dbname=cs',
            'emulatePrepare' => true,
            'username' => 'unipei',
            'password' => 'jiaparts',
            'charset' => 'utf8',
            'tablePrefix' => 'cs_',
            'schemaCachingDuration' => 3600, //表概要缓存时间，单位秒
        ),
        'jpdb' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=172.23.3.29;dbname=jpd',
            'emulatePrepare' => true,
            'username' => 'unipei',
            'password' => 'jiaparts',
            'charset' => 'utf8',
            'tablePrefix' => 'jpd_',
            'schemaCachingDuration' => 3600, //表概要缓存时间，单位秒
        ),
        'papdb' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=172.23.3.29;dbname=pap',
            'emulatePrepare' => true,
            'username' => 'unipei',
            'password' => 'jiaparts',
            'charset' => 'utf8',
            'tablePrefix' => 'pap_',
            'schemaCachingDuration' => 3600, //表概要缓存时间，单位秒
        ),
        'dspdb' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=172.23.3.29;dbname=dsp',
            'emulatePrepare' => true,
            'username' => 'unipei',
            'password' => 'jiaparts',
            'charset' => 'utf8',
            'tablePrefix' => 'dsp_',
            'schemaCachingDuration' => 3600, //表概要缓存时间，单位秒
        ),
        'mongodb' => array(
            'class' => 'EMongoDB', //主文件  
            'connectionString' => 'mongodb://172.23.3.33:27017', //服务器地址 
            'dbName' => 'jiaparts', //数据库名称  
            'fsyncFlag' => true, //mongodb的确保所有写入到数据库的安全存储到磁盘  
            'safeFlag' => true, //mongodb的等待检索的所有写操作的状态，并检查  
            'useCursor' => false, //设置为true，将启用游标  
        ),
        'chatmongodb' => array(
            'class' => 'EMongoDB', //主文件  
            'connectionString' => 'mongodb://172.23.3.33:27017', //服务器地址 
            'dbName' => 'jpchat', //数据库名称  
            'fsyncFlag' => true, //mongodb的确保所有写入到数据库的安全存储到磁盘  
            'safeFlag' => true, //mongodb的等待检索的所有写操作的状态，并检查  
            'useCursor' => false, //设置为true，将启用游标  
        ),
        'search' => array(
            'class' => 'ext.DGSphinxSearch.DGSphinxSearch',
            'server' => '172.23.3.33',
            'port' => 9312,
            'maxQueryTime' => 3000,
            'enableProfiling' => 0,
            'enableResultTrace' => 0,
            'fieldWeights' => array(
                'name' => 10000,
                'keywords' => 100,
            ),
        ),
        'redis' => array(
            'class' => 'ext.redis.CRedisCache', //对应protected/extensions/redis/CredisCache.php
            'servers' => array(
                array(
                    'host' => '172.23.3.24',
                    'port' => 6379,
                    'database' => 0
                )
            ),
           // 'hashKey' => false,
            'keyPrefix' => '',
        ),
    /*
      'db_epc'=>array(
      'class' => 'CDbConnection',
      'connectionString' => 'mysql:host=192.168.2.29;dbname=unipei',
      'emulatePrepare' => true,
      'username' => 'unipei',
      'password' => 'jiaparts',
      'charset' => 'utf8',
      //'tablePrefix' => 'tbl_',
      ),
     */
    )
);
