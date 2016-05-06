требуется установить (global)
nodejs
git
grunt
composer
bower

Создать таблицу user:
CREATE TABLE `lectern`.`user` ( `id` INT NOT NULL AUTO_INCREMENT , `first_name` VARCHAR(50) NOT NULL , `last_name` VARCHAR(100) NULL , `email` VARCHAR(80) NOT NULL , `password` VARCHAR(32) NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `reason` VARCHAR(255) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


для предоставления доступа к SMTP серверу google надо включить здесь доступ: https://www.google.com/settings/security/lesssecureapps

gmail аккаунт:
yakoann03@gmail.com
Pm4h1nCkCZd4