<?php
###########################################################
/*
GuestBook Script
Copyright (C) StivaSoft ltd. All rights Reserved.


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

For further information visit:
http://www.phpjabbers.com/
info@phpjabbers.com

Version:  1.0
Released: 2014-11-25
*/
###########################################################

/* Define MySQL connection details and database table name */
// $SETTINGS["hostname"] = 'us-cdbr-azure-southcentral-e.cloudapp.net';
// $SETTINGS["mysql_user"] = 'b62c48f4f6155e';
// $SETTINGS["mysql_pass"] = '959cc8be';
// $SETTINGS["mysql_database"] = 'acsm_e3d3f29724a7e14';
// $SETTINGS["USERS"] = 'wp_easewebuser'; // this is the default table name that we used
$SETTINGS["hostname"] = 'www.db4free.net';
$SETTINGS["mysql_user"] = 'easetech';
$SETTINGS["mysql_pass"] = 'summer08';
$SETTINGS["mysql_database"] = 'easetech';
$SETTINGS["USERS"] = 'wp_easewebuser'; // this is the default table name that we used

/* Connect to MySQL */
$connection = mysql_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"]) or die ('Unable to connect to MySQL server.<br ><br >Please make sure your MySQL login details are correct.');
$db = mysql_select_db($SETTINGS["mysql_database"], $connection) or die ('request "Unable to select database."');
?>
