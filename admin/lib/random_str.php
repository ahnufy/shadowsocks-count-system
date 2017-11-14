<?php

function random_str($leng) {
  $arr   = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
  shuffle($arr);
  $str = implode('', array_slice($arr, 0, $leng));
  return $str;
}

?>
