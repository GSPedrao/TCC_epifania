-- -----------------------------------------------------
-- Schema tecnolist
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `tecnolist` ;
-- -----------------------------------------------------
-- Schema tecnolist
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tecnolist` DEFAULT CHARACTER SET utf8 ;
USE `tecnolist` ;
-- -----------------------------------------------------
-- Table `tecnolist`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`usuario` ;
CREATE TABLE IF NOT EXISTS `tecnolist`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `ativo` BINARY(1) NOT NULL,
  PRIMARY KEY (`id_usuario`));
-- -----------------------------------------------------
-- Table `tecnolist`.`tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`tipo` ;
CREATE TABLE IF NOT EXISTS `tecnolist`.`tipo` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tipo`));
-- -----------------------------------------------------
-- Table `tecnolist`.`localizacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`localizacao` ;
CREATE TABLE IF NOT EXISTS `tecnolist`.`localizacao` (
  `id_localizacao` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_localizacao`));
-- -----------------------------------------------------
-- Table `tecnolist`.`ativo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`ativo` ;
CREATE TABLE IF NOT EXISTS `tecnolist`.`ativo` (
  `id_ativo` VARCHAR(24) NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `id_tipo` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `id_localizacao` INT NOT NULL,
  PRIMARY KEY (`id_ativo`, `id_usuario`),
  CONSTRAINT `fk_ativo_tipo1`
    FOREIGN KEY (`id_tipo`)
    REFERENCES `tecnolist`.`tipo` (`id_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ativo_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tecnolist`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ativo_localizacao1`
    FOREIGN KEY (`id_localizacao`)
    REFERENCES `tecnolist`.`localizacao` (`id_localizacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
-- -----------------------------------------------------
-- Table `tecnolist`.`chamado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`chamado` ;
CREATE TABLE IF NOT EXISTS `tecnolist`.`chamado` (
  `id_chamada` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  `data_abertura` DATETIME NOT NULL,
  `data_fechamento` DATETIME NOT NULL,
  `satus` VARCHAR(45) NOT NULL,
  `id_ativo` VARCHAR(24) NOT NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_chamada`, `id_ativo`, `id_usuario`),
  CONSTRAINT `fk_chamado_ativo1`
    FOREIGN KEY (`id_ativo`)
    REFERENCES `tecnolist`.`ativo` (`id_ativo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tecnolist`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
-- -----------------------------------------------------
-- Table `tecnolist`.`grupo_de_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`grupo_de_usuario` ;
CREATE TABLE IF NOT EXISTS `tecnolist`.`grupo_de_usuario` (
  `id_grupo` INT NOT NULL AUTO_INCREMENT,
  `nome_grupo` VARCHAR(45) NOT NULL,
  `nivel` INT(1) NOT NULL,
  PRIMARY KEY (`id_grupo`));
-- -----------------------------------------------------
-- Table `tecnolist`.`usuario_has_grupo_de_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`usuario_has_grupo_de_usuario` ;
CREATE TABLE IF NOT EXISTS `tecnolist`.`usuario_has_grupo_de_usuario` (
  `id_usuario` INT NOT NULL,
  `id_grupo_de_usuario` INT NOT NULL,
  `id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_usuario_has_grupo_de_usuario_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tecnolist`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_grupo_de_usuario_grupo_de_usuario1`
    FOREIGN KEY (`id_grupo_de_usuario`)
    REFERENCES `tecnolist`.`grupo_de_usuario` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);