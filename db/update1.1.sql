ALTER TABLE `zt_request` ADD `repliedBy` MEDIUMINT NOT NULL AFTER `assignedDate` ;
ALTER TABLE `zt_user` CHANGE `gendar` `gender` ENUM( 'f', 'm' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'f';
CREATE TABLE `zt_company` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  PRIMARY KEY ( `id` ) 
) ENGINE = MYISAM;
INSERT INTO `zt_company` (`id`, `name`) VALUES (1, '');
