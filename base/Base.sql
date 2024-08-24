mysql -u <utilisateur> -h<hôte> -p
			ou
mysql -u <utilisateur> 





CREATE DATABASE <nom base de donnée> ;

CREATE DATABASE GVIM ;

SHOW DATABASES ;

USE GVIM;


CREATE TABLE <Nom table> (
	identifiant INT(taille) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	attribut_01 TYPE(taille) <options>,
	attribut_02 TYPE(taille) <options>
)ENGINE = InnoDB;

CREATE TABLE Client (
	RefClt INT(6) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	Client VARCHAR(50) NOT NULL,
	Adresse VARCHAR(30) NOT NULL,
	idProvince INT(2) UNSIGNED,
	CONSTRAINT fk_Province FOREIGN KEY (idProvince) REFERENCES Province(idProvince)
)ENGINE = InnoDB;

CREATE TABLE Telephone (
	TelClt VARCHAR(30) PRIMARY KEY,
	RefClt INT(6) UNSIGNED,
	CONSTRAINT fk_Client FOREIGN KEY (RefClt) REFERENCES Client(RefClt)
)ENGINE = InnoDB;

CREATE TABLE Province (
	idProvince INT(2) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	Province CHAR(30) NOT NULL
)ENGINE = InnoDB;

DESC <Nom de la table>;
DESC Province;

CONSTRAINT <Nom de la Contrainte> 
FOREIGN KEY (Clé étrangère)
REFERENCES <table referencée> (clé primaire);

CREATE TABLE instrument (
	idInstrument INT(3) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	Instrument CHAR(30) NOT NULL
)ENGINE = InnoDB;

CREATE TABLE Modele (
	idModele INT(3) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	Modele VARCHAR(20) NOT NULL,
	Taille ENUM('Adulte', 'Enfant') NOT NULL,
	PrixUnitaire FLOAT(12,2) NOT NULL,
	idInstrument INT(3) UNSIGNED,
	CONSTRAINT fk_instrument FOREIGN KEY (idInstrument) REFERENCES instrument(idInstrument)
)ENGINE = InnoDB;

CREATE TABLE ModePaiement (
	CodeMP INT(2) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	MP CHAR(30) NOT NULL
)ENGINE = InnoDB;

CREATE TABLE Shop (
	NumShop INT(2) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	Shop CHAR(30) NOT NULL
)ENGINE = InnoDB;

CREATE TABLE Commercial (
	idCom INT(2) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	Commercial CHAR(30) NOT NULL
)ENGINE = InnoDB;

CREATE TABLE Achat (
	NumAchat INT(6) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,
	DateAchat DATE NOT NULL,
	HeureAchat TIME NOT NULL,
	CodeMP INT(2) UNSIGNED,
	idCom INT(2) UNSIGNED,
	NumShop INT(2) UNSIGNED,
	CONSTRAINT fk_MP FOREIGN KEY (CodeMP) REFERENCES ModePaiement(CodeMP),
	CONSTRAINT fk_Commercial FOREIGN KEY (idCom) REFERENCES Commercial(idCom),
	CONSTRAINT fk_Shop FOREIGN KEY (NumShop) REFERENCES Shop(NumShop)
)ENGINE = InnoDB;


CREATE TABLE Acheter (
	Quantite INT(3) NOT NULL,
	NumAchat INT(6) UNSIGNED,
	RefClt INT(6) UNSIGNED,
	idModele INT(3) UNSIGNED,
	CONSTRAINT pk_composer_Acheter PRIMARY KEY (NumAchat, RefClt, idModele),			
	CONSTRAINT fk_composer_Achat FOREIGN KEY (NumAchat) REFERENCES Achat(NumAchat),
	CONSTRAINT fk_composer_Client FOREIGN KEY (RefClt) REFERENCES Client(RefClt),
	CONSTRAINT fk_composer_Modele FOREIGN KEY (idModele) REFERENCES Modele(idModele)
)ENGINE = InnoDB;

SHOW TABLES;

CONSTRAINT <Nom de la contrainte> PRIMARY KEY (Liste des attribut) ;

SELECT * FROM <Table1> NATURAL JOIN <Table2> GROUP BY <identifiant Table1>;

SELECT * FROM Client NATURAL JOIN Province GROUP BY RefClt;


INSERT INTO <NomTable>(arribut_01,attribut_02) VALUES ('valeur_01','valeur_02');

