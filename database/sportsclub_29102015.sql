-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema sportsclub
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sportsclub
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sportsclub` DEFAULT CHARACTER SET utf8 ;
USE `sportsclub` ;

-- -----------------------------------------------------
-- Table `sportsclub`.`ref_address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`ref_address` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `streetname` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `streetnumber` INT(5) NULL DEFAULT '0' COMMENT '',
  `town` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `region` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `postcode` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `area` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 92
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`ref_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`ref_category` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `category_name` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`ref_profession`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`ref_profession` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `profession_name` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`ref_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`ref_roles` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `role_name` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`ref_school`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`ref_school` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `school_name` VARCHAR(50) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`ref_training_year`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`ref_training_year` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `year` DATE NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_child_athlete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_child_athlete` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `surname` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `first_name` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `dob` DATE NULL DEFAULT NULL COMMENT '',
  `photo` VARCHAR(50) NULL DEFAULT NULL COMMENT '',
  `athlete_card_id` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `athlete_card_id_expire` DATE NULL DEFAULT NULL COMMENT '',
  `admission_date` DATE NULL DEFAULT NULL COMMENT '',
  `email` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `school_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `comments` VARCHAR(100) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_athlete_school_idx` (`school_id` ASC)  COMMENT '',
  CONSTRAINT `fk_athlete_school`
    FOREIGN KEY (`school_id`)
    REFERENCES `sportsclub`.`ref_school` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_training_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_training_group` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `admission_fee` INT(11) NULL DEFAULT NULL COMMENT '',
  `monthly_fee` INT(11) NULL DEFAULT NULL COMMENT '',
  `training_category_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `training_year` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_traininggroup_trainingyear_idx` (`training_year` ASC)  COMMENT '',
  INDEX `fk_traininggroup_category_idx` (`training_category_id` ASC)  COMMENT '',
  CONSTRAINT `fk_traininggroup_category`
    FOREIGN KEY (`training_category_id`)
    REFERENCES `sportsclub`.`ref_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_traininggroup_trainingyear`
    FOREIGN KEY (`training_year`)
    REFERENCES `sportsclub`.`ref_training_year` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_athlete_enroll`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_athlete_enroll` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `athlete_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `traininggroup_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `admission_startdate` DATE NULL DEFAULT NULL COMMENT '',
  `admission_enddate` DATE NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_athleteenrol_child` (`athlete_id` ASC)  COMMENT '',
  INDEX `fk_participants_traininggroup_idx` (`traininggroup_id` ASC)  COMMENT '',
  CONSTRAINT `fk_athleteenrol_child`
    FOREIGN KEY (`athlete_id`)
    REFERENCES `sportsclub`.`tbl_child_athlete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_athleteenroll_traininggroup`
    FOREIGN KEY (`traininggroup_id`)
    REFERENCES `sportsclub`.`tbl_training_group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_training_schedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_training_schedule` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `training_group_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `day` DATE NULL DEFAULT NULL COMMENT '',
  `start_time` DATE NULL DEFAULT NULL COMMENT '',
  `end_time` DATE NULL DEFAULT NULL COMMENT '',
  `active` TINYINT(1) NULL DEFAULT '0' COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `training_idx` (`training_group_id` ASC)  COMMENT '',
  CONSTRAINT `fk_trainingschedule_traininggroup`
    FOREIGN KEY (`training_group_id`)
    REFERENCES `sportsclub`.`tbl_training_group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_attendance_athlete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_attendance_athlete` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `child` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `schedule_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `attendance_date` DATE NULL DEFAULT NULL COMMENT '',
  `has_attended` TINYINT(1) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_attendancechild_child` (`child` ASC)  COMMENT '',
  INDEX `fk_attendance_traininggroupschedule_idx` (`schedule_id` ASC)  COMMENT '',
  CONSTRAINT `fk_attendancechild_child`
    FOREIGN KEY (`child`)
    REFERENCES `sportsclub`.`tbl_child_athlete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attendancechild_schedule`
    FOREIGN KEY (`schedule_id`)
    REFERENCES `sportsclub`.`tbl_training_schedule` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_member` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `surname` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `first_name` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `dob` DATE NULL DEFAULT NULL COMMENT 'date of birth',
  `email` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `profession_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `national_id` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `admission_date` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `active_member` TINYINT(1) NULL DEFAULT NULL COMMENT '',
  `admission_receipt` VARCHAR(10) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_member_profession_idx` (`profession_id` ASC)  COMMENT '',
  CONSTRAINT `fk_member_profession`
    FOREIGN KEY (`profession_id`)
    REFERENCES `sportsclub`.`ref_profession` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 266
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_attendance_member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_attendance_member` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `member_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `schedule_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `attendance_date` DATE NULL DEFAULT NULL COMMENT '',
  `has_attended` TINYINT(1) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_attendance_member_idx` (`member_id` ASC)  COMMENT '',
  INDEX `fk_attendance_schedule_idx` (`schedule_id` ASC)  COMMENT '',
  CONSTRAINT `fk_attendancemember_member`
    FOREIGN KEY (`member_id`)
    REFERENCES `sportsclub`.`tbl_member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attendancemember_schedule`
    FOREIGN KEY (`schedule_id`)
    REFERENCES `sportsclub`.`tbl_training_schedule` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_member_address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_member_address` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `address_member_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `address_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_member_idx` (`address_member_id` ASC)  COMMENT '',
  INDEX `fk_address_idx` (`address_id` ASC)  COMMENT '',
  CONSTRAINT `fk_memberaddess_member`
    FOREIGN KEY (`address_member_id`)
    REFERENCES `sportsclub`.`tbl_member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_memberaddress_address`
    FOREIGN KEY (`address_id`)
    REFERENCES `sportsclub`.`ref_address` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 94
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_member_enroll`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_member_enroll` (
  `id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `member_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `traininggroup_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `admission_startdate` DATE NULL DEFAULT NULL COMMENT '',
  `admission_enddate` DATE NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_enroll_member_idx` (`member_id` ASC)  COMMENT '',
  INDEX `fk_memberenroll_traininggroup_idx` (`traininggroup_id` ASC)  COMMENT '',
  CONSTRAINT `fk_memberenroll_member`
    FOREIGN KEY (`member_id`)
    REFERENCES `sportsclub`.`tbl_member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_memberenroll_traininggroup`
    FOREIGN KEY (`traininggroup_id`)
    REFERENCES `sportsclub`.`tbl_training_group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_member_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_member_role` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `role_member_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `role_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_memberrole_member` (`role_member_id` ASC)  COMMENT '',
  INDEX `fk_role_idx` (`role_id` ASC)  COMMENT '',
  CONSTRAINT `fk_memberrole_member`
    FOREIGN KEY (`role_member_id`)
    REFERENCES `sportsclub`.`tbl_member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_memberrole_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `sportsclub`.`ref_roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 128
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_parents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_parents` (
  `parent_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `member_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `athlete_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`parent_id`)  COMMENT '',
  INDEX `fk_athlete_idx` (`athlete_id` ASC)  COMMENT '',
  INDEX `fk_member_idx` (`member_id` ASC)  COMMENT '',
  CONSTRAINT `fk_parents_athlete`
    FOREIGN KEY (`athlete_id`)
    REFERENCES `sportsclub`.`tbl_child_athlete` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_parents_member`
    FOREIGN KEY (`member_id`)
    REFERENCES `sportsclub`.`tbl_member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sportsclub`.`tbl_training_trainer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportsclub`.`tbl_training_trainer` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `traininggroup_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  `trainer_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_traininggroupcoach_adult_idx` (`trainer_id` ASC)  COMMENT '',
  INDEX `fk_traininggroupcoach_traininggroup_idx` (`traininggroup_id` ASC)  COMMENT '',
  CONSTRAINT `fk_trainingtrainer_member`
    FOREIGN KEY (`trainer_id`)
    REFERENCES `sportsclub`.`tbl_member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_trainingtrainer_traininggroup`
    FOREIGN KEY (`traininggroup_id`)
    REFERENCES `sportsclub`.`tbl_training_group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
