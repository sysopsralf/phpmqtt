<?php 
require('php_sam.php');

//create a new connection object
$conn = new SAMConnection();

//start initialise the connection
$conn->connect(SAM_MQTT, array(SAM_HOST => 'mqtt.relayr.io',
                                 SAM_PORT => 1883));

//while the connection exists
        while($conn)
        {
            //get the cpu usage using a shell command
            $cmd = 'cat /proc/loadavg';
            $rawCpu=shell_exec($cmd);
            $result=preg_match('/^\d+.\d+/', $rawCpu, $cpu);
            //if successful then send message
             if($result==1)
                {
                //create a new MQTT message with the output of the shell command as the body
                $msgCpu = new SAMMessage('$cpu[0]');

                //send the message on the topic cpu
                $conn->send('topic://cpu', $msgCpu);

                // print sent to the terminal
                echo 'sent';

                //wait for a minute
                sleep(60);
            }
        }
?>
