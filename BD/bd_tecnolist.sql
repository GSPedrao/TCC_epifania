
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
  `id_usuario` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `status` INT(1) NOT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tecnolist`.`tipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`tipo` ;

CREATE TABLE IF NOT EXISTS `tecnolist`.`tipo` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tecnolist`.`localizacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`localizacao` ;

CREATE TABLE IF NOT EXISTS `tecnolist`.`localizacao` (
  `id_localizacao` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_localizacao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tecnolist`.`ativo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`ativo` ;

CREATE TABLE IF NOT EXISTS `tecnolist`.`ativo` (
  `id_ativo` INT UNSIGNED NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `usuario_id_usuario` INT ZEROFILL NOT NULL,
  `tipo_id_tipo` INT NOT NULL,
  `localizacao_id_localizacao` INT NOT NULL,
  PRIMARY KEY (`id_ativo`, `usuario_id_usuario`),
  CONSTRAINT `fk_ativo_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `tecnolist`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ativo_tipo1`
    FOREIGN KEY (`tipo_id_tipo`)
    REFERENCES `tecnolist`.`tipo` (`id_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ativo_localizacao1`
    FOREIGN KEY (`localizacao_id_localizacao`)
    REFERENCES `tecnolist`.`localizacao` (`id_localizacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tecnolist`.`chamado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`chamado` ;

CREATE TABLE IF NOT EXISTS `tecnolist`.`chamado` (
  `id_chamada` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  `data_abertura` DATETIME NOT NULL,
  `ativo_id_ativo` INT UNSIGNED NOT NULL,
  `ativo_usuario_id_usuario` INT ZEROFILL NOT NULL,
  `usuario_id_usuario` INT ZEROFILL NOT NULL,
  `data_fechamento` DATETIME NOT NULL,
  PRIMARY KEY (`id_chamada`, `ativo_id_ativo`, `ativo_usuario_id_usuario`, `usuario_id_usuario`),
  CONSTRAINT `fk_chamada_ativo1`
    FOREIGN KEY (`ativo_id_ativo` , `ativo_usuario_id_usuario`)
    REFERENCES `tecnolist`.`ativo` (`id_ativo` , `usuario_id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamada_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `tecnolist`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tecnolist`.`grupo_de_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`grupo_de_usuario` ;

CREATE TABLE IF NOT EXISTS `tecnolist`.`grupo_de_usuario` (
  `id_grupo` INT NOT NULL AUTO_INCREMENT,
  `nome_grupo` VARCHAR(45) NOT NULL,
  `nivel` INT(1) NOT NULL,
  PRIMARY KEY (`id_grupo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tecnolist`.`usuario_has_grupo_de_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tecnolist`.`usuario_has_grupo_de_usuario` ;

CREATE TABLE IF NOT EXISTS `tecnolist`.`usuario_has_grupo_de_usuario` (
  `usuario_id_usuario` INT ZEROFILL NOT NULL,
  `grupo_de_usuario_id_grupo` INT NOT NULL,
  PRIMARY KEY (`usuario_id_usuario`, `grupo_de_usuario_id_grupo`),
  CONSTRAINT `fk_usuario_has_grupo_de_usuario_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `tecnolist`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_grupo_de_usuario_grupo_de_usuario1`
    FOREIGN KEY (`grupo_de_usuario_id_grupo`)
    REFERENCES `tecnolist`.`grupo_de_usuario` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
