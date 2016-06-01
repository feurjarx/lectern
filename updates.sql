CREATE TABLE `lectern`.`review` (
  `id`          INT         NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(50) NOT NULL,
  `description` TEXT        NOT NULL,
  `rating`      INT         NULL,
  `user_id`     INT         NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

ALTER TABLE `review` ADD INDEX(`user_id`);

ALTER TABLE `review` CHANGE `user_id` `user_id` INT(11) NULL;

ALTER TABLE `review` ADD FOREIGN KEY (`user_id`) REFERENCES `lectern`.`user` (`id`)
  ON DELETE SET NULL
  ON UPDATE RESTRICT;

ALTER TABLE `ad` ADD INDEX(`salary`);
ALTER TABLE `ad` ADD INDEX(`sphere`);

ALTER TABLE `review` ADD `published_at` INT NOT NULL AFTER `description`;

ALTER TABLE `review` ADD INDEX(`published_at`);




