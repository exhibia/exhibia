################################################
# This file creates the tables needed for W3MAIL
################################################
CREATE TABLE userdata( uid serial NOT NULL, username character varying(50) DEFAULT '' NOT NULL, displayname character varying(50), signature text );
CREATE TABLE addressbook( eid serial NOT NULL, uid integer DEFAULT 0 NOT NULL, display character varying(50), e_mail character varying(100) DEFAULT '' NOT NULL, info character varying(255) );
ALTER TABLE ONLY userdata ADD CONSTRAINT userdata_pkey PRIMARY KEY (uid);
ALTER TABLE ONLY userdata ADD CONSTRAINT userdata_username_key UNIQUE (username);
ALTER TABLE ONLY addressbook ADD CONSTRAINT addressbook_pkey PRIMARY KEY (eid);
ALTER TABLE ONLY addressbook ADD CONSTRAINT "$1" FOREIGN KEY (uid) REFERENCES userdata(uid) ON UPDATE NO ACTION ON DELETE SET DEFAULT;
