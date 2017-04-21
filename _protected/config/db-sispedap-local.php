<?php

/* (C) Copyright 2017 Heru Arief Wijaya (http://belajararief.com/) untuk Renbang Biro Kepegawaian BPKP.*/

/**
 * Database connection credentials for local installation.
 */
return [
	'dsn' => 'mysql:host=localhost;dbname=api',
	'username' => 'root',
	'password' => '',
];

// if you are using db2 driver
// return [
// 	'class'         => 'edgardmessias\db\ibm\db2\Connection',
// 	'dsn'           => 'ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=api;"HOSTNAME=127.0.0.1;PORT=50000;PROTOCOL=TCPIP',
// 	'username'      => 'root',
// 	'password'      => '',
// 	'defaultSchema' => '',
// 	'isISeries'     => false
// ];

// if you are using odbc driver
// return [
// 	'class'         => 'edgardmessias\db\ibm\db2\Connection',
// 	'dsn'           => 'odbc:DRIVER={IBM i Access ODBC Driver 64-bit};SYSTEM=127.0.0.1;PROTOCOL=TCPIP', //change your odbc connection here
// 	'username'      => 'root',
// 	'password'      => '',
// 	'defaultSchema' => '',
// 	'isISeries'     => false
// ];