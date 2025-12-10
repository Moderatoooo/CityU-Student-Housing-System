<?php


/**
 * 数据库链接类,依赖mysqli库运行
 * Class class_mysql
 */
class class_mysql{
    var $link_id = null;
    var $settings = array();
    var $quiet = 0;
    var $version = '';
    var $queryCount = 0;
    var $queryTime  = '';
    var $error = '';
    var $pre = '';
    var $pres = '';
    /**
     * @var mysqli
     */
    var $mysqli = null;
    var $queryID = null;


    /**
     * class_mysql constructor.
     * @param $config 配置信息  在文件conn.php 中
     */
    function __construct($config){
        if (defined('CHARSET'))
        {
            $charset = strtolower(str_replace('-', '', CHARSET));
        }else{
            $charset = strtolower(str_replace('-', '', $config['charset']));
        }

        //  表前缀
        $this->pre = $config['pre'];
        $this->dbname = $config['dbname'];
        $this->pres = $this->pre;

        $this->settings = array(
            'dbhost'   => $config['host'],
            'port'     => $config['port'] ? $config['port'] : '3306',
            'dbuser'   => $config['user'],
            'dbpw'     => $config['pass'],
            'dbname'   => $config['dbname'],
            'charset'  => $charset,
            'pconnect' => $config['pconnect']
        );
    }

    /**
     * 生成表前缀
     * @param $name
     * @return string
     */
    function T( $name ){
        return $this->pres .$name;
    }

    /**
     * 获取错误信息
     * @return string
     */
    function getError(){
        return $this->error;
    }

    /**
     * 根据 $sql 搜索一行数据
     * @param $sql
     * @return array|bool|null
     */
    function find( $sql )
    {
        return $this->getRow($sql);
    }

    /**
     * 根据$sql 搜索数据集
     * @param $sql
     * @return array|bool
     */
    function select($sql)
    {
        return $this->getAll($sql);
    }

    /**
     * 连接数据库
     * @return bool
     */
    function connect(){
        $this->starttime = time();
        // 连接数据库
        $this->mysqli = new mysqli($this->settings['dbhost'] , $this->settings['dbuser'] , $this->settings['dbpw'] , $this->settings['dbname'] , $this->settings['port']);

        if ($this->mysqli->connect_error)  // 连接错误，返回错误信息
        {
            $this->error = "链接 MySQL ({$this->settings['dbhost']})，出错，!错误：".$this->mysqli->connect_error;
            ob_end_clean();
            die($this->error);
        }

        // 获取mysql 版本信息
        define('MYSQL_VERSION' , $this->mysqli->get_server_info());
        $this->version = MYSQL_VERSION;
        //$this->mysqli->set_charset('utf8');
        //$this->set_mysql_charset($this->settings['charset']);
        $this->mysqli->query("SET NAMES '".$this->settings['charset']."'"); // 设置数据库编码为 utf-8
        if(MYSQL_VERSION >'5.0.1'){
            $this->mysqli->query("SET sql_mode=''"); //  设置数据库 sql 模式
        }
        return true;
    }


    /**
    +----------------------------------------------------------
     * 取得数据表的字段信息
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     */
    public function getFields($tableName) {
        $result =   $this->getAll('SHOW COLUMNS FROM '.$tableName);
        $info   =   array();
        if($result) {
            foreach ($result as $key => $val) {
                $info[$val['Field']] = array(
                    'name'    => $val['Field'],
                    'type'    => $val['Type'],
                    'notnull' => (bool) ($val['Null'] === ''), // not null is empty, null is yes
                    'default' => $val['Default'],
                    'primary' => (strtolower($val['Key']) == 'pri'),
                    'autoinc' => (strtolower($val['Extra']) == 'auto_increment'),
                );
            }
        }
        return $info;
    }

    /**
     * 选择数据库
     * @param $dbname
     * @return bool
     */
    function select_database($dbname)
    {
        if ( $this->mysqli->select_db($dbname) === false )
        {
            $this->error = "Can't select MySQL database($dbname)!";
            return false;
        }
        return true;
    }

    /**
     * 获取当前执行了多少条sql 语句
     * @return int
     */
    function getQueryCount(){return $this->queryCount;}


    /**
     * 释放查询结果
     * @access public
     */
    public function free() {
        if($this->queryID && method_exists($this->queryID, 'free_result')){
            $this->queryID->free_result();
            $this->queryID = null;
        }
    }

    /**
     * 设置mysql 字符集
     * @param $charset
     */
    function set_mysql_charset($charset)
    {
        $charset = str_replace('-', '', $charset);
        $this->mysqli->query("SET character_set_connection=$charset, character_set_results=$charset, character_set_client=$charset");
    }

    /**
     * 根据查询资源获取一行数据
     * @param $query
     * @param int $result_type
     * @return mixed
     */
    function fetch_array($query, $result_type = MYSQLI_ASSOC){
        return $query->fetch_array($query, $result_type);
    }
    public $lastSql = '';