INSERT INTO Province(idProvince, Province) VALUES (NULL,'Antananarivo');

INSERT INTO ModePaiement(CodeMP, MP) VALUES (NULL,'Chèque');

INSERT INTO Client(RefClt, Client, Adresse, idProvince) VALUES (NULL,'RANDRIA', 'VHF Ampitatafika', 1);

INSERT INTO Achat(NumAchat, DateAchat, HeureAchat, NumShop, idCom, CodeMP ) 
			VALUES (NULL,now(), CURRENT_TIME(), 1, 1, 1);

INSERT INTO Modele(idModele, Modele, Taille, PrixUnitaire, idInstrument) 
			VALUES (NULL,'Sax122', 1, 1000000, 3 );

INSERT INTO instrument(idInstrument, Instrument) 
			VALUES (NULL,'Guitare');

SELECT * FROM Modele NATURAL JOIN Instrument;


SELECT * FROM Achat NATURAL JOIN ModePaiement, Shop, Commercial 
		 WHERE (Achat.CodeMP = ModePaiement.CodeMP) AND (Achat.NumShop = Shop.NumShop) 
		 AND (Achat.idCom = Commercial.idCom);
/*Impoprtant*/
SELECT * FROM Achat NATURAL JOIN ModePaiement, Shop, Commercial 
		 WHERE (Achat.CodeMP = ModePaiement.CodeMP) AND (Achat.NumShop = Shop.NumShop) 
		 AND (Achat.idCom = Commercial.idCom);

SELECT NumAchat, Achat.DateAchat, Achat.HeureAchat,Shop.Shop, ModePaiement.CodeMP, Commercial.Commercial
		 FROM Achat,Shop,ModePaiement,Commercial NATURAL JOIN ModePaiement, Shop, Commercial 
		 WHERE (Achat.CodeMP = ModePaiement.CodeMP) AND (Achat.NumShop = Shop.NumShop) 
		 AND (Achat.idCom = Commercial.idCom);

SELECT <Listes des colonnes> FROM <listes des tables> WHERE <Conditions> ;

/*Acheter*/

INSERT INTO Acheter(NumAchat, RefClt, idModele, Quantite) VALUES (1, 1, 1, 2);

/*Plus imp*/
SELECT Acheter.NumAchat, Client.Client, Modele.Modele,Modele.PrixUnitaire, Acheter.Quantite ,
	   AVG(PrixUnitaire*Quantite) AS 'Montant' FROM Acheter 
	   NATURAL JOIN Achat, Client, Modele, ModePaiement, Shop, Commercial 
	   WHERE (Acheter.NumAchat = Achat.NumAchat) AND (Acheter.RefClt = Client.RefClt) 
	   AND (Acheter.idModele = Modele.idModele) AND (Achat.CodeMP = ModePaiement.CodeMP) 
	   AND (Achat.NumShop = Shop.NumShop) AND (Achat.idCom = Commercial.idCom);


UPDATE <Nom de la table> SET <la Colonne> = <NouvelleValeur> WHERE <condition> ;

UPDATE Telephone SET TelClt = '0394563326' WHERE RefClt = 1 ;

DELETE FROM <NomTable> WHERE <condition>;

DELETE FROM Commercial WHERE idCom = 7;

CREATE VIEW <Nom de la View> AS <Requête>;

CREATE VIEW ViewMonAchat AS 
	   SELECT Acheter.NumAchat, Client.Client, Modele.Modele,Modele.PrixUnitaire, Acheter.Quantite ,
	   AVG(PrixUnitaire*Quantite) AS 'Montant' FROM Acheter 
	   NATURAL JOIN Achat, Client, Modele, ModePaiement, Shop, Commercial 
	   WHERE (Acheter.NumAchat = Achat.NumAchat) AND (Acheter.RefClt = Client.RefClt) 
	   AND (Acheter.idModele = Modele.idModele) AND (Achat.CodeMP = ModePaiement.CodeMP) 
	   AND (Achat.NumShop = Shop.NumShop) AND (Achat.idCom = Commercial.idCom);

CREATE VIEW modeleviewako AS SELECT idModele, Modele.Modele, Modele.Taille, Modele.PrixUnitaire, 
	instrument.instrument FROM Modele NATURAL JOIN instrument;  

DROP VIEW ViewMonAchat; 





