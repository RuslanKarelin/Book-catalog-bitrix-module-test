CREATE TABLE `authors` (
    `ID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `FIO` VARCHAR(255) NOT NULL,
    `COUNTRY` VARCHAR(255) DEFAULT NULL,
    `CREATED` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID),
    UNIQUE KEY IX_AUTHORS (`FIO`)
);

CREATE TABLE `books` (
    `ID` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `TITLE` VARCHAR(255) NOT NULL,
    `DESCRIPTION` VARCHAR(255) DEFAULT NULL,
    `FILES` JSON DEFAULT NULL,
    `YEAR` INT(11) UNSIGNED DEFAULT NULL,
    `PRICE` INT(11) UNSIGNED DEFAULT NULL,
    `AUTHOR_ID` INT(11) UNSIGNED DEFAULT NULL,
    `CREATED` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID),
    INDEX IX_BOOKS_AUTHOR_ID (AUTHOR_ID),
    FOREIGN KEY (AUTHOR_ID)  REFERENCES authors (ID) ON DELETE CASCADE
);

INSERT INTO `authors` (`FIO`, `COUNTRY`, `CREATED`) VALUES ('Hans Christian Andersen', 'Denmark', now());
INSERT INTO `authors` (`FIO`, `COUNTRY`, `CREATED`) VALUES ('Dante Alighieri', 'Italian', now());
INSERT INTO `authors` (`FIO`, `COUNTRY`, `CREATED`) VALUES ('Jane Austen', 'United Kingdom', now());
INSERT INTO `authors` (`FIO`, `COUNTRY`, `CREATED`) VALUES ('Samuel Beckett', 'Republic of Ireland', now());
INSERT INTO `authors` (`FIO`, `COUNTRY`, `CREATED`) VALUES ('Anton Chekhov', 'Russia', now());

INSERT INTO `books` (`TITLE`, `DESCRIPTION`, `FILES`, `YEAR`, `PRICE`, `AUTHOR_ID`, `CREATED`)
VALUES ('Fairy tales', 'Fairy Tales Told for Children. New Collection. First Booklet (Eventyr, fortalte for Børn. Ny Samling. Første Hefte) is the first installment. Was published on 2 October 1838.', NULL, '1836', '1500', '1', now());
INSERT INTO `books` (`TITLE`, `DESCRIPTION`, `FILES`, `YEAR`, `PRICE`, `AUTHOR_ID`, `CREATED`)
VALUES ('The Divine Comedy', 'The Divine Comedy is composed of 14,233 lines that are divided into three cantiche (singular cantica) – Inferno (Hell), Purgatorio (Purgatory), and Paradiso (Paradise) – each consisting of 33 cantos (Italian plural canti).', NULL, '1315', '2000', '2', now());