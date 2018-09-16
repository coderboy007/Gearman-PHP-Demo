<?php
require_once 'Lib_gearman.php';
class Background  {
    public function worker() {
        $gearman = new Lib_gearman();
        $worker = $gearman->gearman_worker();
        $gearman->add_worker_function('test', 'Background::test');

        while ($gearman->work()) {
            if (!$worker->returnCode()) {
                echo "\n----------- " . date('c') . " worker done successfully---------\n";
            }
            if ($worker->returnCode() != GEARMAN_SUCCESS) {

                echo "return_code: " . $gearman->current('worker')->returnCode() . "\n";
                break;
            }
        }
    }

    public static function test($job = null) {
	echo "\n \n ".date('y-m-d H:i:s')."---------------------backgrorund test start---------------------";
        $data = unserialize($job->workload());
        //do your code here 
        
        sleep(10);
	echo "\n \n ".date('y-m-d H:i:s')."---------------------backgrorund test Done--------------------- \n \n";
    }

}

$background = new Background();
$background->worker();
