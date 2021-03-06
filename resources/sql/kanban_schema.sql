-- MySQL Script generated by MySQL Workbench
-- Wed Oct  3 08:42:07 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema kanbanboard
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema kanbanboard
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `kanbanboard` DEFAULT CHARACTER SET utf8 ;
USE `kanbanboard` ;

-- -----------------------------------------------------
-- Table `kanbanboard`.`T_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kanbanboard`.`T_users` ;

CREATE TABLE IF NOT EXISTS `kanbanboard`.`T_users` (
  `idT_users` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `t_users_name` VARCHAR(45) NOT NULL,
  `t_users_pass` VARCHAR(255) NOT NULL,
  `t_users_salt` VARCHAR(45) NULL,
  PRIMARY KEY (`idT_users`),
  UNIQUE INDEX `idT_users_UNIQUE` (`idT_users` ASC),
  UNIQUE INDEX `t_users_name_UNIQUE` (`t_users_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kanbanboard`.`T_buckets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kanbanboard`.`T_buckets` ;

CREATE TABLE IF NOT EXISTS `kanbanboard`.`T_buckets` (
  `idT_buckets` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `t_buckets_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idT_buckets`),
  UNIQUE INDEX `idT_buckets_UNIQUE` (`idT_buckets` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kanbanboard`.`T_tasks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kanbanboard`.`T_tasks` ;

CREATE TABLE IF NOT EXISTS `kanbanboard`.`T_tasks` (
  `idT_tasks` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `t_tasks_content` TEXT(1023) NOT NULL,
  `t_buckets_name` VARCHAR(45) NOT NULL,
  `fk_tasks_users` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idT_tasks`),
  UNIQUE INDEX `idT_tasks_UNIQUE` (`idT_tasks` ASC),
  INDEX `fk_T_tasks_T_users1_idx` (`fk_tasks_users` ASC),
  CONSTRAINT `fk_T_tasks_T_users1`
    FOREIGN KEY (`fk_tasks_users`)
    REFERENCES `kanbanboard`.`T_users` (`idT_users`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE = '';
GRANT USAGE ON *.* TO kanbandb;
 DROP USER kanbandb;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
CREATE USER 'kanbandb' IDENTIFIED BY 'kanban';

GRANT ALL ON `kanbanboard`.* TO 'kanbandb';
GRANT SELECT, INSERT, TRIGGER ON TABLE `kanbanboard`.* TO 'kanbandb';
GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `kanbanboard`.* TO 'kanbandb';
GRANT EXECUTE ON ROUTINE `kanbanboard`.* TO 'kanbandb';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
