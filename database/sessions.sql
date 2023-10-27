CREATE TABLE `sessions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(10) NOT NULL,
  `session_type`  char(10),
  `instructor_id` int(10) NOT NULL,
  `package_id` int(10) NOT NULL,
  `package_session` tinyint(4) DEFAULT NULL,
  `session_taken` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE session_remarks(
  id int(10) not null PRIMARY KEY AUTO_INCREMENT,
  session_id int(10) not null,
  member_id int(10) not null,
  instructor_id int(10) not null,
  remarks text,
  created_at timestamp DEFAULT NOW()
);