ALTER TABLE `tbl_case_study` ADD `title` VARCHAR(100) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `tbl_case_study` ADD `date` DATE NULL DEFAULT NULL AFTER `image`;
ALTER TABLE `tbl_our_leaders` ADD `link` TEXT NULL DEFAULT NULL AFTER `designation`;
ALTER TABLE `tbl_whitepaper_download` ADD `phone` TEXT NULL DEFAULT NULL AFTER `email`;
ALTER TABLE `tbl_impact_enabled` CHANGE `icon` `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
