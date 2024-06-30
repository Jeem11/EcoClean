/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  Cheska-PC
 * Created: Jun 29, 2024
 */

--Database for Client Request


--Create db if not exist
CREATE DATABASE IF NOT EXIST dba_laundry

--Use the created database for user/client request
USE dba_laundry;

--Create User/Client Request Table
CREATE TABLE IF NOT EXISTS request_user (
    rquser_ID INT PRIMARY KEY,
    rquser_name VARCHAR(225),
    rquser_contact VARCHAR(15),
    rquser_email VARCHAR(85),
    rquser_add VARCHAR(225),
    rquser_city CHAR(35),
    rquser_brgy CHAR(35),
    rq_date DATE,
    rq_username VARCHAR(225),
    rq_userpass VARCHAR(225),
    FOREIGN KEY (rquser_ID) REFERENCES request_userpic(rquserpic_ID) ON DELETE CASCADE
);

--Create User/Client Profile table
CREATE TABLE IF NOT EXISTS request_userpic (
    rquserpic_ID INT AUTO_INCREMENT PRIMARY KEY,
    rquser_name VARCHAR(225),
    mime VARCHAR(50),
    size BIGINT(20),
    data LONGBLOB
);