CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(8) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `post_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `posts`
MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
