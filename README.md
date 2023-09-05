# aarc-logger


Prerequisites

* apache2
* libapache2-php
* mariaDb-server & mariadb-client
* php-mysql


install mariadb then run mysql_secure_installation
- Set root password here

Database creation
mysql -u root -p 
CREATE DATABASE danlogger;
USE danlogger

CREATE OR REPLACE TABLE log_test (
entry int auto_increment,
src_callsign varchar(10),
dst_callsign varchar(10),
grid varchar(10),
band varchar(20),
freq varchar(10),
timestamp date,
date date, 
dst_grid varchar(10),
mode varchar(10),
time time,
PRIMARY KEY (entry)
); 

