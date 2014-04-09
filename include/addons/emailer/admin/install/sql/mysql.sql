################################################
# This file creates the tables needed for W3MAIL
################################################
CREATE TABLE IF NOT EXISTS userdata( UID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, Username CHAR (50) NOT NULL, DisplayName CHAR (50), Signature CHAR (255), PRIMARY KEY(UID), UNIQUE(UID,Username), INDEX(UID))
CREATE TABLE IF NOT EXISTS addressbook( EID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, UID BIGINT UNSIGNED NOT NULL, Display CHAR (50), E_Mail CHAR (100) NOT NULL, Info CHAR (255), PRIMARY KEY(EID), UNIQUE(EID), INDEX(EID,UID,Display,E_Mail))
