ALTER TABLE `tbl_case_study` ADD `title` VARCHAR(100) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `tbl_case_study` ADD `date` DATE NULL DEFAULT NULL AFTER `image`;
ALTER TABLE `tbl_our_leaders` ADD `link` TEXT NULL DEFAULT NULL AFTER `designation`;
