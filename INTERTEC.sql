CREATE DATABASE INTERTEC;
USE INTERTEC;

CREATE TABLE LOGIN (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOME VARCHAR(100) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    SENHA CHAR(32) NOT NULL
);


SELECT * FROM LOGIN;
