CREATE TABLE `character` (

  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL UNIQUE,
  `health` INT NOT NULL,
  `strength` INT NOT NULL DEFAULT 0,
  `agility` INT NOT NULL DEFAULT 0,

  PRIMARY KEY (`id`)

) ENGINE = InnoDB;

CREATE TABLE `weapon` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL UNIQUE,
  `strike_force` INT NOT NULL DEFAULT 0,
  `defense` INT NOT NULL DEFAULT 0,
  `damage` VARCHAR(10) NOT NULL,

  PRIMARY KEY (`id`)

) ENGINE = InnoDB;

CREATE TABLE `character_weapon` (

  `character_id` INT NOT NULL,
  `weapon_id` INT NOT NULL,

  INDEX (`character_id`),
  INDEX (`weapon_id`),

  FOREIGN KEY `fk_character_id` (`character_id`) REFERENCES `character` (`id`),
  FOREIGN KEY `fk_weapon_id` (`weapon_id`) REFERENCES `weapon` (`id`),
  PRIMARY KEY (`character_id`, `weapon_id`)

) ENGINE = InnoDB;

INSERT INTO `character` (`name`, `health`, `strength`, `agility`) VALUES
  ('Human', 12, 1, 2),
  ('Orc', 20, 2, 0);

INSERT INTO `weapon` (`name`, `strike_force`, `defense`, `damage`) VALUES
  ('Sword', 2, 1, '1d6'),
  ('Cudgel', 1, 0, '1d8');

INSERT INTO `character_weapon` (character_id, weapon_id) VALUES
  (1, 1),
  (2, 2);