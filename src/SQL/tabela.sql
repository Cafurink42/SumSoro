CREATE TABLE users(
id_user INT NOT NULL  PRIMARY KEY AUTO_INCREMENT,
emailverification VARCHAR (50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL, 
created_at DATETIME DEFAULT CURRENT_TIMESTAMP


);