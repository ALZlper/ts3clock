<?php

    //require the ts3 lib
    require_once("libraries/TeamSpeak3/TeamSpeak3.php");
    
    //require the ts3clock class
    include('ts3clock.php');
    
    //Try to start the clock loop
    //Use command: php <filename>
    //to run a php file without a user request
    //Tipp: If you use this on a webserver, use cronjobs
    //Use: https://cron-job.org/
    //Also dont use clock_startloop(), use clock_settime()
    try {
        //Default username: serveradmin
        //Default query port: 10011
        //Default Server port: 9987
        $ts3_VirtualServer = TeamSpeak3::factory("serverquery://<username>:<password>@<ip>:<queryport>/?server_port=<serverport>");
        //run the loop
        //you can find the channelid with: YaTQA (just google it)
        ts3clock::clock_startloop($ts3_VirtualServer, array(<channelid1>, <channelid2>, <channelid3>));
    } catch (Exception $e) {
         //Console output: Echo the error message
         echo $e->getMessage();
    }
    
?>
