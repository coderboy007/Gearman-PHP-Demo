<?php
require_once 'Lib_gearman.php';
if (class_exists('GearmanClient')) {
    $gearman = new Lib_gearman();
    $gearman->gearman_client();
    $gearman->do_job_background('test', serialize(['param1' => 'ABCD', 'param2' => 123456]));
}
else {
    echo "Gearman Does Not Support";
}