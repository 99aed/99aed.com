<?php
	session_start();

	@mysql_connect("localhost","root","") or die("Database is not available, please try again later");
	@mysql_select_db("99aeddeal") or die("Table is not available, please try again later");
?>