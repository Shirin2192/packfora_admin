ALTER TABLE `tbl_case_study` ADD `title` VARCHAR(100) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `tbl_case_study` ADD `date` DATE NULL DEFAULT NULL AFTER `image`;
ALTER TABLE `tbl_our_leaders` ADD `link` TEXT NULL DEFAULT NULL AFTER `designation`;
ALTER TABLE `tbl_whitepaper_download` ADD `phone` TEXT NULL DEFAULT NULL AFTER `email`;
ALTER TABLE `tbl_impact_enabled` CHANGE `icon` `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
CREATE TABLE `tbl_case_study` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `badge` VARCHAR(100), -- Example: "Foods", "Personal Care"
    `image` VARCHAR(255), -- Image filename or path
    `slug_url` VARCHAR(255), -- e.g., case-study-inner.php
    `publish_date` DATE,
    `is_active` TINYINT(1) DEFAULT 1,
    `is_delete` TINYINT(1) DEFAULT 0,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE `tbl_case_study_tags` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL
);
CREATE TABLE `tbl_case_study_tag_map` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `case_study_id` INT NOT NULL,
    `tag_id` INT NOT NULL,
    FOREIGN KEY (`case_study_id`) REFERENCES `tbl_case_study`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`tag_id`) REFERENCES `tbl_case_study_tags`(`id`) ON DELETE CASCADE
);
ALTER TABLE `tbl_case_study`
ADD COLUMN `case_study_link` VARCHAR(255) AFTER `slug_url`;
ALTER TABLE `tbl_case_study_tags` ADD `is_delete` ENUM('1','0') NOT NULL AFTER `category`, ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `is_delete`, ADD `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
ALTER TABLE `tbl_case_study` ADD `video` TEXT NULL DEFAULT NULL AFTER `image`;
