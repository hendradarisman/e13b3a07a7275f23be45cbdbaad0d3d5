<?php
require_once __DIR__.'/RestApi.php';


echo "Start worker .... \n";
sleep(30);
echo "Worker is running .... \n";

require_once('includes/initialize.php');

while(true) {
    $result = $api->getAllQueueSentNull();
    if(count($result) > 0){
        echo "Job Loading... \n";
            foreach($result as $value){
                $dtime = date('r');
                $message = "Failure Update !";
           
                $exec = $api->updateQueue($value->id);

            if($exec){
                $message = "Job Success Execute!";
                $message_log = "Job Success Execute!\n";
                echo $message_log;
            }else{
                echo $message;
            }
                $entry_line = "Time Jobs: $dtime | Id: $value->id | Messages: $message
                ";
                $fp = fopen("logs/jobs.log", "a");
                fputs($fp, $entry_line);
                fclose($fp);

                if(!$exec){
                    sleep(30);
                }
        }

    }else{

        echo "No Have Job worker sleep 10 s.... \n";
        sleep(10);
    }
}
    
?>