/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  Cheska-PC
 * Created: Jun 29, 2024
 */

--Database for Laundry System

--Create db if not exist
CREATE DATABASE IF NOT EXIST dba_laundry

--Use the created database for user/client request
USE dba_laundry;

--Client/User Section

--Create User/Client Request Table
CREATE TABLE IF NOT EXISTS request_user (
    rquser_ID INT PRIMARY KEY,
    rquser_name VARCHAR(225) NOT NULL,
    rquser_contact VARCHAR(15) NOT NULL,
    rquser_email VARCHAR(85) NOT NULL,
    rquser_add VARCHAR(225) NOT NULL,
    rquser_city CHAR(35) NOT NULL,
    rquser_brgy CHAR(35) NOT NULL,
    rq_date DATE NOT NULL,
    rq_username VARCHAR(225) NOT NULL,
    rq_userpass VARCHAR(225) NOT NULL,
    rquser_status CHAR(15) DEFAULT 'Pending',
    FOREIGN KEY (rquser_ID) REFERENCES request_userpic(rquserpic_ID) ON DELETE CASCADE
);

--Create User/Client Profile table
CREATE TABLE IF NOT EXISTS request_userpic (
    rquserpic_ID INT AUTO_INCREMENT PRIMARY KEY,
    rquser_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB  NOT NULL
);





--Employee Section

--Request Section 

--Create Employee Request Table
CREATE TABLE IF NOT EXISTS request_employee(
    rqemp_ID INT PRIMARY KEY,
    rqemp_name VARCHAR(225) NOT NULL,
    rqemp_bday DATE NOT NULL,
    rqemp_contact VARCHAR(15) NOT NULL,
    rqemp_email VARCHAR(85) NOT NULL,
    rqemp_add VARCHAR(225) NOT NULL,
    rqemp_city CHAR(35) NOT NULL,
    rqemp_brgy CHAR(35) NOT NULL,
    rq_shop  VARCHAR(225) NOT NULL,
    rq_date DATE NOT NULL,
    rqemp_username VARCHAR(225) NOT NULL,
    rqemp_userpass VARCHAR(225) NOT NULL,
    rqemp_status CHAR(15) DEFAULT 'Pending',

);

--Create Employee Request Profile Table
CREATE TABLE IF NOT EXISTS request_employeepic (
    rqemppic_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqemp_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

--Create Employee Request SSS File table
CREATE TABLE IF NOT EXISTS request_empSSS (
    rqempSSS_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqempSSS_name VARCHAR(225) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Employee Request  PhilHealth File table
CREATE TABLE IF NOT EXISTS request_empPhil (
    rqempPhil_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqempPhil_name VARCHAR(225) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Employee Request Pag-IBIG File table
CREATE TABLE IF NOT EXISTS request_empPB (
    rqempPB_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqempPB_name VARCHAR(225) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
)





--Business Section

--Request Section

--Create Business Request table
CREATE TABLE IF NOT EXISTS request_business (
    rqbs_ID INT PRIMARY KEY,
    rqbs_name VARCHAR(225) NOT NULL,
    rqbs_owner VARCHAR(225) NOT NULL,
    rqbs_add VARCHAR(225) NOT NULL,
    rqbs_city CHAR(35) NOT NULL,
    rqbs_brgy CHAR(35) NOT NULL,
    rqbs_contact VARCHAR(15) NOT NULL,
    rqbs_email VARCHAR(85) NOT NULL,
    rqbs_regdate DATA NOT NULL,
    rqbs-username VARCHAR(225) NOT NULL,
    rqbs_userpass VARCHAR(225) NOT NULL,
    rqbs_status CHAR(15) DEFAULT 'Pending',
)--Still missing with subscription attributes (OTW)

--Create Business Owner Profile Request table
CREATE TABLE IF NOT EXISTS request_bsOwner (
    rqbs_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbs_owner VARCHAR(225) NOT NULL,
    rqbsowner_filenm VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Business Logo Request table
CREATE TABLE IF NOT EXISTS request_bsLogo (
    rqbs_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbslogo_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Business DTI File Request table
CREATE TABLE IF NOT EXISTS request_bsDTI (
    rqbsDTI_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbsDTI_name VARCHAR(225) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Business TIN File Request table
CREATE TABLE IF NOT EXISTS request_bsTIN (
    rqbsTIN_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbsTIN_name VARCHAR(225) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Business Agreement Request table
CREATE TABLE IF NOT EXISTS request_bsAgreement (
    rqbs_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbs_owner VARCHAR(225) NOT NULL,
    rqbsSign_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
)

--Registered Section

--Create Business Name Registered Table 
CREATE TABLE IF NOT EXISTS laundry_shops (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_name VARCHAR(225) NOT NULL,
    bs_owner VARCHAR(225) NOT NULL,
    bs_add VARCHAR(225) NOT NULL,
    bs_city CHAR(35) NOT NULL,
    bs_brgy CHAR(35) NOT NULL,
    bs_contact VARCHAR(15) NOT NULL,
    bs_email VARCHAR(85) NOT NULL,
    bs_regdate DATA NOT NULL
    bs_status CHAR(15) DEFAULT 'Approved',
)

--Create Business Account Info
CREATE TABLE IF NOT EXISTS laundry_account(
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_username VARCHAR(225) NOT NULL,
    bs_userpass VARCHAR(225) NOT NULL
)

--Create Owner Info
CREATE TABLE IF NOT EXISTS business_owner (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_owner VARCHAR(225) NOT NULL,
    bsowner_filenm VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Business Logo table
CREATE TABLE IF NOT EXISTS laundry_Logo (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bslogo_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Business DTI File table
CREATE TABLE IF NOT EXISTS businessDTI_File (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bsDTI_ID INT NOT NULL,
    bsDTI_name VARCHAR(225) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Business TIN File table
CREATE TABLE IF NOT EXISTS rbusinessTIN_File (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bsTIN_ID INT NOT NULL,
    bsTIN_name VARCHAR(225) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
)

--Create Business Agreement table
CREATE TABLE IF NOT EXISTS business_Agreements (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_owner VARCHAR(225) NOT NULL,
    bsSign_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
)





--Subscription Section (soon)