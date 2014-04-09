##################################################
# This file creates the database needed for W3MAIL
##################################################
CREATE DATABASE IF NOT EXISTS {DBNAME};
GRANT insert, update, select, delete, alter, drop, create ON {DBNAME}.* TO {DBUSER}@localhost IDENTIFIED BY '{DBPASS}';
GRANT insert, update, select, delete, alter, drop, create ON {DBNAME}.* TO {DBUSER}@localhost.localdomain IDENTIFIED BY '{DBPASS}';
