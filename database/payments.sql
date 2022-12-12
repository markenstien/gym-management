	
drop table if exists payments;
CREATE TABLE `payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10),
  `reference` varchar(25) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_key` varchar(50),
  `payment_method` enum('CASH','ONLINE') NOT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL,
  `payer_name` varchar(50) DEFAULT null,
  `account_number` varchar(50) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `external_reference` varchar(50) NOT NULL,
  `is_removed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4