DROP USER IF EXISTS `nebula_admin`@'localhost';
CREATE USER `nebula_admin`@'localhost' IDENTIFIED BY 'SuperNebula';

GRANT SELECT, INSERT, UPDATE, DELETE
ON `nebula_db`.*
TO `nebula_admin`@'localhost';

DROP USER IF EXISTS `nebula_admin`@'%';
CREATE USER `nebula_admin`@'%' IDENTIFIED BY 'SuperNebula';

GRANT SELECT, INSERT, UPDATE, DELETE
ON `nebula_db`.*
TO `nebula_admin`@'%';

FLUSH PRIVILEGES;