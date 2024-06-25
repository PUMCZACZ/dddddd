<?php
include_once 'inc/functions_main.php';

$filesArray = scandir('theme');
unset($filesArray[0]);
unset($filesArray[1]);
unset($filesArray[2]);
unset($filesArray[5]);
unset($filesArray[6]);
unset($filesArray[7]);
unset($filesArray[8]);
unset($filesArray[12]);
#print_r($filesArray);
?>
