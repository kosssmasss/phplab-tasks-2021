CREATE DATABASE epam;

USE epam;
CREATE TABLE if not exists employers (
	id INT(3)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(100) NOT NULL,
	sirname VARCHAR(100) NOT NULL,
	birthday DATE,
	boss_id INT(3),
	dep_id INT(3)
);

ALTER TABLE employers 
ADD COLUMN pos_id INT(3);

INSERT INTO employers 
(firstname, sirname, birthday, boss_id, dep_id, pos_id )
VALUES
('Inna', 'Durko', "1992-04-15", 1, 2, 2),
('Andrew', 'Kusko', "1961-12-12", 2, 3, 3),
('Oksabs', 'Pukova', "1995-07-03", 2, 2, 1),
('Eugene', 'Glotkova', "1963-12-15", 3, 2, 4),
('Inna', 'Perkova', "1992-04-15", 1, 2, 2),
('Andrew', 'Kusko', "1961-12-12", 2, 3, 3),
('Irina', 'Lukova', "1999-07-11", 1, 2, 2),
('Roman', 'Kusko', "1961-11-23", 1, 3, 1);

CREATE TABLE if not exists depslinks (
id INT(3)  AUTO_INCREMENT PRIMARY KEY,
emp_id INT(3),
dep_id INT(3)
);

INSERT INTO depslinks ( emp_id, dep_id)
VALUES
(2 ,1),(4 ,1),(3 ,4),(3 ,3),(1 ,3);

CREATE TABLE if not exists departaments (
id INT(3)  AUTO_INCREMENT PRIMARY KEY,
name_dep VARCHAR(255)
);

INSERT INTO departaments (name_dep)
VALUES
('Legal department'), ('IT department'), ('Aero department'), ('Navy department'), ('Accountant department');

CREATE TABLE positions (
id INT(3)  AUTO_INCREMENT PRIMARY KEY,
name_pos VARCHAR(255),
salary DECIMAL(10,2)
);

INSERT INTO  positions ( name_pos, salary)
VALUES
('Accountant', 98000.50), ('CEO', 546500.95), ('Manager', 112000.44), ('Lawyer', 120450.75), ('Cleaner', 8675.23);

ALTER TABLE `epam`.`employers` 
ADD INDEX `FK_emp_depID_idx` (`dep_id` ASC) VISIBLE;
;
ALTER TABLE `epam`.`employers` 
ADD CONSTRAINT `FK_emp_depID`
  FOREIGN KEY (`dep_id`)
  REFERENCES `epam`.`departaments` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  ALTER TABLE `epam`.`employers` 
ADD INDEX `FK_emp_posID_idx` (`pos_id` ASC) VISIBLE;
;
ALTER TABLE `epam`.`employers` 
ADD CONSTRAINT `FK_emp_posID`
  FOREIGN KEY (`pos_id`)
  REFERENCES `epam`.`positions` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  
  ALTER TABLE `epam`.`depslinks` 
ADD INDEX `FK_depID_idx` (`dep_id` ASC) VISIBLE;
;
ALTER TABLE `epam`.`depslinks` 
ADD CONSTRAINT `FK_depID`
  FOREIGN KEY (`dep_id`)
  REFERENCES `epam`.`departaments` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
