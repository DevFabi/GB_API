CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `category` (`id`, `name`, `created`, `deleted`) VALUES
(1, 'Bar', '2018-06-01 00:35:07', '0'),
(2, 'Restaurant','2018-06-01 00:35:07', '0'),
(3, 'Voyage','2018-06-01 00:35:07', '0'),
(4, 'Balade', '2018-06-01 00:35:07', '0');

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category_id` int(11) NOT NULL,
  `adress_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

INSERT INTO `activity` (`id`, `name`, `price`,`category_id`,`adress_id`,`note_id`,`photo_id`,`created`, `deleted`) VALUES
(1, 'Kampai garden',`35`,`1`,`1`,`1`,`1`, '2018-06-01 00:35:07', '0'),
(2, 'Winners',`122`,`4`,`2`,`1`,`1`,'2018-06-01 00:35:07',`34`, '0'),
(3, 'Quebec',`234`,`3`,`2`,`1`,`1`,'2018-06-01 00:35:07', '0'),
(4, 'Shake shack',`25`,`1`,`1`,`1`,`1`, '2018-06-01 00:35:07', '0');


CREATE TABLE `activity_commentaire` (
  `commentaire_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `activity_commentaire` (`commentaire_id`, `activity_id`) VALUES
('1','1'),
('2','2'),
('2','3'),
('1','4');

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(32) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `commentaire` (`id`, `author`, `content`, `created`, `deleted`) VALUES
(1, 'Fabi la débile', 'Petit commentaire juste pour tester','2018-06-21 00:35:07', '0'),
(2, 'Fabi la débile','Petit commentaire juste pour tester','2018-04-10 00:35:07', '0'),
(3, 'Alex le relou','Petit commentaire juste pour tester','2018-02-11 00:35:07', '0'),
(4, 'Alex le relou','Petit commentaire juste pour tester', '2018-02-00 00:35:07', '0');

CREATE TABLE `adress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adress` varchar(60) NOT NULL,
  `codepostal` varchar(10) NOT NULL,
  `ville` varchar(60) NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `adress` (`id`, `adress`, `codepostal`,`ville`, `created`, `deleted`) VALUES
(1, '331 AV clarke', 'H3Z 2E7','WESTMOUNT','2018-06-21 00:35:07', '0'),
(2, '333 AV clarke','H3Z 2E7','WESTMOUNT','2018-04-10 00:35:07', '0'),
(3, '334 AV clarke','H3Z 2E7','WESTMOUNT','2018-02-11 00:35:07', '0'),
(4, '336 AV clarke','H3Z 2E7','WESTMOUNT', '2018-02-00 00:35:07', '0');

CREATE TABLE `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note_ambiance` varchar(10) NOT NULL,
  `note_food` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `note` (`id`, `note_ambiance`, `note_food`, `created`, `deleted`) VALUES
(1, '7', '1','2018-06-21 00:35:07', '0'),
(2, '4','17','2018-04-10 00:35:07', '0'),
(3, '17','1','2018-02-11 00:35:07', '0'),
(4, '20','17', '2018-02-00 00:35:07', '0');

CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(350) NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `photo` (`id`, `img`, `created`, `deleted`) VALUES
(1, '7.jpg','2018-06-21 00:35:07', '0'),
(2, '4.jpg','2018-04-10 00:35:07', '0'),
(3, '17.jpg','2018-02-11 00:35:07', '0'),
(4, '20.jpg','2018-02-00 00:35:07', '0');