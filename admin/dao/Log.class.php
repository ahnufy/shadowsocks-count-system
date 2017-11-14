<?php

class Log
{

    function __construct($servername, $username, $password, $dbname) {

        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        $this->conn = new mysqli($servername, $username, $password, $dbname);
        $this->conn->query("set names 'utf8'");

        if ($this->conn->connect_error) {
            die("数据库连接失败:" . $this->conn->connect_error);
        }

    }

    function __destruct() {
        $this->conn->close();
    }


    function get_all() {

        $sql = "SELECT * FROM log";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function get_by_id($id) {

        $sql = "SELECT * FROM log WHERE id= '$id'";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function add($level, $uid, $key, $value) {

        $sql = "INSERT INTO log (level, uid, data_key, data_value, create_time) VALUES('$level', '$uid', '$key', '$value', NOW())";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '新增日志数据成功', 'data' => array('id' => mysqli_insert_id($this->conn))));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }


}
