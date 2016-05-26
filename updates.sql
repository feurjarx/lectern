ALTER TABLE `cv` CHANGE `access_type` `access_type` ENUM('public','private') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'public';

ALTER TABLE `cv` CHANGE `desire_functions` `desire_functions` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

ALTER TABLE `cv` ADD `sphere` ENUM('programmer','system_admin','security_admin','web_designer','project_manager','software_testing','web_developer') NULL AFTER `id`;


ALTER TABLE `cv` CHANGE `desire_functions` `hobbies` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;


