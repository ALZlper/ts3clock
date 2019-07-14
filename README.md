# ts3clock
Add a clock to your Teamspeak Server

## Installation

You need to recusively clone this repository, so the ts3phpframework gets downloaded too.

`git clone --recurse-submodules <project>`

### Manual

Check out example.php and customise it for your needs.

### With Docker

Run `docker build -t ts3clock .` within this repository.
When done, you can start your container with
`docker run -d -e "PW=password" -e "CHANNELID_1=1" -e "CHANNELID_2=2" -e "CHANNELID_3=3" ts3clock`

env var | required | default value | description
--- | --- | --- | ---
USER | optional | serveradmin | server query user
PW | yes | | server query password
HOST | optional | 127.0.0.1
QUERY_PORT | optional | 10011
SERVER_PORT | optional | 9987
CHANNELID_1 | yes | | channel to edit
CHANNELID_2 | yes | | see CHANNELID_1
CHANNELID_3 | yes | | see CHANNELID_1
TZ | optional | UTC | timezone e.g. Europe/Berlin



Screenshot: https://puu.sh/x6f40/0d4a398f86.png
