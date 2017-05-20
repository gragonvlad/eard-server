<?php

namespace Eard;

use pocketmine\utils\MainLogger;

class DB{

	public static $mysqli = null;

	public static function get(){
		if(self::$mysqli == null){
			self::mysqlConnect();
		}
		return self::$mysqli;
	}

	public static function mysqlConnect($isFromServer = false){
		MainLogger::getLogger()->info("§aConnecting to the database...");
		$address = $isFromServer ? 'mcpe.jp' : '127.0.0.1';
		$mysqli = new \mysqli($address, 'muni', '83yvbqov01-92v8@mn', 'muni');
		if($mysqli->connect_errno){
			MainLogger::getLogger()->error($mysqli->connect_error."(".$mysqli->connect_errno.")");
			self::$mysqli = null;
		}else{
			MainLogger::getLogger()->info("§aSuccessfully connected!");
			self::$mysqli = $mysqli;
		}
	}

	function __construct(){
		$this->mysqlConnect();
	}

	function __destruct(){

	}

	public static function ready(){
		//		CREATE USER muni@fp76f0b73c.knge106.ap.nuro.jp identified by '83yvbqov01-92v8@mn';
		// 		grant all privileges on muni.* to muni@fp76f0b73c.knge106.ap.nuro.jp;
		//		CREATE DATABASE muni CHARACTER SET utf8;
$sql = "
CREATE TABLE muni.data (
no INT(10) AUTO_INCREMENT,
name varchar(24),
host LONGTEXT,
date datetime DEFAULT '0000-00-00 00:00:00',
PRIMARY KEY (no)
);";
		//select user,host from mysql.user
		MainLogger::getLogger()->info("§aDB: DB setup DONE");
	}

	public static function turncate(){
		$sql = "TRUNCATE TABLE muni.data";
		$db = self::get();
		$db->query($sql);
		MainLogger::getLogger()->info("§aDB: Turncate");
	}

}