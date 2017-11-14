<?php

// $token = $_GET['token'];

// token校验,暂时缺失

function shellrslt2Array(){

    // runshell save rslt as va
    $inputAll = shell_exec("sudo iptables -xvnL|tr -s ' ' ' '|grep -i 'dpt:'|sed 's/^[ \t]*//g'|cut -d ' ' -f 2,10");
    $outputAll = shell_exec("sudo iptables -xvnL|tr -s ' ' ' '|grep -i 'spt:'|sed 's/^[ \t]*//g'|cut -d ' ' -f 2,10");

    // split whit "\n"
    $outdataArray = explode("\n",$outputAll);
    $inpdataArray = explode("\n",$inputAll);

    // const array(),save rslt
    $rslt=array();
    foreach ($outdataArray as $value) {
        if ($value) {
            $valueArray = explode(" ", $value);
            // port -- substr($valueArray[1], 4)
            $rslt[substr($valueArray[1], 4)]['output']=$valueArray[0];

        }
    }

    foreach ($inpdataArray as $value) {
        if($value){
            $valueArray = explode(" ", $value);
            // array_push($rslt[substr($valueArray[1], 4)], var);
            $rslt[substr($valueArray[1], 4)]['input']=$valueArray[0];
            // print_r($rslt[substr($valueArray[1], 4)]);
        }
    }
    return $rslt ;
}

$theRslt=shellrslt2Array();

echo json_encode($theRslt);
