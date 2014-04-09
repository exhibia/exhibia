<?php
@db_query("
CREATE TABLE IF NOT EXISTS `game_categories` (
  `categoryID` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `games_count` int(11) NOT NULL default '0',
  `description` text NOT NULL,
  `picture` varchar(100) NOT NULL default '',
  `status` int(11) NOT NULL default '0',
  `set_and_forget` tinyint(1) default '0',
  `vendor_reqired` varchar(20) default NULL,
  PRIMARY KEY  (`categoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;");
@db_query("alter table game_categories add column picture1 text");
@db_query("alter table game_categories add column picture2 text");
@db_query("alter table game_categories add column picture3 text");
@db_query("alter table game_categories add column picture4 text");


@db_query("
CREATE TABLE IF NOT EXISTS `games` (
  `gameID` int(11) NOT NULL auto_increment,
  `categoryID` int(11) NOT NULL,
  `language_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `min_players` int(2) not null,
  `max_players` int(2) not null,
  `url` text null,
  `picture1` varchar(100) NOT NULL default '',
  `picture2` varchar(100) NOT NULL default '',
  `picture3` varchar(100) NOT NULL default '',
  `status` int(11) NOT NULL default '0',
  `set_and_forget` tinyint(1) default '0',
  `vendor_reqired` varchar(20) default NULL,
  PRIMARY KEY  (`gameID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;");



$MainLinksArray = array(
    // (item name, link, haschild)
   
    array("Master Settings", "#", 1),
    array("Games", "#", 1),
    
);


$ChildLinksArray = array(
    array("Manage Categories", "get_addon.php?addon=$_REQUEST[addon]&page=admin/managecat.php", 0, 'users1', 'sm1'),
    array("Add Category", "get_addon.php?addon=$_REQUEST[addon]&page=admin/addcategory.php", 0, 'users1', 'sm1'),
    array("Add Game", "get_addon.php?addon=$_REQUEST[addon]&page=admin/addgame.php", 0, 'users1', 'sm1'),
    array("Manage Games", "get_addon.php?addon=$_REQUEST[addon]&page=admin/managegames.php", 0, 'users1', 'sm1'),
    array("Master Settings", "get_addon.php?addon=$_REQUEST[addon]&page=admin/master_settings.php", 0, 'users1', 'sm1'),
 ); 

 
$qry = db_query("select * from sitesetting where name = 'games'");

while($row = db_fetch_array($qry)){

    $ChildLinksArray[] = array(ucfirst($row['value']), "get_addon.php?addon=games&page="  . $row['value'] . "/admin/settings.php", 1, 'users1', 'sm1');


}