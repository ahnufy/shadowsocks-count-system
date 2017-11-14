<?php

class User
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

        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function get_by_id($id) {

        $sql = "SELECT * FROM user WHERE id = '$id' ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function get_by_email($email) {

        $sql = "SELECT * FROM user WHERE email = '$email' ";
        $result = $this->conn->query($sql);

        $arr = array();

        while ($row = mysqli_fetch_object($result)) {
            array_push($arr, $row);
        }

        return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));

    }

    function reg($username, $email, $password,  $ss_password, $recommender_email) {

      $sql = "UPDATE user SET username='$username', password='$password', ss_password='$ss_password',  code=null, reg_time= NOW(), update_time=NOW(), recommender_email='$recommender_email' WHERE email = '$email'";
      $result = $this->conn->query($sql);

      if ($result === TRUE) {
          return json_encode(array('code' => '0', 'msg' => '用户注册成功', 'data' => null));
      } else {
          return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
      }

    }

    function update_email_code($email, $code) {

        $sql = "UPDATE user SET code='$code', update_time=NOW() WHERE email = '$email'";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '验证码更新成功！注意查看收件箱或者垃圾箱！', 'data' => array('email' => $email)));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }

    function add_email_code($email, $code) {

        $sql = "INSERT INTO user (email, update_time, code) VALUES('$email', NOW(), '$code')";
        $result = $this->conn->query($sql);

        if ($result === TRUE) {
            return json_encode(array('code' => '0', 'msg' => '验证码发送成功！注意查看收件箱或者垃圾箱！', 'data' => array('id' => mysqli_insert_id($this->conn), 'email' => $email)));
        } else {
            return json_encode(array('code' => '401', 'msg' => '数据库操作:' . $sql . '发生了错误->' . $this->conn->error));
        }

    }

    function get_by_recommender_email($email) {
      $sql = "SELECT * FROM user WHERE recommender_email = '$email' ";
      $result = $this->conn->query($sql);

      $arr = array();

      while ($row = mysqli_fetch_object($result)) {
          array_push($arr, $row);
      }

      return json_encode(array('code' => '0', 'msg' => '成功', 'data' => $arr));
    }


}
