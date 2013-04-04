ALTER TABLE `zt_request` ADD `repliedBy` MEDIUMINT NOT NULL AFTER `assignedDate` ;
ALTER TABLE `zt_user` CHANGE `gendar` `gender` ENUM( 'f', 'm' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'f';
