CREATE TABLE users(
   id INT NOT NULL AUTO_INCREMENT,
   fullname VARCHAR(100) NOT NULL,
   email VARCHAR(50) NOT NULL UNIQUE,
   password VARCHAR(100) NOT NULL,
   PRIMARY KEY( id )
);