FROM php:7-cli-alpine

RUN mkdir /opt/ts3clock
WORKDIR /opt/ts3clock
COPY docker.php .
COPY ts3clock.php .
COPY ts3phpframework/libraries libraries

ENV USER serveradmin
ENV HOST 127.0.0.1
ENV QUERY_PORT 10011
ENV SERVER_PORT 9987

CMD ["php", "docker.php"]
