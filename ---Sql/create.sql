-- Schema
CREATE SCHEMA `moment4_vt23` ;
USE moment4_vt23;

-- Tables
CREATE TABLE user  (
    id          int         not null auto_increment,
    username    varchar(30), 
    password    char(32),
    PRIMARY KEY (id)
);

CREATE TABLE news  (
    id          int         not null auto_increment,
    title       varchar(30), 
    content     text,
    post_date   int,
    created_by  int,
    PRIMARY KEY (id)
);

-- Constraints
ALTER TABLE news
   ADD CONSTRAINT FK_news_user FOREIGN KEY (created_by)
      REFERENCES user (id);


-- Inserts

-- Inserts INTO table user 
INSERT INTO user (username, password) VALUES ('User1', 'a51a0cac0ce374a853d2359417debc28'); -- kaffe

-- Inserts INTO table news 
INSERT INTO news (title, content, post_date, created_by) VALUES ('Test', 'Vi testar så det funkar', 1685290927,1);

INSERT INTO news (title, content, post_date, created_by) VALUES ('Råttor och utställningar', '        Varje år hålls ett antal olika utställningar för råttor runt om i landet.
         Dom hålls oftast av SRS (svenska råttsällskapet) och SSV (sydsveriges smådjursvänner). 
        När man registrerar sig för en utställning så kan man välja att registrera råttan i både utställningsklassen och i agility. 
        Agility hålls på de allra flesta utställningar och brukar vara en uppskattad gren under utställningarna. 
        Innan man får komma in på en utställning så måste varje djur genomgå en hälsokontroll. Detta sker vid ingången och 
        det finns då en kontrollant som går igenom råttans skick. Man letar efter främst efter ohyra sår och sjukdomstecken. 
        Om en råtta inte passerar kontrollen får ofta den och de som suttit i samma bur sitta i karantänrum tills utställningen är slut och får inte delta 
        När man är klar med kontrollen går man in på utställningsområdet. Där finns en dommare och en sekreterare. 
        Dommaren kommer i tur och ordning att bedömma djuren. 
        Man kan vinna massa olika sortes priser bl.a best in show, bäst i motsatt kön, 1a pris, 2 pris, hederspris med flera.   
', 1685290927,1);

INSERT INTO news (title, content, post_date, created_by) VALUES ('Färggenetik', '        Färggenetik skiljer sig från art till art. </br>
        Något som de flesta djurarter har gemensamt är dock att dom har en ursprungsfärg. Denna kallas ofta för agouti eller viltfärgad. </br>
        Agoitifärgade djur har ofta vad man brukar kalla för viltzoner, vilket är zoner på kroppen som är 
        ljusare än övriga kroppen. Oftast tillhör magen en av dessa </br>
        En av de mest grundläggande mutationerne som vi brukar se ho de flesta arter är svart. Svart är en mutation rakt från agouti. När man 
        pratar om färger skulle man kunna säga att svart är agoutins motpart. </br>
        Alla andra färger som kommer sedan utgår i regel från dessa 2. Ett gult djur är oftast en svart med mutation som ger en gul färg. En viltgul är en agouti med mutation som ger gul till agoutin 
', 1685290927,1);

