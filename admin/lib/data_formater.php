<?php

function data_formater($data) {

    // 单位：B, K, M， G，T

    // B
    if ($data < 1024) {
      return ceil($data) . 'B';
    }
    // K
    else if ($data / 1024 < 1024) {
      if ($data % 1024 != 0) {
        return ceil($data / 1024) . 'K ' . $data % 1024 . 'B';
      } else {
        return ceil($data / 1024) . 'K ';
      }
    }
    // M
    else if ($data / 1024 / 1024 < 1024) {
      if ($data % 1024 != 0) {
        return ceil($data / 1024 / 1024) . 'M ' . $data / 1024 % 1024 . 'K';
      } else {
        return ceil($data / 1024 / 1024) . 'M ';
      }
    }
    // G
    else if ($data / 1024 / 1024 / 1024 < 1024) {
      if ($data % 1024 != 0) {
        return ceil($data / 1024 / 1024 / 1024) . 'G ' . $data / 1024 / 1024 % 1024 . 'M';
      } else {
        return ceil($data / 1024 / 1024 / 1024) . 'G ';
      }
    }

    // T
    else if ($data / 1024 / 1024 / 1024 / 1024) {
      if ($data % 1024 != 0) {
        return ceil($data / 1024 / 1024 / 1024 / 1024) . 'T ' . $data /1024 / 1024 / 1024 % 1024 . 'G';
      } else {
        return ceil($data / 1024 / 1024 / 1024 / 1024) . 'T ';
      }
    }

}
