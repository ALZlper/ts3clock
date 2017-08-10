 <?php
    //ts3clock class from: 
    //All functions are static
    //use include('<path>'); to use the class
    //libraries/TeamSpeak3/TeamSpeak3.php is required
    //You can get the ts3 framework from: https://github.com/planetteamspeak/ts3phpframework
    class ts3clock {

        //function to start the loop
        public static function clock_startloop($ts3vserver, $channels, $hour_offset = 0, $font = "default") {
            //Set $check to "" so there is an update right on the start
            $check = "";
            //while(true) repeats forever
            while(true) {  
                //If time has changed set the time
                if ($check != date('Hi', time())) {
                    //try to set the time.
                    try {
                        //set the time to a ts3server. 
                        self::clock_settime($ts3vserver, $channels, $hour_offset, $font);
                    //Catch Exceptions from trying to set time
                    } catch (Exception $e) {}
                    //Update the new time
                    $check = date('Hi', time());
                }
            }
        }

        //function to set the time
        //$ts3vserver defines the Teamspeak
        //$channels defines the 3 used channely as an array
        //$hour_offset is optional an defines the time offset to time() in seconds
        //$font defines the font array. Each number size should be 3x5 0-9
        public static function clock_settime($ts3vserver, $chs, $hour_offset = 0, $font = "default") {

            //saves the current time in this format: HH:ii
            $time_str = date('Hi', time() + $hour_offset);

            //Console output: Update by time
            echo "------------\n";
            echo "Update: $time_str\n";

            //Checks which font should be used
            if ($font == "default") {
                //Defines the default font
                //This custom pixel font belongs to the ts3 clock project
                $time_ascii = array(
                    //Number: 0 Size: 3x5
                    array('█▀█', '█─█', '▀▀▀'),
                    //Number: 1 Size: 3x5
                    array('▄▀█', '──█', '──▀'),
                    //Number: 2 Size: 3x5
                    array('▀▀█', '█▀▀', '▀▀▀'),
                    //Number: 3 Size: 3x5
                    array('▀▀█', '▀▀█', '▀▀▀'),
                    //Number: 4 Size: 3x5
                    array('█─█', '▀▀█', '──▀'),
                    //Number: 5 Size: 3x5
                    array('█▀▀', '▀▀█', '▀▀▀'),
                    //Number: 6 Size: 3x5
                    array('█▀▀', '█▀█', '▀▀▀'),
                    //Number: 7 Size: 3x5
                    array('▀▀█', '──█', '──▀'),
                    //Number: 8 Size: 3x5
                    array('█▀█', '█▀█', '▀▀▀'),
                    //Number: 9 Size: 3x5
                    array('█▀█', '▀▀█', '▀▀▀'),
                    //Middle colon Size: 3x5
                    array('▄', '▄', '─'),
                    //Separator Size: 3x5
                    '─'
                );
            } else {
                //Keeps a custom font
                $time_ascii = $font;
            }

            //returns the final time as an array
            $result_array = array(
                //Number 1 and 2 HH of font array
                $time_ascii[substr($time_str, 0, -3)],
                $time_ascii[substr($time_str, 1, -2)],
                //Insert middle colon
                //Stored in font array element 10
                $time_ascii[10],
                //Number 3 and 4 ii of font array
                $time_ascii[substr($time_str, 2, -1)],
                $time_ascii[substr($time_str, 3)]
            );

            //Defines three result rows
            $ch_strs = array("[cspacer]", "[cspacer]", "[cspacer]");
            //Go through every char
            foreach ($result_array as $j=>$collum) {
                //Go through every row
                foreach($ch_strs as $i=>$ch_str) {
                    //Check if loop is at the forth char
                    if ($j != 4) {
                        //Add char to the final row with font element 11
                        $ch_strs[$i] .= $collum[$i] . $time_ascii[11];
                    } else {
                        //Add char to the final row without font element 11
                        $ch_strs[$i] .= $collum[$i];
                    }
                }
            } 

            //Go through every row
            for($i = 0; $i < 3; $i++) {
                //Try to change channel names
                try {
                    //Get ts3server channels by id
                    $cch = $ts3vserver->channelGetById($chs[$i]);
                    //Change ts3server channel_name to number font
                    $cch["channel_name"] = $ch_strs[$i];
                    //Console output: Name changing log
                    echo "Renaming channel ".$chs[$i]." to: ".$ch_strs[$i]."\n";
                //Catch all Exceptions
                //"Ex: channel name is already in use" happens often and is not a problem
                } catch (Exception $e) {
                    //Console output: the channel name change error message
                    echo "Ex: ".$e->getMessage()."\n";
                }
            }
            
            //Exits with no error
            return true;
        }

    }

?>
