
DROP TABLE IF EXISTS personnage CASCADE;
DROP TABLE IF EXISTS série CASCADE;
DROP TABLE IF EXISTS client CASCADE;
DROP TABLE IF EXISTS joue CASCADE;
DROP TABLE IF EXISTS choix CASCADE;
DROP TABLE IF EXISTS personne CASCADE;
DROP TABLE IF EXISTS vidéo CASCADE;
DROP TABLE IF EXISTS note CASCADE;
DROP TABLE IF EXISTS profil CASCADE;
DROP TABLE IF EXISTS appartient CASCADE;
DROP TABLE IF EXISTS visionnage CASCADE;
DROP TABLE IF EXISTS label CASCADE;



--
-- Create table personnage
--
--PERSONNAGE ( id_personnage, description ) 

CREATE TABLE personnage(
    id_personnage integer primary key,
    descriptions  text 
);

--
-- Create table SERIE
--
--SÉRIE ( Id_série, titre, saison )

CREATE TABLE série (
    id_serie integer primary key,
    titre varchar(50),
    episode varchar(50)
);

--
-- Create table Client
--
--CLIENT ( Id client, nom, prénom, courriel, abonnement, date de fin d'abonnement, adresse )

CREATE TABLE client(
    id_client integer primary key,
    nom varchar(25) not NULL,
    prenom varchar(25) not null,
    courriel varchar(50) UNIQUE not null,
    adresse varchar(100) not NULL,
    abonnement varchar(25) not null,
    date_de_fin_abonnement date not NULL

);



--
-- Create table vidéo
--
--VIDÉO ( Id vidéo, durée, titre, année de production, Id série, numéros saison, numéros épisode )

CREATE TABLE vidéo(
    id_video integer PRIMARY KEY,
    Lien_vidéo varchar(50),
    titre varchar (50) ,
    durée time not null,
    année_prod date not null,
    id_serie integer,
    numero_saison int,
    numero_episode int,
    
    FOREIGN KEY (id_serie) REFERENCES série(id_serie)
    

);

--
-- Create table personne
--
--PERSONNE ( Id perso, nom, prénom, Id vidéo )

CREATE TABLE personne(
    id_perso integer PRIMARY KEY,
    nom varchar(25) not null,
    prenom varchar(25) not null,
    id_video integer,
    
    FOREIGN KEY (id_video) REFERENCES vidéo(id_video)
);

--
-- Create table joue
--
-- JOUE ( Id vidéo, id personnage, Id perso )
CREATE TABLE joue(
    id_video integer,
    id_personnage integer,
    id_perso integer,
    
    
    FOREIGN KEY (id_video) REFERENCES vidéo(id_video),
    FOREIGN KEY (id_personnage) REFERENCES personnage(id_personnage),
    FOREIGN KEY (id_perso) REFERENCES personne(id_perso)
);

CREATE TABLE label(
    id_label varchar(25) PRIMARY KEY
);

--
-- Create table profil
--
--PROFIL ( Id profil, nom, prénom, Id client )

CREATE TABLE profil(
    id_profil integer PRIMARY KEY,
    nom varchar(25) not null,
    prenom varchar (25) ,
    id_client integer,
  
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);

--
-- Create table choix
--
--CHOIX ( Id vidéo, Id label, Id profile )

CREATE TABLE choix(
    id_video integer,
    id_label varchar(25),
    id_profil integer,
   
    FOREIGN KEY (id_video) REFERENCES vidéo(id_video),
    FOREIGN KEY (id_label) REFERENCES label(id_label),
    FOREIGN KEY (id_profil) REFERENCES profil(id_profil)
);






--
-- Create table note
--
--NOTE ( Id profil, Id vidéo )

CREATE TABLE note(
    id_profil integer,
    id_video integer,
    notation INTEGER not NULL check ( notation between 0 and 5),
   
    FOREIGN KEY (id_profil) REFERENCES profil(id_profil),
    FOREIGN KEY (id_video) REFERENCES vidéo(id_video)
    
);

--
-- Create table visionnage
--
-- VISIONNAGE ( Id visio, durée, Id profil )
CREATE TABLE visionnage(
    id_visio integer PRIMARY KEY,
    durée integer,
    id_profil integer,
 
    FOREIGN KEY (id_profil) REFERENCES profil(id_profil)
);



--
-- Create table appartient
--
--APPARTIENT ( Id vidéo, Id visio )

CREATE TABLE appartient(
    id_video integer,
    id_visio integer,

    FOREIGN KEY (id_video) REFERENCES vidéo(id_video),
    FOREIGN KEY (id_visio) REFERENCES visionnage(id_visio)
    
);

CREATE VIEW CLASSEMENT AS(
    select titre , sum (notation)/count(notation) as moyenne from note natural join vidéo 
    group by titre
    order by moyenne desc
);





--
-- Data for Name: client
--
INSERT INTO client (id_client,nom,prenom,courriel,adresse,abonnement,date_de_fin_abonnement) VALUES (0, 'Chevalier', 'Robert','robert@hotmail.fr','28 avenue François mauriac ,75001 Paris','p','2025-01-03');
INSERT INTO client (id_client,nom,prenom,courriel,adresse,abonnement,date_de_fin_abonnement) VALUES (1, 'Dupoint', 'Charle','Charle@hotmail.fr','15 rue de jean mermoz ,75000 Paris','n','2025-01-17');
INSERT INTO client (id_client,nom,prenom,courriel,adresse,abonnement,date_de_fin_abonnement) VALUES (2, 'Bureau', 'Martin','Martin@hotmail.fr','67 bis villebois mareuil ,75001 Paris','p','2025-11-07');


--
-- Data for Name: video
--
INSERT INTO vidéo (id_video,Lien_vidéo,titre,durée,année_prod) VALUES ( 1,'oZ6iiRrz1SY', 'Morbius','00:03:19','2021-11-02');
INSERT INTO vidéo (id_video,Lien_vidéo,titre,durée,année_prod) VALUES ( 2,'0rSig8FZevA', 'Venom','00:04:08','2018-04-24');
INSERT INTO vidéo (id_video,Lien_vidéo,titre,durée,année_prod) VALUES ( 3, 'Pj_uJvUatnU','Venom_2','00:02:42','2021-08-02');
INSERT INTO vidéo (id_video,Lien_vidéo,titre,durée,année_prod)VALUES (7,'syls11oEoJY','Enola_Holmes','00:2:53','25-08-2020');
INSERT INTO vidéo (id_video,Lien_vidéo,titre,durée,année_prod )VALUES (8,'rqRQzzQnixM','RED_NOTICE','00:3:07','21-10-2021');
INSERT INTO vidéo (id_video,Lien_vidéo,titre,durée,année_prod )VALUES (9,'T6DJcgm3wNY','Man_of-Steel','00:3:02','17-04-2013');
INSERT INTO vidéo (id_video,Lien_vidéo,titre,durée,année_prod )VALUES (10,'tiy7peMH3g8','Le_Hobbit','00:2:20','5-04-202');
INSERT INTO vidéo (id_video,Lien_vidéo,titre,durée,année_prod )VALUES (11,'OTEGxxMTnPU','PIRATES_DES_CARAÏBES_5','00:4:35','3-03-2017');

--
-- Data for Name: Serie
--
INSERT INTO série (id_serie,titre,episode) VALUES (1, 'Blindspot', 'le mystère de la peau');
INSERT INTO vidéo (id_video,durée , année_prod,id_serie,numero_saison,numero_episode) VALUES (4,'00:01:00','2015-09-21',1,1,1);
INSERT INTO série (id_serie, titre, episode)VALUES (2,'Blindspot','Mission secrète');
INSERT INTO vidéo (id_video,durée , année_prod,id_serie,numero_saison,numero_episode) VALUES (5,'00:00:46','2015-09-21',2,1,2);
INSERT INTO série (id_serie, titre, episode)VALUES (3,'Blindspot','Une pièce du puzzle');
INSERT INTO vidéo (id_video,durée , année_prod,id_serie,numero_saison,numero_episode) VALUES (6,'00:00:43','2015-09-21',3,1,3);

--
--Data for Name: profile
--
INSERT INTO profil (id_profil, nom, prenom, id_client)VALUES (0,'joseph','kévin',0);
INSERT INTO profil (id_profil, nom, prenom, id_client)VALUES (1,'joe','zaz',1);
INSERT INTO profil (id_profil, nom, prenom, id_client)VALUES (2,'kishor','prashath',2);

--
--Data for name : visionnage
--
INSERT INTO visionnage (id_visio, durée, id_profil)VALUES (0,60,0);
INSERT INTO visionnage (id_visio, durée, id_profil)VALUES (1,30,1);
INSERT INTO visionnage (id_visio, durée, id_profil)VALUES (2,120,2 );
--Morbius,blindspot saison1 episode 1 , venom2

--
--Data for name : personne
--
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (1,'Pellington','Mark',4);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (2,'Hardy','Tom',2);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (3,'Hardy','Tom',3);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (4,'Leto','Jared',1);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (5,'Fleischer','Ruben',2);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (6,'Millie','Bobby Brown',7);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (7,'Henry','Cavill',7);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (8,'Dwayne','Johnson',8);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (9,'Gal','Gadot',8);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (10,'Ryan','Reynolds',8);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (11,'Henry','Cavill',9);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (12,'Martin','Freeman',10);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (13,'Ian ','McKellen',10);
INSERT INTO personne (id_perso, nom, prenom, id_video)VALUES (14,' Johnny ','Depp',11);

--
--Data for name : personnage
--
INSERT INTO personnage (id_personnage, descriptions)
VALUES ( 1,'Morbius qui est un personnage de marvel et qui est un vampire et qui est le personnage centrale du film.' );
INSERT INTO personnage (id_personnage, descriptions)VALUES (2,'Venom qui est un personnage de marvel qui est souvent l antagoniste de spider-man .');
INSERT INTO personnage (id_personnage, descriptions)VALUES (3,'Venom qui est un personnage de marvel qui est souvent l antagoniste de spider-man .');
INSERT INTO personnage (id_personnage, descriptions)VALUES (4,'Enola holmes qui va essayé de retrouver sa mère et nous allons la suivre tout le long du film en quete de sa mère');
INSERT INTO personnage (id_personnage, descriptions)VALUES (5,'Sherlock Holmes qui est le frère de Henola Holmes et qui va aider Henola dans sa quete ');
INSERT INTO personnage (id_personnage, descriptions)VALUES (6,'John Hartley qui est un profiler du FBI et qui traque un voleur .');
INSERT INTO personnage (id_personnage, descriptions)VALUES (7,' Sarah Black qui est une voleuse d’art, peut-être encore meilleure que Booth.  .');
INSERT INTO personnage (id_personnage, descriptions)VALUES (8,' Nolan Booth qui est un voleur d’art sarcastique. Ce beau parleur laisse souvent tomber les références à d’autres films alors qu’il vole l’art sous le nez de Hartley.');
INSERT INTO personnage (id_personnage, descriptions)VALUES (9,'Superman qui est un héros de DC comics  .');
INSERT INTO personnage (id_personnage, descriptions)VALUES (10,'Bilbon qui est un hobbit et nous allons suivre son aventure avec ses compagnons .');
INSERT INTO personnage (id_personnage, descriptions)VALUES (11,'Gandalf qui est un sorcier et qui va aider Bilbon dans sa quête.');
INSERT INTO personnage (id_personnage, descriptions)VALUES (12,'Jack Sparrow qui est un pirate fou et qui est chassé par des fantomes de son passé.');


--
--Date for name: label
--
INSERT INTO label (id_label)VALUES ('Action');
INSERT INTO label (id_label)VALUES ('Aventure');
INSERT INTO label (id_label)VALUES ('Comédie');
INSERT INTO label (id_label)VALUES ('Dramatique');


--
--Date for name: joue
--
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (2,2,2);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (3,2,3);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (1,1,4);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (7,4,6);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (7,5,7);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (8,6,8);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (8,7,9);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (8,8,10);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (9,9,11);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (10,10,12);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (10,11,13);
INSERT INTO joue (id_video, id_personnage, id_perso)VALUES (11,12,14);

--
--Date for name: choix
--
iNSERT INTO choix (id_video, id_label, id_profil)VALUES (1,'Action',1);
INSERT INTO choix (id_video, id_label, id_profil)VALUES (2,'Action',2);
INSERT INTO choix (id_video, id_label, id_profil)VALUES (6,'Aventure',0);

--
--Date for name: appartient
--
INSERT INTO appartient (id_video, id_visio)VALUES (1,0);
INSERT INTO appartient (id_video, id_visio)VALUES (4,1);
INSERT INTO appartient (id_video, id_visio)VALUES (3,2);

--
--Date for name: note
--
INSERT INTO note (id_profil, id_video, notation)VALUES (0,1,3);
INSERT INTO note (id_profil, id_video,notation)VALUES (0,2,0);
INSERT INTO note (id_profil, id_video,notation)VALUES (0,3,3);
INSERT INTO note (id_profil, id_video,notation)VALUES (1,1,5);
INSERT INTO note (id_profil, id_video,notation)VALUES (2,7,4);
INSERT INTO note (id_profil, id_video,notation)VALUES (2,8,3);
INSERT INTO note (id_profil, id_video,notation)VALUES (1,3,1);



























