<?php

class UserData
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
    function add_control($uid, $expires_time, $data_limit) {

      $sql = "INSERT INTO user_data_contronl (uid, expires_time, data_limit, create_time, update_time) VALUES($uid, '$expires_time', $data_limit, NOW(), NOW())";
      $result = $this->conn->query($sql);

      if ($result === TRUE) {
          return json_encode(array('code' => '0', 'msg' => '新增用户流量控制成功', 'data' => array('id' => mysqli_insert_id($this->conn))));
      } else {
          return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
      }

    }

    // 根据 uid 来查询，用于判断是否存在
    function get_by_uid($uid) {

        $sql = "SELECT * FROM user_data_contronl WHERE uid = '$uid' ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '用户流量控制查询成功', 'data' => $arr));

    }

    function update_by_uid($uid, $expires_time, $data_limit) {

        $sql = "UPDATE user_data_contronl SET expires_time='$expires_time', data_limit='$data_limit', update_time=NOW()  WHERE uid = '$uid'";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '用户流量控制更新成功', 'data' =>  null));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }

}
