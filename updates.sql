ALTER TABLE `user` DROP `first_name`;
ALTER TABLE `user` DROP `last_name`;
ALTER TABLE `user` DROP `organisation`;


CREATE TABLE `lectern`.`category` (
  `id`    INT                                     NOT NULL AUTO_INCREMENT,
  `name`  VARCHAR(50)                             NOT NULL,
  `model` ENUM ('Function', 'Language', 'Common') NOT NULL DEFAULT 'Common',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

CREATE TABLE `lectern`.`address` (
  `id`               INT         NOT NULL AUTO_INCREMENT,
  `city`             VARCHAR(30) NOT NULL,
  `street`           VARCHAR(80) NULL,
  `house_number`     VARCHAR(7)  NULL,
  `apartment_number` VARCHAR(7)  NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

CREATE TABLE `lectern`.`contact` (
  `id`         INT         NOT NULL AUTO_INCREMENT,
  `address_id` INT         NOT NULL,
  `websites`   TEXT        NULL,
  `phone`      VARCHAR(15) NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

ALTER TABLE `contact` ADD INDEX(`address_id`);

ALTER TABLE `contact` CHANGE `address_id` `address_id` INT(11) NULL;

ALTER TABLE `contact` ADD FOREIGN KEY (`address_id`) REFERENCES `lectern`.`address` (`id`)
  ON DELETE SET NULL
  ON UPDATE RESTRICT;

CREATE TABLE `lectern`.`person` (
  `id`           INT                   NOT NULL AUTO_INCREMENT,
  `user_id`      INT                   NOT NULL,
  `contact_id`   INT                   NOT NULL,
  `gender`       ENUM ('man', 'foman') NOT NULL,
  `organisation` VARCHAR(70)           NOT NULL,
  `last_name`    VARCHAR(30)           NULL,
  `first_name`   VARCHAR(20)           NULL,
  `father_name`  VARCHAR(30)           NULL,
  `date_birth`   DATE                  NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

ALTER TABLE `person` ADD INDEX(`user_id`);
ALTER TABLE `person` ADD INDEX(`contact_id`);

ALTER TABLE `person` ADD FOREIGN KEY (`user_id`) REFERENCES `lectern`.`user` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `person` ADD FOREIGN KEY (`contact_id`) REFERENCES `lectern`.`contact` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

CREATE TABLE `lectern`.`cv` (
  `id`                 INT                                                                                                         NOT NULL AUTO_INCREMENT,
  `access_type`        ENUM ('public', 'private')                                                                                  NOT NULL,
  `desire_functions`   VARCHAR(200)                                                                                                NOT NULL,
  `created_at`         INT                                                                                                         NOT NULL,
  `person_id`          INT                                                                                                         NOT NULL,
  `skills`             VARCHAR(1024)                                                                                               NOT NULL,
  `work_experience`    ENUM ('nope', '<1', '1-3', '3-5', '5>')                                                                     NOT NULL,
  `education`          ENUM ('<middle', 'middle', 'middle>', '>high', 'high', 'many_high', 'fulltime_student', 'distance_student') NOT NULL,
  `ext_education`      VARCHAR(200)                                                                                                NULL,
  `desire_salary`      INT                                                                                                         NULL,
  `schedule`           ENUM ('full', 'remote', 'elastic', 'shift')                                                                 NULL,
  `foreign_languages`  VARCHAR(200)                                                                                                NULL,
  `is_drivers_license` BOOLEAN                                                                                                     NULL,
  `is_smoking`         BOOLEAN                                                                                                     NULL,
  `is_married`         BOOLEAN                                                                                                     NULL,
  `about`              TEXT                                                                                                        NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

ALTER TABLE `cv` ADD INDEX(`person_id`);

ALTER TABLE `cv` ADD FOREIGN KEY (`person_id`) REFERENCES `lectern`.`person` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE ad DROP FOREIGN KEY ad_ibfk_2;
ALTER TABLE ad DROP INDEX user_id;
ALTER TABLE `ad` CHANGE `user_id` `person_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `ad` ADD INDEX(`person_id`);
ALTER TABLE `ad` ADD FOREIGN KEY (`person_id`) REFERENCES `lectern`.`person` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

DROP TABLE category;




