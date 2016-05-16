ALTER TABLE ad DROP FOREIGN KEY ad_ibfk_1;
ALTER TABLE ad DROP INDEX company_id;
ALTER TABLE `ad` CHANGE `company_id` `company` VARCHAR(255) NOT NULL;
DROP TABLE company;

ALTER TABLE `user` ADD `company` VARCHAR(255) NOT NULL AFTER `img_url`;
