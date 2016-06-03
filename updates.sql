CREATE TABLE `lectern`.`request` (
  `id`         INT                                     NOT NULL AUTO_INCREMENT,
  `cv_id`      INT                                     NOT NULL,
  `ad_id`      INT                                     NOT NULL,
  `created_at` INT                                     NOT NULL,
  `status`     ENUM ('waiting', 'accepted', 'ignored') NOT NULL DEFAULT 'waiting',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

ALTER TABLE `request` ADD INDEX(`cv_id`);
ALTER TABLE `request` ADD INDEX(`ad_id`);

ALTER TABLE `request` ADD FOREIGN KEY (`cv_id`) REFERENCES `lectern`.`cv` (`id`)
  ON DELETE CASCADE
  ON UPDATE RESTRICT;
ALTER TABLE `request` ADD FOREIGN KEY (`ad_id`) REFERENCES `lectern`.`ad` (`id`)
  ON DELETE CASCADE
  ON UPDATE RESTRICT;