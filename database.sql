CREATE DATABASE IF NOT EXISTS data_api;
USE data_api;

CREATE TABLE IF NOT EXISTS users (
 id INT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 username VARCHAR(100) NOT NULL,
 email VARCHAR(150) NOT NULL,
 street VARCHAR(150),
 suite VARCHAR(150),
 city VARCHAR(100),
 zipcode VARCHAR(20)
);

INSERT INTO users (id,name,username,email,street,suite,city,zipcode) VALUES
(1,'Leanne Graham','Bret','Sincere@april.biz','Kulas Light','Apt. 556','Gwenborough','92998-3874'),
(2,'Ervin Howell','Antonette','Shanna@melissa.tv','Victor Plains','Suite 879','Wisokyburgh','90566-7771'),
(3,'Clementine Bauch','Samantha','Nathan@yesenia.net','Douglas Extension','Suite 847','McKenziehaven','59590-4157'),
(4,'Patricia Lebsack','Karianne','Julianne.OConner@kory.org','Hoeger Mall','Apt. 692','South Elvis','53919-4257'),
(5,'Chelsey Dietrich','Kamren','Lucio_Hettinger@annie.ca','Skiles Walks','Suite 351','Roscoeview','33263'),
(6,'Mrs. Dennis Schulist','Leopoldo_Corkery','Karley_Dach@jasper.info','Norberto Crossing','Apt. 950','South Christy','23505-1337'),
(7,'Kurtis Weissnat','Elwyn.Skiles','Telly@tele####.biz','Rex Trail','Suite 280','Howemouth','58804-1099'),
(8,'Nicholas Runolfsdottir V','Maxime_Nienow','Sherwood@rosamond.me','Ellsworth Summit','Suite 729','Aliyaview','45169'),
(9,'Glenna Reichert','Delphine','Presley@Hodkiewicz.biz','Dayna Park','Suite 449','Bartholomebury','76495-3109'),
(10,'Clementina DuBuque','Moriah.Stanton','Reyes@v****.com','Kattie Turnpike','Suite 198','Lebsackbury','31428-2261');
