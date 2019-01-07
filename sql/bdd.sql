-- Exported from QuickDBD: https://www.quickdatatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/LjOE2v
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `Administrateur` (
    `Nom_admin` VARCHAR(255)  NOT NULL ,
    `Prenom_admin` VARCHAR(255)  NOT NULL ,
    `Email_login_admin` VARCHAR(255)  NOT NULL ,
    `Password_admin` VARCHAR(255)  NOT NULL 
);

CREATE TABLE `Client` (
    `Id_client` int  NOT NULL ,
    -- particulier, professionnel, association
    `Type_client` ENUM  NOT NULL ,
    `Nom_client` VARCHAR(255)  NOT NULL ,
    `Prenom_client` VARCHAR(255)  NOT NULL ,
    `Date_naissance` DATE  NOT NULL ,
    `Adresse_client` VARCHAR(255)  NOT NULL ,
    `Code_postal_client` CHAR(5)  NOT NULL ,
    `Ville_client` VARCHAR(255)  NOT NULL ,
    `Email_login_client` VARCHAR(255)  NOT NULL ,
    `Password_client` INT(6)  NOT NULL ,
    `Telephone_client` INT(10)  NOT NULL ,
    `Id_agence` INT  NOT NULL ,
    `Num_compte` INT  NOT NULL ,
    `IBAN` INT(27)  NOT NULL ,
    PRIMARY KEY (
        `Id_client`
    )
);

CREATE TABLE `Comptes` (
    `Num_compte` int  NOT NULL ,
    `Solde_compte` DECIMAL  NOT NULL ,
    -- SI courant
    `Decouvert` BOOL  NOT NULL ,
    -- SI épargne
    `Taux` NUMERIC  NOT NULL ,
    -- epargne, courant
    `Type_compte` BOOL  NOT NULL ,
    `Id_client` int  NOT NULL 
);

CREATE TABLE `Agence` (
    `Nom_agence` VARCHAR  NOT NULL ,
    `Code_postal_agence` INT(5)  NOT NULL ,
    `Code_banque` INT  NOT NULL ,
    `Code_agence` INT  NOT NULL ,
    `Code_guichet` INT  NOT NULL ,
    `Num_compte_courant` INT  NOT NULL ,
    `Clé_RIB` INT(2)  NOT NULL ,
    `IBAN` INT(27)  NOT NULL 
);

CREATE TABLE `Operations` (
    `Id_operation` AUTO_increment  NOT NULL ,
    `Num_compte_debit` int  NOT NULL ,
    `Num_compte_credit` int  NOT NULL ,
    -- virement, CB, chèque, prélèvement
    `Type_operation` ENUM  NOT NULL ,
    `Date_operation` DATE  NOT NULL ,
    `Montant_operation` DECIMAL  NOT NULL 
);

CREATE TABLE `Carte_Bancaire` (
    `Id_cb` int  NOT NULL ,
    `Num_compte` int  NOT NULL ,
    `DateDebutValidite` date  NOT NULL ,
    `DateFinValidite` date  NOT NULL ,
    `Active` boolean  NOT NULL ,
    `Code_cb` INT  NOT NULL ,
    `Crypto_cb` INT  NOT NULL ,
    `Raison_sociale_cb` INT  NOT NULL ,
    PRIMARY KEY (
        `Id_cb`
    )
);

CREATE TABLE `Chequier` (
    `Id_Chequier` int  NOT NULL ,
    `Num_Compte` int  NOT NULL ,
    `DateDebutValidite` date  NOT NULL ,
    `DateFinValidite` date  NOT NULL ,
    PRIMARY KEY (
        `Id_Chequier`
    )
);

CREATE TABLE `Beneficiaires` (
    `Id_beneficiaire` int  NOT NULL ,
    `Raison_sociale` VARCHAR  NOT NULL ,
    `IBAN_beneficiaire` INT(27)  NOT NULL ,
    `Num_compte_beneficiaire` int  NOT NULL 
);

ALTER TABLE `Client` ADD CONSTRAINT `fk_Client_Code_postal_client` FOREIGN KEY(`Code_postal_client`)
REFERENCES `Agence` (`Code_postal_agence`);

ALTER TABLE `Comptes` ADD CONSTRAINT `fk_Comptes_Num_compte` FOREIGN KEY(`Num_compte`)
REFERENCES `Chequier` (`Num_Compte`);

ALTER TABLE `Comptes` ADD CONSTRAINT `fk_Comptes_Id_client` FOREIGN KEY(`Id_client`)
REFERENCES `Client` (`Id_client`);

ALTER TABLE `Operations` ADD CONSTRAINT `fk_Operations_Num_compte_debit` FOREIGN KEY(`Num_compte_debit`)
REFERENCES `Comptes` (`Num_compte`);

ALTER TABLE `Carte_Bancaire` ADD CONSTRAINT `fk_Carte_Bancaire_Num_compte` FOREIGN KEY(`Num_compte`)
REFERENCES `Comptes` (`Num_compte`);

ALTER TABLE `Beneficiaires` ADD CONSTRAINT `fk_Beneficiaires_Num_compte_beneficiaire` FOREIGN KEY(`Num_compte_beneficiaire`)
REFERENCES `Operations` (`Num_compte_credit`);

