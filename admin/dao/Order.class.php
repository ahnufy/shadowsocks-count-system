<?php

class Order
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

        $sql = "SELECT * FROM orders";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function get_by_id($id) {

        $sql = "SELECT * FROM orders WHERE id= '$id'";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function get_by_uid($uid) {

        $sql = "SELECT * FROM orders WHERE uid= '$uid' AND status <> -1";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }
    
    function get_first_by_uid($uid) {

        $sql = "SELECT * FROM orders WHERE uid= '$uid' ORDER BY `pay_time` DESC LIMIT 1";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function add($uid, $type, $price) {

        $sql = "INSERT INTO orders (uid, type, price, create_time) VALUES('$uid', '$type', '$price', NOW())";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '新增订单成功', 'data' => array('id' => mysqli_insert_id($this->conn))));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }

    function update_status($id, $status) {

        $sql = "UPDATE orders SET status='$status', active_time=NOW() WHERE id = '$id'";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '更新订单状态成功', 'data' => null));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }

    function update($id, $status, $pay_money) {

        $sql = "UPDATE orders SET status='$status', pay_time=NOW(), pay_money= '$pay_money' WHERE id = '$id'";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '更新订单状态成功', 'data' => null));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }

    function del_by_id($id){

        $sql = "UPDATE orders SET status=-1 WHERE id=".$id;
        $result = $this->conn->query($sql);

        if($result === TRUE){
            return json_encode(array('code'=>'0','msg'=>'订单删除成功','data'=>null));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }
    }

}
