<?php
// THIS FILE IS MENT TO BE RUN BY DOCKER!

    date_default_timezone_set(getenv("TZ"));

    //require the ts3 lib
    require_once("libraries/TeamSpeak3/TeamSpeak3.php");

    //require the ts3clock class
    include('ts3clock.php');


    try {
        $USER = getenv("USER");
        $PW = getenv("PW");
        $HOST = getenv("HOST");
        $QUERY_PORT = getenv("QUERY_PORT");
        $SERVER_PORT = getenv("SERVER_PORT");

        //Default username: serveradmin
        //Default query port: 10011
        //Default Server port: 9987
        $ts3_VirtualServer = TeamSpeak3::factory("serverquery://$USER:$PW@$HOST:$QUERY_PORT/?server_port=$SERVER_PORT");
        //run the loop
        //you can find the channelid with: YaTQA (just google it)
        ts3clock::clock_startloop($ts3_VirtualServer, array(getenv("CHANNELID_1"), getenv("CHANNELID_2"), getenv("CHANNELID_3")));
    } catch (Exception $e) {
         //Console output: Echo the error message
         echo $e->getMessage();
    }

?>