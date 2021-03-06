CREATE TABLE `__database_name__`.`__table_name__`(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `sortable_id` INT(11),
  `fontawesome_class` VARCHAR(50) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `link_url` VARCHAR(50),
  `created_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT(11),
  `last_modified_date` DATETIME,
  `last_modified_by` INT(11),
  `is_deleted` TINYINT(1) DEFAULT 0,
  `deleted_date` DATETIME,
  `deleted_by` INT,
  PRIMARY KEY (`id`),
  INDEX `IDX___abbr___created_by` (`created_by`),
  INDEX `IDX___abbr___last_mf_by` (`last_modified_by`),
  INDEX `IDX___abbr___deleted_by` (`deleted_by`)
) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1;
