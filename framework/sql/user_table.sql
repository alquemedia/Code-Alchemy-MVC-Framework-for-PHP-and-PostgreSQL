CREATE TABLE `__database_name__`.`__table_name__`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_id` varchar(100) DEFAULT NULL,
  `type` enum('user','customer','admin') NOT NULL DEFAULT 'user',
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `seo_name` varchar(100) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `salt` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `profile_main_image` varchar(100) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `ip_address` varchar(16) DEFAULT NULL,
  `num_visits` int(11) DEFAULT '0',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified_date` datetime DEFAULT NULL,
  `last_modified_by` int(11) NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL,
  `ckey` varchar(50) DEFAULT NULL,
  `ctime` varchar(50) DEFAULT NULL,
  `comments` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;