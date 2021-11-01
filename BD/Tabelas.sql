CREATE TABLE login ( 
    
id_usuario int NOT null AUTO_INCREMENT PRIMARY KEY,
nome varchar(100) not null UNIQUE KEY,
senha varchar(32) not null
    
); 