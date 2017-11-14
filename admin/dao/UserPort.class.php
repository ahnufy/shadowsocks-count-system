<?php

class UserPort
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

    // 得到某个用户的全部节点的所有流量
    function get_by_uid($uid) {

        $sql = "SELECT * FROM node_data_record WHERE uid = '$uid' ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }


    function get_by_ip_id($ip_id) {

        $sql = "SELECT * FROM node_data_record WHERE ip_id = '$ip_id' ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    // 只更新已经绑定了用户，入库的IP和端口对应的流量
    function update_input_output($ip_id, $port, $input, $output) {

        $sql = "UPDATE node_data_record SET in_data='$input', out_data='$output',update_time=NOW() WHERE ip_id = ".$ip_id." AND port = '$port'";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '流量同步成功', 'data' => array('ip_id' => $ip_id, 'port' => $port, 'input' => $input, 'output' => $output), 'sql' => $sql));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }

    // 添加一条用户的节点信息，一般用户会有两个节点
    function add_node_port($uid, $id, $port) {

        $sql = "INSERT INTO node_data_record (uid, ip_id, port, create_time, update_time) VALUES('$uid', '$id', '$port', NOW(), NOW())";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '新增用户节点信息成功', 'data' => array('id' => mysqli_insert_id($this->conn))));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }

}
