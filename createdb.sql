-- MySQL Script generated by MySQL Workbench
-- Mon Jul 23 14:40:30 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema my_progettobasi2018
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema my_progettobasi2018
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `my_progettobasi2018` DEFAULT CHARACTER SET utf8 ;
USE `my_progettobasi2018` ;

-- -----------------------------------------------------
-- Table `my_progettobasi2018`.`Categorie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `my_progettobasi2018`.`Categorie` (
  `idCategoria` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCategoria`),
  UNIQUE INDEX `idCategorie_UNIQUE` (`idCategoria` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `my_progettobasi2018`.`Prodotti`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `my_progettobasi2018`.`Prodotti` (
  `idProdotto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Marca` VARCHAR(45) NOT NULL,
  `Modello` VARCHAR(45) NOT NULL,
  `Sigla` VARCHAR(45) NOT NULL,
  `Descrizione` VARCHAR(200) NOT NULL,
  `Prezzo` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0,
  `Quantita` INT UNSIGNED NOT NULL DEFAULT 0,
  `Image` VARCHAR(100) NOT NULL,
  `idCategoria` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idProdotto`, `idCategoria`),
  UNIQUE INDEX `idProdotti_UNIQUE` (`idProdotto` ASC),
  INDEX `fk_Prodotti_Categorie_idx` (`idCategoria` ASC),
  CONSTRAINT `fk_Prodotti_Categorie`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `my_progettobasi2018`.`Categorie` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `my_progettobasi2018`.`Utenti`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `my_progettobasi2018`.`Utenti` (
  `idUtente` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NOT NULL,
  `Cognome` VARCHAR(45) NOT NULL,
  `Indirizzo` VARCHAR(45) NOT NULL,
  `Telefono` VARCHAR(45) NOT NULL,
  `Admin` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `Passowrd` VARCHAR(45) NOT NULL,
  `Image` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idUtente`),
  UNIQUE INDEX `idUtente_UNIQUE` (`idUtente` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `my_progettobasi2018`.`Ordini`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `my_progettobasi2018`.`Ordini` (
  `idOrdine` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Data` VARCHAR(45) NOT NULL,
  `Stato` INT UNSIGNED NOT NULL,
  `Pagamento` VARCHAR(45) NOT NULL,
  `idUtente` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idOrdine`, `idUtente`),
  UNIQUE INDEX `idOrdine_UNIQUE` (`idOrdine` ASC),
  INDEX `fk_Ordini_Utenti1_idx` (`idUtente` ASC),
  CONSTRAINT `fk_Ordini_Utenti1`
    FOREIGN KEY (`idUtente`)
    REFERENCES `my_progettobasi2018`.`Utenti` (`idUtente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `my_progettobasi2018`.`Prodotti_nel_Ordine`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `my_progettobasi2018`.`Prodotti_nel_Ordine` (
  `idOrdine` INT UNSIGNED NOT NULL,
  `idProdotto` INT UNSIGNED NOT NULL,
  `Prezzo` DECIMAL(6,2) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`idOrdine`, `idProdotto`),
  INDEX `fk_Ordini_has_Prodotti_Prodotti1_idx` (`idProdotto` ASC),
  INDEX `fk_Ordini_has_Prodotti_Ordini1_idx` (`idOrdine` ASC),
  CONSTRAINT `fk_Ordini_has_Prodotti_Ordini1`
    FOREIGN KEY (`idOrdine`)
    REFERENCES `my_progettobasi2018`.`Ordini` (`idOrdine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ordini_has_Prodotti_Prodotti1`
    FOREIGN KEY (`idProdotto`)
    REFERENCES `my_progettobasi2018`.`Prodotti` (`idProdotto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `my_progettobasi2018`.`Prodotti_Nel_Carrello`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `my_progettobasi2018`.`Prodotti_Nel_Carrello` (
  `Prodotti_idProdotto` INT UNSIGNED NOT NULL,
  `Utenti_idUtente` INT UNSIGNED NOT NULL,
  `Quantità` INT NOT NULL,
  PRIMARY KEY (`Prodotti_idProdotto`, `Utenti_idUtente`),
  INDEX `fk_Prodotti_has_Utenti_Utenti1_idx` (`Utenti_idUtente` ASC),
  INDEX `fk_Prodotti_has_Utenti_Prodotti1_idx` (`Prodotti_idProdotto` ASC),
  CONSTRAINT `fk_Prodotti_has_Utenti_Prodotti1`
    FOREIGN KEY (`Prodotti_idProdotto`)
    REFERENCES `my_progettobasi2018`.`Prodotti` (`idProdotto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Prodotti_has_Utenti_Utenti1`
    FOREIGN KEY (`Utenti_idUtente`)
    REFERENCES `my_progettobasi2018`.`Utenti` (`idUtente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;