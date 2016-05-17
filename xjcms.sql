
CREATE DATABASE IF NOT EXISTS xjcms DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS person (
	pid int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(20) NOT NULL  UNIQUE,
	pwd varchar(20) NOT NULL,
	level tinyint(1)  DEFAULT 1/*1:作者，2:管理员 3:超级管理员*/
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS classity (
	cid tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	cname varchar(20) NOT NULL UNIQUE,
	directory varchar(20) NOT NULL UNIQUE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tag (
	tagid tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tagname varchar(20) NOT NULL UNIQUE 
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pic (
	picid tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	picname varchar(20) NOT NULL UNIQUE,
	picurl varchar(30) NOT NULL UNIQUE
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS article (
	aid int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	aname varchar(30) NOT NULL UNIQUE,
	acontent text NOT NULL,
	aclassity tinyint,
	atag tinyint,
	pkeyword varchar(20),
	pdesc varchar(50),
	ptitle varchar(20),
	isstatic tinyint(1) DEFAULT 0,
	filename varchar(10),
	aurl varchar(30),
	createtime int(20) NOT NULL,
	createuser varchar(20) NOT NULL,
	recommend tinyint(1) DEFAULT 0 /*1:推荐；0:不推荐*/
)DEFAULT CHARSET=utf8;



