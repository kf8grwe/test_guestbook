CREATE TABLE `users` ( 
	`user_id` INT NOT NULL AUTO_INCREMENT, 
	`name` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
	`email` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci  NOT NULL ,
	PRIMARY KEY (`user_id`) 
) ENGINE = InnoDB;

CREATE TABLE `messages` ( 
	`message_id` INT NOT NULL AUTO_INCREMENT, 
	`user_id` INT NOT NULL, 
	`header` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
	`text` TEXT(1024) CHARACTER SET utf8 COLLATE utf8_general_ci  NOT NULL , 
	`is_approved` BOOLEAN NOT NULL DEFAULT FALSE , 
	`date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
	PRIMARY KEY (`message_id`) 
) ENGINE = InnoDB;
