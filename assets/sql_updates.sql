-- New table to store images of problems
CREATE TABLE `figures` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
     `problem_id` int(11) DEFAULT NULL,
       `display_order` int(11) DEFAULT NULL,
         `figure` mediumblob,
           `filetype` varchar(10) DEFAULT NULL,
             PRIMARY KEY (`id`)
             ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ;

-- New column for keywords in the problem table
alter table problems add column keywords varchar(255) after description;

-- search index
create fulltext index searchindex on problems (title,keywords,description);
