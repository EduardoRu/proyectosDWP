DROP SCHEMA IF EXISTS `alupros`;
CREATE SCHEMA IF NOT EXISTS `alupros` DEFAULT CHARACTER SET utf8 ;
USE `alupros` ;

-- -----------------------------------------------------
-- Table `alupros`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alupros`.`usuarios` (
  `id_usuarios` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuarios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `alupros`.`proyecto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alupros`.`proyecto` (
  `id_proyecto` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `nombre_proyecto` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `imagen_src` VARCHAR(255) NULL,
  `correo_proyecto` VARCHAR(60) NULL,
  `telefono` INT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_proyecto`, `id_usuario`),
  CONSTRAINT `proyectos_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `alupros`.`usuarios` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;