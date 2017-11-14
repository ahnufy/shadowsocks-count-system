<?php

class Node
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

        $sql = "SELECT * FROM node_list";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function get_by_group($group) {

        $sql = "SELECT * FROM node_list WHERE node_group = '$group' ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }
    function get_by_id($id) {

        $sql = "SELECT * FROM node_list WHERE id = '$id' ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function get_by_ip($ip) {

        $sql = "SELECT * FROM node_list WHERE ip = '$ip' ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function user_count_grow($id) {

      $sql = "UPDATE node_list SET user_count_now=user_count_now+1, update_time=NOW() WHERE id = '$id'";
      $result = $this->conn->query($sql);

      if ($result === TRUE) {
          return json_encode(array('code' => '0', 'msg' => '节点上的用户数量增加成功', 'data' => null));
      } else {
          return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
      }

    }

    function get_active_node_group() {

        $sql = "SELECT * FROM active_node_group WHERE id = 1 ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }


}
