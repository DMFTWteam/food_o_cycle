
/*DROP DATABASE IF EXISTS food_o_cycle;
CREATE DATABASE food_o_cycle;
USE food_o_cycle;*/

CREATE TABLE users
(u_id				INT(10)			NOT NULL	AUTO_INCREMENT,
 u_fname			VARCHAR(30)	NOT NULL,
 u_lname			VARCHAR(30)	NOT NULL,
 u_mi				VARCHAR(1),
 u_username			VARCHAR(255)	NOT NULL,
 u_password			VARCHAR(255)	NOT NULL,
 u_phone			VARCHAR(10)	NOT NULL,
 u_email			VARCHAR(30)	NOT NULL,
 u_photo			BLOB,
 u_is_admin			INT(1)			NOT NULL,
 u_is_standard		INT(1)			NOT NULL,
 PRIMARY KEY (u_id));
 
CREATE TABLE access_log
(log_id				INT(10)			NOT NULL	AUTO_INCREMENT,
 u_id				INT(10)			NOT NULL,
 log_datetime		DATETIME		NOT NULL,
 log_authsuccessful INT(1)			NOT NULL,
 PRIMARY KEY (log_id),
 INDEX u_id (u_id));
 
CREATE TABLE business
(business_id		INT(10)			NOT NULL	AUTO_INCREMENT,
 business_name		VARCHAR(50)	NOT NULL,
 business_address	VARCHAR(200)	NOT NULL,
 business_city		VARCHAR(50)	NOT NULL,
 business_state		VARCHAR(2)		NOT NULL,
 business_zip		VARCHAR(5)		NOT NULL,
 business_phone		VARCHAR(10)	NOT NULL,
 business_foodtype	VARCHAR(255)	NOT NULL,
 business_tax_id	INT(9)			NOT NULL,
 business_is_donor	VARCHAR(1)		NOT NULL,
 PRIMARY KEY (business_id));
 
CREATE TABLE user_to_business
(u_id				INT(10)			NOT NULL,
business_id			INT(10)			NOT NULL,
PRIMARY KEY (u_id, business_id),
INDEX u_id (u_id),
INDEX business_id (business_id));

CREATE TABLE transactions
(trans_id			INT(10)			NOT NULL	AUTO_INCREMENT,
 business_id		INT(10)			NOT NULL,
 trans_total_price	FLOAT(7,2)		NOT NULL,
 trans_date			DATE			NOT NULL,
 PRIMARY KEY (trans_id),
 INDEX business_id (business_id));
 
CREATE TABLE food_item
(item_id			INT(10)			NOT NULL	AUTO_INCREMENT,
 item_desc			VARCHAR(256),	
 business_id		INT(10)			NOT NULL,
 item_qty_avail		INT(4)			NOT NULL,
 item_price			FLOAT(5,2)		NOT NULL,
 item_perishable	INT(1)			NOT NULL,
 item_expiration	DATE			NOT NULL,
 PRIMARY KEY (item_id),
 INDEX business_id (business_id));
 
CREATE TABLE transaction_line
(line_id			INT(10)			NOT NULL	AUTO_INCREMENT,
 trans_id			INT(10)			NOT NULL,
 item_id			INT(10)			NOT NULL,
 item_quantity		INT(3),			
 PRIMARY KEY (line_id, trans_id),
 INDEX trans_id (trans_id),
 INDEX item_id (item_id));
 
 
 
 
 