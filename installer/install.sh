#!/bin/bash

#  =================  START OF CONFIGURATION  ===============

ADIJOZ_DB_USER='adijoz'  
ADIJOZ_DB_PASS='secret'  
ADIJOZ_SESSION_NAME='adijoz'
ADIJOZ_LANG='en'	
ADIJOZ_LOGOUT_BUTTON=''

# Your email for DB failure notificatins, etc.
ADIJOZ_NOTIFY="user@gmail.com"  

# This variable is for the installer only, not for the environment.
# If you need to change the database name (e.g. to have two parallel instances)
# check inc.php query() function for how we setup $db via a file.
ADIJOZ_DB='adijoz'  

# Adijoz is meant to be integrated with a separate authentication form. By
# default ADIJOZ_DISABLE_AUTH is ON, which lets you test the system, but allows
# everyone to use it. You need a form which authenticates the users and sets
# $_SESSION['user_id'] (people.id) and $_SESSION['user'] (people.name). See the
# people table below in this script. Once you have coded the authentication
# form, just set ADIJOZ_DISABLE_AUTH=0.
ADIJOZ_DISABLE_AUTH=1			

# Run this shell script to setup postgres for adijoz project. If you are on a
# hosting server with users that cannot be trusted and/or if you cannot write
# to /etc/apache2/envvars then you need to find your way to propagate these
# variables for www-data user. Or just make them constants in adijoz code.

#  =================  END OF CONFIGURATION  ===============


# init #{{{
USER=`id -ru`
[ "X$USER" == "X0" ] && { echo "Don't run as root / sudo"; exit; }

[ $ADIJOZ_DB_PASS == 'secret' ] && {  
	echo "Password for adijoz user needs to be changed from the default='secret'."; 
	echo
	exit;
} 
#}}}
# www-data user needs ADIJOZ_DB vars. They are kept in www-data environment: /etc/apache2/envvars #{{{
temp=`mktemp`
sudo cat /etc/apache2/envvars | grep -v ADIJOZ_  > $temp
echo "export ADIJOZ_DB_USER='$ADIJOZ_DB_USER'" >> $temp
echo "export ADIJOZ_DB_PASS='$ADIJOZ_DB_PASS'" >> $temp
echo "export ADIJOZ_SESSION_NAME='$ADIJOZ_SESSION_NAME'" >> $temp
echo "export ADIJOZ_LANG='$ADIJOZ_LANG'" >> $temp
echo "export ADIJOZ_NOTIFY='$ADIJOZ_NOTIFY'" >> $temp
echo "export ADIJOZ_DISABLE_AUTH='$ADIJOZ_DISABLE_AUTH'" >> $temp
echo "export ADIJOZ_LOGOUT_BUTTON='$ADIJOZ_LOGOUT_BUTTON'" >> $temp

sudo cp $temp /etc/apache2/envvars
rm $temp

[ "X$1" == "Xclear" ] && { 
	echo "sudo -u postgres psql -c \"DROP DATABASE $ADIJOZ_DB\"";
	echo "sudo -u postgres psql -c \"DROP USER $ADIJOZ_DB_USER\"";
	echo "enter or ctrl+c";
	read;
	sudo -u postgres psql -c "DROP DATABASE $ADIJOZ_DB";
	sudo -u postgres psql -c "DROP USER $ADIJOZ_DB_USER";
}

sudo -u postgres psql -lqt | cut -d \| -f 1 | grep -qw $ADIJOZ_DB && { 
	echo ""
	echo "$ADIJOZ_DB already exists in psql. You may wish to call";
	echo "DROP DATABASE $ADIJOZ_DB; DROP USER $ADIJOZ_DB_USER" 
	echo "by running:"
	echo ""
	echo "	bash install.sh clear";
	echo ""
	exit
}


#}}}
# psql#{{{
sudo -u postgres psql << EOF
CREATE DATABASE $ADIJOZ_DB WITH ENCODING='UTF8';
CREATE USER $ADIJOZ_DB_USER WITH PASSWORD '$ADIJOZ_DB_PASS';

\c $ADIJOZ_DB;

CREATE TABLE people(
	id serial PRIMARY KEY,
	name text,
	department text
);

INSERT INTO people(name , department) values('Lannister Jaimie' , 'Lannisters');
INSERT INTO people(name , department) values('Lannister Tyrion' , 'Lannisters');
INSERT INTO people(name , department) values('Lannister Cersei' , 'Lannisters');
INSERT INTO people(name , department) values('Stark Ned'        , 'Starks');
INSERT INTO people(name , department) values('Stark Sansa'      , 'Starks');

-- Instead of using fake Lannisters above, you can connect to another DB containing real people by dblink:
-- CREATE EXTENSION dblink;
-- CREATE VIEW people as SELECT id, name FROM dblink('dbname= host= user= password=', 'SELECT id, name FROM workers') as foo (id integer, name text);

CREATE OR REPLACE FUNCTION update_modified_column()	
RETURNS TRIGGER AS \$\$
BEGIN
    NEW.modified = now();
    RETURN NEW;	
END;
\$\$ language 'plpgsql';

CREATE TABLE adijoz (
	id serial PRIMARY KEY, 
	year int,
	user_id int,
	modified timestamp default current_timestamp,
	taken text,
	leaves text,
	block text,
	limits text
);

CREATE VIEW v as SELECT people.name, people.department, people.id as user_id, adijoz.year, adijoz.leaves,adijoz.limits, adijoz.taken, adijoz.block 
FROM people LEFT JOIN adijoz ON (people.id=adijoz.user_id);

CREATE TRIGGER update_modified BEFORE UPDATE ON adijoz FOR EACH ROW EXECUTE PROCEDURE update_modified_column();

ALTER DATABASE $ADIJOZ_DB OWNER TO $ADIJOZ_DB_USER;
ALTER TABLE adijoz OWNER TO $ADIJOZ_DB_USER;

GRANT ALL PRIVILEGES ON DATABASE $ADIJOZ_DB TO $ADIJOZ_DB_USER;
GRANT ALL ON ALL TABLES IN SCHEMA public TO $ADIJOZ_DB_USER;
GRANT ALL ON ALL SEQUENCES IN SCHEMA public TO $ADIJOZ_DB_USER;


EOF
echo;
#}}}
# final#{{{
echo;
echo "Restarting apache..."
sudo service apache2 restart
echo;
echo "You need to configure the leave types in adijoz/conf.json";
echo "IMPORTANT: you may need to increase max_input_vars in php.ini (/etc/php/7.2/apache2/php.ini?) or you will not process all your users.";
echo "For say ~500 users Adijoz needs max_input_vars=3000. Inspect your /var/log/apache/error.log.";
#}}}
