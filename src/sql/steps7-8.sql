select * from employers;
select distinct firstname from employers;

select * from employers where birthday < '1990-01-01';
select * from employers where birthday between '1960-01-01' and '1990-01-01';
select * from employers where birthday between '1960-01-01' and '1990-01-01' and firstname not like 'A%';
select * from employers where birthday between '1960-01-01' and '1990-01-01' and firstname not like 'A%'or sirname like "%va";
-- subqueries
select * from employers where pos_id in (select id from positions where salary > 120000);
select * from employers where pos_id in (select id from positions where salary > 120000) order by firstname;
select * from employers where pos_id in (select id from positions where salary > 120000) order by firstname limit 3;


SELECT CONCAT(e.firstname, ', ', e.sirname,  ', ',e.birthday) AS Subordinates, 
concat (emp.firstname, ', ', emp.sirname) as Manager from employers e inner join employers emp on e.boss_id = emp.boss_id
AND CONCAT(e.firstname, ', ',e.sirname) > concat(emp.firstname, ', ', emp.sirname); 

Select  CONCAT(e.firstname, ', ', e.sirname) as 'Employyes', p.name_pos, p.salary from employers e left join positions p on e.pos_id = p.id;

select d.name_dep as Department, CONCAT(e.firstname, ', ', e.sirname,  ', ',e.birthday) as Employer 
from departaments d
right join employers e on d.id = e.dep_id;

select d.id, d.name_dep as Department, CONCAT(e.firstname, ', ', e.sirname,  ', ',e.birthday) as Employer, e.dep_id 
from departaments d
CROSS  join employers e; -- where d.id = e.dep_id; 

Select firstname from employers e 
union 
select name_dep from departaments d;

Select firstname from employers e 
union all
select name_dep from departaments d;

select COUNT(firstname) from employers;
select p.id, p.salary, count(e.firstname) from employers e right join positions p on e.pos_id = p.id group by p.salary;
select p.id, p.salary, count(e.firstname) from employers e right join positions p on e.pos_id = p.id group by p.salary having p.salary < 20000;
select avg(p.salary) from positions p;
select sum(p.salary) from positions p inner join employers e on p.id = e.pos_id;
select max(p.salary) from positions p inner join employers e on p.id = e.pos_id;

CREATE VIEW `emp_salaries` AS
select p.id, p.salary, count(e.firstname) from employers e right join positions p on e.pos_id = p.id group by p.salary;

select * from emp_salaries;