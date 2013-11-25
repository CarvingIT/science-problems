-- New table to store images of problems
CREATE TABLE `figures` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
     `problem_id` int(11) DEFAULT NULL,
       `display_order` int(11) DEFAULT NULL,
         `figure` mediumblob,
           `filetype` varchar(10) DEFAULT NULL,
             PRIMARY KEY (`id`)
             ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ;
