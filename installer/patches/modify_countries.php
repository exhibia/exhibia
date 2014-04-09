--NEXT_QUERY--

alter table countries add column default_pos int(11) null;

--NEXT_QUERY--

alter table countries add column disabled int(1) null;

--NEXT_QUERY--

update countries set default_pos = 1 where iso = 'US';





also add a variable to config/config.inc.php called

$country_extra_sql 

if it  is missing this variable can be used to exclude include and
sort the countries in a more customised manner than what was there previously
