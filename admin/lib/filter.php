<?php

//整型过滤函数
function num_check($id) {

  if (!$id) {
    die ( '数字参数不能为空！' );
  } //是否为空的判断
  else if (inject_check ( $id )) {
    die ( '非法注入参数' );
  } //注入判断
  else if (!is_numetic ( $id )) {
    die ( '非法数字参数' );
  }

  //数字判断
  $id = intval ( $id );
  //整型化
  return $id;
}

//字符过滤函数
function str_check($str) {

  if (inject_check ( $str )) {
    die ( '非法字符串参数' );
  }

  //注入判断
  $str = htmlspecialchars ( $str );
  //转换html
  return $str;
}

//防注入函数
function inject_check($sql_str) {
  return eregi ( 'select|inert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|UNION|into|load_file|outfile', $sql_str );// 进行过滤，防注入
}


?>
