##################################################
# This file creates the database needed for W3MAIL
##################################################
CREATE {DBUSER} name PASSWORD '{DBPASS}'
CREATE {DBNAME} WITH OWNER = {DBUSER}
GRANT ALL ON DATABASE {DBNAME} TO {DBUSER}
