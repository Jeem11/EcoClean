/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  Cheska-PC
 * Created: Jun 29, 2024
 */

-- Database for Laundry System

-- Create db if not exist
CREATE DATABASE IF NOT EXISTS dba_laundry;

-- Use the created database for user/client request
USE dba_laundry;






-- Request Section

-- Client/User Section

-- Create User/Client Request Table
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

-- Create User/Client Profile table
CREATE TABLE IF NOT EXISTS request_userpic (
    rquserpic_ID INT AUTO_INCREMENT PRIMARY KEY,
    rquser_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

--+++++++++++++++++++++++++++++++++++++++++++++++++++++++

-- Employee Section

-- Create Employee Request Table
CREATE TABLE IF NOT EXISTS request_employee(
    rqemp_ID INT PRIMARY KEY,
    rqemp_name VARCHAR(225) NOT NULL,
    rqemp_bday DATE NOT NULL,
    rqemp_contact VARCHAR(15) NOT NULL,
    rqemp_email VARCHAR(85) NOT NULL,
    rqemp_add VARCHAR(225) NOT NULL,
    rqemp_city CHAR(35) NOT NULL,
    rqemp_brgy CHAR(35) NOT NULL,
    rq_shop VARCHAR(225) NOT NULL,
    rq_date DATE NOT NULL,
    rqemp_username VARCHAR(225) NOT NULL,
    rqemp_userpass VARCHAR(225) NOT NULL,
    rqemp_status CHAR(15) DEFAULT 'Pending'
);

-- Create Employee Request Profile Table
CREATE TABLE IF NOT EXISTS request_employeepic (
    rqemppic_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqemp_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Employee Request SSS File table
CREATE TABLE IF NOT EXISTS request_empSSS (
    rqempSSS_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqempSSS_name VARCHAR(225) NOT NULL,
    rqempSSS_no CHAR(20) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Employee Request PhilHealth File table
CREATE TABLE IF NOT EXISTS request_empPhil (
    rqempPhil_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqempPhil_name VARCHAR(225) NOT NULL,
    rqempPhil_no CHAR(20) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Employee Request Pag-IBIG File table
CREATE TABLE IF NOT EXISTS request_empPB (
    rqempPB_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqempPB_name VARCHAR(225) NOT NULL,
    rqempPB_no CHAR(20) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Employee Agreement Request table
CREATE TABLE IF NOT EXISTS request_empAgreement (
    rqemp_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqemp_name VARCHAR(225) NOT NULL,
    rqempSign_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

--+++++++++++++++++++++++++++++++++++++++++++++++++++++++

-- Business Section

-- Create Business Request table
CREATE TABLE IF NOT EXISTS request_business (
    rqbs_ID INT PRIMARY KEY,
    rqbs_name VARCHAR(225) NOT NULL,
    rqbs_owner VARCHAR(225) NOT NULL,
    rqbs_add VARCHAR(225) NOT NULL,
    rqbs_city CHAR(35) NOT NULL,
    rqbs_brgy CHAR(35) NOT NULL,
    rqbs_contact VARCHAR(15) NOT NULL,
    rqbs_email VARCHAR(85) NOT NULL,
    rqbs_regdate DATE NOT NULL,
    rqbs_username VARCHAR(225) NOT NULL,
    rqbs_userpass VARCHAR(225) NOT NULL,
    rqbs_status CHAR(15) DEFAULT 'Pending'
);

-- Create Business Owner Profile Request table
CREATE TABLE IF NOT EXISTS request_bsOwner (
    rqbs_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbs_owner VARCHAR(225) NOT NULL,
    rqbsowner_filenm VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Business Logo Request table
CREATE TABLE IF NOT EXISTS request_bsLogo (
    rqbs_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbslogo_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Business DTI File Request table
CREATE TABLE IF NOT EXISTS request_bsDTI (
    rqbsDTI_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbsDTI_name VARCHAR(225) NOT NULL,
    rqbsDTI_No VARCHAR(35) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Business TIN File Request table
CREATE TABLE IF NOT EXISTS request_bsTIN (
    rqbsTIN_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbsTIN_name VARCHAR(225) NOT NULL,
    rqbsTIN_No VARCHAR(35) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Business Agreement Request table
CREATE TABLE IF NOT EXISTS request_bsAgreement (
    rqbs_ID INT AUTO_INCREMENT PRIMARY KEY,
    rqbs_owner VARCHAR(225) NOT NULL,
    rqbsSign_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

-- Registered Section

-- Client/User Section

-- Create Client User table
CREATE TABLE IF NOT EXISTS user_info (
    user_ID INT PRIMARY KEY,
    user_name VARCHAR(225) NOT NULL,
    user_contact VARCHAR(15) NOT NULL,
    user_email VARCHAR(85) NOT NULL,
    user_add VARCHAR(225) NOT NULL,
    user_city CHAR(35) NOT NULL,
    user_brgy CHAR(35) NOT NULL,
    rg_date DATE NOT NULL,
    user_username VARCHAR(225) NOT NULL,
    user_userpass VARCHAR(225) NOT NULL,
    rquser_status CHAR(15) DEFAULT 'Approved'
);

-- Create Client/User Profile table
CREATE TABLE IF NOT EXISTS user_profile (
    userpic_ID INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

--+++++++++++++++++++++++++++++++++++++++++++++++++++++++

-- Employee Section

-- Create Employee table
CREATE TABLE IF NOT EXISTS employee (
    emp_ID INT PRIMARY KEY,
    emp_name VARCHAR(225) NOT NULL,
    emp_bday DATE NOT NULL,
    emp_contact VARCHAR(15) NOT NULL,
    emp_email VARCHAR(85) NOT NULL,
    emp_add VARCHAR(225) NOT NULL,
    emp_city CHAR(35) NOT NULL,
    emp_brgy CHAR(35) NOT NULL,
    work_shop VARCHAR(225) NOT NULL,
    rg_date DATE NOT NULL,
    emp_username VARCHAR(225) NOT NULL,
    emp_userpass VARCHAR(225) NOT NULL,
    emp_status CHAR(15) DEFAULT 'Approved'
);

-- Create Employee Profile table 
CREATE TABLE IF NOT EXISTS employee_profile (
    emppic_ID INT AUTO_INCREMENT PRIMARY KEY,
    emp_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Employee SSS File table
CREATE TABLE IF NOT EXISTS employee_SSS (
    empSSS_ID INT AUTO_INCREMENT PRIMARY KEY,
    empSSS_name VARCHAR(225) NOT NULL,
    empSSS_No VARCHAR(35) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Employee PhilHealth File table
CREATE TABLE IF NOT EXISTS employee_Phil (
    empPhil_ID INT AUTO_INCREMENT PRIMARY KEY,
    empPhil_name VARCHAR(225) NOT NULL,
    empPhil_No VARCHAR(35) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Employee Pag-IBIG File table
CREATE TABLE IF NOT EXISTS employee_PB (
    empPB_ID INT AUTO_INCREMENT PRIMARY KEY,
    empPB_name VARCHAR(225) NOT NULL,
    empPB_No VARCHAR(35) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

--+++++++++++++++++++++++++++++++++++++++++++++++++++++++

-- Business Section

-- Create Business Name Registered Table 
CREATE TABLE IF NOT EXISTS laundry_shops (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_name VARCHAR(225) NOT NULL,
    bs_owner VARCHAR(225) NOT NULL,
    bs_add VARCHAR(225) NOT NULL,
    bs_city CHAR(35) NOT NULL,
    bs_brgy CHAR(35) NOT NULL,
    bs_contact VARCHAR(15) NOT NULL,
    bs_email VARCHAR(85) NOT NULL,
    bs_regdate DATE NOT NULL,
    bs_status CHAR(15) DEFAULT 'Approved'
);

-- Create Business Account Info
CREATE TABLE IF NOT EXISTS laundry_account(
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_username VARCHAR(225) NOT NULL,
    bs_userpass VARCHAR(225) NOT NULL
);

-- Create Owner Info
CREATE TABLE IF NOT EXISTS business_owner (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_owner VARCHAR(225) NOT NULL,
    bsowner_filenm VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Business Logo table
CREATE TABLE IF NOT EXISTS laundry_Logo (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bslogo_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Business DTI File table
CREATE TABLE IF NOT EXISTS businessDTI_File (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bsDTI_ID INT NOT NULL,
    bsDTI_name VARCHAR(225) NOT NULL,
    bsDTI_No VARCHAR(35) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Business TIN File table
CREATE TABLE IF NOT EXISTS businessTIN_File (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bsTIN_ID INT NOT NULL,
    bsTIN_name VARCHAR(225) NOT NULL,
    bsTIN_No VARCHAR(35) NOT NULL,
    mime VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Business Agreement table
CREATE TABLE IF NOT EXISTS business_Agreements (
    bs_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_owner VARCHAR(225) NOT NULL,
    bsSign_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

--+++++++++++++++++++++++++++++++++++++++++++++++++++++++

-- Subscription Section 

-- Create Price table
CREATE TABLE IF NOT EXISTS subscription (
    sub_ID CHAR(5) PRIMARY KEY,
    sub_cdname CHAR(15) NOT NULL,
    sub_price INT NOT NULL,
    sub_pay CHAR(15) NOT NULL,
    subpay_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Pending Payment Table
CREATE TABLE IF NOT EXISTS pending_payment (
    curr_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_ID INT NOT NULL,
    sub_ID CHAR(5),
    total_pay INT NOT NULL,
    due_pay DATE NOT NULL
);

-- Create Proof Payment table (Screenshot of payment since API payment gateway is literally killing me)
CREATE TABLE IF NOT EXISTS proof_payment (
    paypic_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_name VARCHAR(225) NOT NULL,
    paypic_name VARCHAR(225) NOT NULL,
    mime VARCHAR(50) NOT NULL,
    size BIGINT(20) NOT NULL,
    data LONGBLOB NOT NULL
);

-- Create Payment table
CREATE TABLE IF NOT EXISTS payment (
    pay_ID INT AUTO_INCREMENT PRIMARY KEY,
    bs_ID INT NOT NULL,
    sub_ID CHAR(5) NOT NULL,
    total_pay INT NOT NULL,
    pay_date DATE NOT NULL,
    paypic_ID INT NOT NULL
);

CREATE TABLE IF NOT EXISTS rejected_account(
    rq_ID INT AUTO_INCREMENT PRIMARY KEY,
    rq_username VARCHAR(225),
    rq_userpass VARCHAR(225)
);









//Triggers

DELIMITER $$

CREATE TRIGGER after_request_business_update
AFTER UPDATE ON request_business
FOR EACH ROW
BEGIN
    IF NEW.rqbs_status = 'Approved' THEN
        -- Insert into laundry_shops
        INSERT INTO laundry_shops (bs_ID, bs_name, bs_owner, bs_add, bs_city, bs_brgy, bs_contact, bs_email, bs_regdate, bs_status)
        VALUES (NEW.rqbs_ID, NEW.rqbs_name, NEW.rqbs_owner, NEW.rqbs_add, NEW.rqbs_city, NEW.rqbs_brgy, NEW.rqbs_contact, NEW.rqbs_email, NEW.rqbs_regdate, 'Approved');
        
        -- Insert into laundry_account
        INSERT INTO laundry_account (bs_ID, bs_username, bs_userpass)
        VALUES (NEW.rqbs_ID, NEW.rqbs_username, NEW.rqbs_userpass);
        
        -- Insert into business_owner
        INSERT INTO business_owner (bs_ID, bs_owner, bsowner_filenm, mime, size, data)
        SELECT rqbs_ID, rqbs_owner, rqbsowner_filenm, mime, size, data
        FROM request_bsOwner
        WHERE rqbs_ID = NEW.rqbs_ID;
        
        -- Insert into laundry_Logo
        INSERT INTO laundry_Logo (bs_ID, bslogo_name, mime, size, data)
        SELECT rqbs_ID, rqbslogo_name, mime, size, data
        FROM request_bsLogo
        WHERE rqbs_ID = NEW.rqbs_ID;
        
        -- Insert into businessDTI_File
        INSERT INTO businessDTI_File (bs_ID, bsDTI_ID, bsDTI_name, bsDTI_No, mime, size, data)
        SELECT rqbs_ID, rqbsDTI_ID, rqbsDTI_name, rqbsDTI_No, mime, size, data
        FROM request_bsDTI
        WHERE rqbsDTI_ID = NEW.rqbs_ID;
        
        -- Insert into businessTIN_File
        INSERT INTO businessTIN_File (bs_ID, bsTIN_ID, bsTIN_name, bsTIN_No, mime, size, data)
        SELECT rqbs_ID, rqbsTIN_ID, rqbsTIN_name, rqbsTIN_No, mime, size, data
        FROM request_bsTIN
        WHERE rqbsTIN_ID = NEW.rqbs_ID;
        
        -- Insert into business_Agreements
        INSERT INTO business_Agreements (bs_ID, bs_owner, bsSign_name, mime, size, data)
        SELECT rqbs_ID, rqbs_owner, rqbsSign_name, mime, size, data
        FROM request_bsAgreement
        WHERE rqbs_ID = NEW.rqbs_ID;
        
        -- Delete records from request tables
        DELETE FROM request_business WHERE rqbs_ID = NEW.rqbs_ID;
        DELETE FROM request_bsOwner WHERE rqbs_ID = NEW.rqbs_ID;
        DELETE FROM request_bsLogo WHERE rqbs_ID = NEW.rqbs_ID;
        DELETE FROM request_bsDTI WHERE rqbsDTI_ID = NEW.rqbs_ID;
        DELETE FROM request_bsTIN WHERE rqbsTIN_ID = NEW.rqbs_ID;
        DELETE FROM request_bsAgreement WHERE rqbs_ID = NEW.rqbs_ID;
    END IF;
END$$

DELIMITER ;
