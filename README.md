README
Install mamp tool

MAMP -> Preferences -> Web Server to see the document root

extract the content of submission.zip so that all the inside content of the tool 
(multiples .php multiples .sql files are in the document root)

create a new database called "standard" with default settings

For small dataset to flesh out the features
load the content of "standardc.sql" "standardload.sql" "Trigger.sql" and manually execute

For big dataset > 10000 entries
import "standard.sql" and manually execute "Trigger.sql"

the content should be now at http://localhost/MAMP/ and click "My website"

The database can be seen and accessed at Tools -> PhPMyAdmin 