    /**
     * 执行SQL语句
     * @param $sql
     * @param string $type
     * @return bool|mysqli_result|null
     */
    function query($sql, $type = ''){
        if ($this->mysqli === NULL){
            $this->connect();
        }
        // 先看上一次是否有查询过的记录，有则先取消上一次的数据
        if($this->queryID !== null)$this->free();

        $this->queryCount++;

        // 写入最后执行的sql 语句
        $this->lastSql = $sql;
        if ($this->queryTime == '')
        {
            if (PHP_VERSION >= '5.0.0')
            {
                $this->queryTime = microtime(true);
            }
            else
            {
                $this->queryTime = microtime();
            }
        }

        if (PHP_VERSION >= '4.3' && ($t = time()) > $this->starttime + 3)
        {
            $this->mysqli->ping();
            $this->starttime = $t;
        }
        //var_dump($this->mysqli);
        // 执行sql 语句，并把结果写入 queryID
        if (($this->queryID = $this->mysqli->query($sql)) === false)
        {
            // 如果错误，则取消执行下面的代码
            $str = "Message: MySQL Query Error<br />".
                "SQL:".$sql."<br />".
                'Error: '.$this->error()."<br />".
                'Errno: '.$this->errno();
            $this->error = $str;
            die($str);
        }

        if( $this->mysqli->more_results() ){
            while (($res = $this->mysqli->next_result()) != NULL) {
                $res->free_result();
            }
        }

        return $this->queryID;
    }

    /**
     * 获取错误信息
     * @return string
     */
    function error(){
        return $this->mysqli->error;
    }

    /**
     * 获取错误码
     * @return int
     */
    function errno(){
        return $this->mysqli->errno;
    }

    /**
     * 获取影响了多少行
     * @return int
     */
    function affected_rows()
    {
        return $this->mysqli->affected_rows;
    }

    function result($query, $row)
    {

    }

    /**
     * 获取行数
     * @param $query
     * @return mixed
     */
    function num_rows($query)
    {
        return $query->num_rows($query);
    }

    /**
     * 获取插入后的id
     * @return mixed
     */
    function insert_id()
    {
        return $this->mysqli->insert_id;
    }

    /**
     * 检索一行
     * @param $query
     * @return mixed
     */
    function fetchRow($query)
    {
        return $query->fetch_assoc();
    }

    /**
     * 获取字段
     * @param $query
     * @return mixed
     */
    function fetch_fields($query)
    {
        return $query->fetch_field($query);
    }

    /**
     * 获取mysql 版本
     * @return string
     */
    function version()
    {
        return $this->version;
    }

    /**
     * 关闭mysql
     * @return bool
     */
    function close()
    {
        return $this->mysqli->close();
    }

    /**
     * 根据sql 语句获取 第一行 第一列数据
     * @param $sql
     * @param bool $limited
     * @return bool|string
     */
    function getOne($sql, $limited = false)
    {
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }
        $res = $this->query($sql);
        if ($res !== false)
        {
            $row = $res->fetch_row();
            $this->free();
            if ($row !== false)
            {
                return $row[0];
            }
            else
            {
                return '';
            }
        }
        return false;
    }

    /**
     * 根据sql 语句 获取所有行数据
     * @param $sql
     * @param string $field
     * @return array|bool
     */
    function getAll($sql , $field = '')
    {
        $res = $this->query($sql);
        if ($res !== false)
        {
            $arr = array();
            while ($row = $res->fetch_assoc())
            {
                if($field){
                    $arr[$row[$field]] = $row;
                }else{
                    $arr[] = $row;
                }
            }
            $this->free();
            return $arr;
        }
        else
        {
            return false;
        }
    }

    /**
     * 根据res 获取一行数据
     * @param $res
     * @return mixed
     */
    function fetch($res){
        return $res->fetch_assoc();
    }

    /**
     * 根据res 获取一行数据，以数组方式返回，也就是 0、1、2、3、4这样的键值
     * @param $res
     * @return mixed
     */
    function fetch_num($res){
        return $res->fetch_row();
    }

    /**
     * 根据sql语句获取一行数据
     * @param $sql
     * @param bool $limited
     * @return array|bool|null
     */
    function getRow($sql, $limited = false)
    {
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        //echo $sql;
        //print_r($res);
        //var_dump($res);
        //exit();
        if ($res !== false)
        {
            $ret = $res->fetch_assoc();
            $this->free();
            return $ret;//mysql_fetch_assoc($res);
        }
        return false;
    }

    /**
     * 根据sql 语句，获取某列数据
     * @param $sql
     * @return array|bool
     */
    function getCol($sql)
    {
        $res = $this->query($sql);
        if ($res !== false)
        {
            $arr = array();
            while ($row = $res->fetch_row())
            {
                $arr[] = $row[0];
            }
            $this->free();
            return $arr;
        }
        return false;
    }
    /**
    +----------------------------------------------------------
     * SQL指令安全过滤
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param string $str  SQL字符串
    +----------------------------------------------------------
     * @return string
    +----------------------------------------------------------
     */
    public function escapeString($str) {
        return addslashes($str);
    }

}
