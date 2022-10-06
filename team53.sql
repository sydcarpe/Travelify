/*CREATE Tables*/
/*User Table*/
CREATE TABLE User_Table(
user_ID INT(11) NOT NULL AUTO_INCREMENT,
name VARCHAR(50) NOT NULL, 
email VARCHAR(30),
profile_image text NOT NULL,
google_id varchar(255) NOT NULL,
f_name VARCHAR (255),
l_name VARCHAR (255),
phone_number VARCHAR (25),
bio VARCHAR (255),
PRIMARY KEY (user_id),
UNIQUE KEY email (email)
) ENGINE = innodb;

/*Group Table*/
CREATE TABLE Group_Table(
group_ID INT,
user_ID INT,
group_date DATE,
num_people INT,
FOREIGN KEY (user_ID) REFERENCES User_Table(user_ID)
) ENGINE = innodb;

/*Trip Table*/
CREATE TABLE Trip(
trip_ID INT AUTO_INCREMENT,
group_ID INT,
location VARCHAR(255),
arrival_date DATE,
depart_date DATE,
PRIMARY KEY (trip_ID)
) ENGINE = innodb;

/*Itinerary Table*/
CREATE TABLE Itinerary(
itinerary_ID INT,
trip_ID INT,
attraction_ID INT,
user_ID INT,
group_ID INT,
start_date DATE,
end_date DATE,
trip_location VARCHAR(255),
attraction_order INT (11),
FOREIGN KEY (user_ID) REFERENCES User_Table(user_ID),
FOREIGN KEY (trip_ID) REFERENCES Trip(trip_ID),
FOREIGN KEY (attraction_ID) REFERENCES attractions(attractions_id)
) ENGINE = innodb;

/*Blog Table*/
CREATE TABLE Travel_Blog (
id int(11) NOT NULL AUTO_INCREMENT,
user_ID int(11) NOT NULL,
Blog_Name varchar(55) NOT NULL DEFAULT '',    
Blog_Description varchar(255) NOT NULL DEFAULT '',
Trip_Date date NOT NULL DEFAULT '0000/00/00',
Blog_Image varchar(255) NOT NULL DEFAULT 'default_blog_image.jpg',
PRIMARY KEY (id),
FOREIGN KEY (user_ID) REFERENCES User_Table(user_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE category (
  category_id int(11) NOT NULL AUTO_INCREMENT,
  user_ID int(11) NOT NULL,
  category_name varchar(55) NOT NULL,
  FOREIGN KEY(user_ID) REFERENCES User_Table(user_ID),
  PRIMARY KEY(category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 

CREATE TABLE post ( 
  post_id int(11) NOT NULL AUTO_INCREMENT,
  user_ID int(11) NOT NULL,
  post_title varchar(55) NOT NULL,
  post_content longtext NOT NULL DEFAULT 'Blog Post',
  post_category int(11) NOT NULL,
  post_date varchar(255) NOT NULL,
  post_keyword varchar(255) NOT NULL DEFAULT 'post_keyword',
  post_image varchar(255) NOT NULL DEFAULT 'uploads/blog_default_img.jpg',
  FOREIGN KEY(user_ID) REFERENCES User_Table(user_ID),
  FOREIGN KEY(post_category) REFERENCES category(category_id),
  PRIMARY KEY(post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Packing list still all here*/
CREATE TABLE PackingList(
list_ID int(11) NOT NULL AUTO_INCREMENT,
trip_ID int(11),
user_ID int(11),
createdDate DATE,
list_name varchar(255),
favorite int(11),
PRIMARY KEY (list_ID),
FOREIGN KEY (trip_ID) REFERENCES Trip (trip_ID),
FOREIGN KEY (user_ID) REFERENCES User_Table(user_ID)
) ENGINE = innodb;

CREATE TABLE PackingItems(
item_ID int(11) NOT NULL AUTO_INCREMENT,
item_name varchar(255),
list_ID int(11),
packed int(2),
PRIMARY KEY (item_ID),
FOREIGN KEY (list_ID) REFERENCES PackingList(list_ID)
) ENGINE = innodb;

CREATE TABLE contact_us (
  contact_id int(11) NOT NULL AUTO_INCREMENT,
  user_ID int(11) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  phone varchar(50) NOT NULL DEFAULT '',
  subject varchar(255) NOT NULL,
  message longtext NOT NULL,
  sent_date datetime NOT NULL,
  FOREIGN KEY(user_ID) REFERENCES User_Table(user_ID),
  PRIMARY KEY (contact_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE attractions (
    attractions_id int(11) NOT NULL AUTO_INCREMENT,
    user_ID int(11) NOT NULL,
    category_id int(11) NOT NULL,
    attraction_name varchar(55) NOT NULL,
    attraction_country int(5) NOT NULL,
    attraction_city varchar(100) NOT NULL,
    attraction_description longtext NOT NULL,
    attraction_image varchar(255) NOT NULL DEFAULT 'uploads/default_attraction_image.jpg',
    PRIMARY KEY(attractions_id),
    FOREIGN KEY(user_ID) REFERENCES User_Table(user_ID),
    FOREIGN KEY(category_id) REFERENCES attraction_category(cat_id),
    FOREIGN KEY(attraction_country) REFERENCES countries(country_id)
)   ENGINE = innodb DEFAULT CHARSET = utf8;

CREATE TABLE attraction_category (
    cat_id int(11) NOT NULL AUTO_INCREMENT,
    cat_name varchar(100) NOT NULL,
    PRIMARY KEY(cat_id)
)   ENGINE = innodb DEFAULT CHARSET = utf8;

CREATE TABLE reviews (
    review_id int(11) NOT NULL AUTO_INCREMENT,
    review_attraction_id int(11) NOT NULL,
    user_ID int(11) NOT NULL,
    review_rating int(11) NOT NULL,
    review_content varchar(255) NOT NULL,
    PRIMARY KEY(review_id),
    FOREIGN KEY(review_attraction_id) REFERENCES attractions(attractions_id),
    FOREIGN KEY(user_ID) REFERENCES User_Table(user_ID)
)   ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Calendar(
id int(11) NOT NULL AUTO_INCREMENT,
trip_ID int(11),
PRIMARY KEY (id),
FOREIGN KEY (trip_ID) REFERENCES Trip(trip_ID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE CalendarEvents(
id INT (11) NOT NULL AUTO_INCREMENT,
title VARCHAR(255),
start_event DATETIME,
end_event DATETIME,
calendar_id INT(11),
FOREIGN KEY(calendar_id) REFERENCES Calendar(id),
PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE countries( 
country_id int(11) NOT NULL auto_increment,
country_name varchar(100) NOT NULL default '',
PRIMARY KEY (country_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* International Recommended Destinations for User Survey,
categories = nature, nightlife, culture & beach*/
create table int_places ( 
  int_place_id int(11) not null auto_increment,
  int_culture varchar(100) not null,
  int_fam_nightlife varchar(100) not null,
  int_friends_nightlife varchar(100) not null,
  int_partner_nightlife varchar(100) not null,
  int_friends_nature varchar(100) not null,
  int_fam_nature varchar(100) not null,
  int_partner_nature varchar(100) not null,
  int_solo_nature varchar(100) not null,
  int_friends_beach varchar(100) not null,
  int_fam_beach varchar(100) not null,
  int_partner_beach varchar(100) not null,
  img_culture varchar(100) not null,
  famNightlife_img varchar(100) not null,
  friendsNightlife_img varchar(100) not null,
  partnerNightlife_img varchar(100) not null,
  friendsNature_img varchar(100) not null,
  famNature_img varchar(100) not null,
  partnerNature_img varchar(100) not null,
  soloNature_img varchar(100) not null,
  friendsBeach_img varchar(100) not null,
  famBeach_img varchar(100) not null,
  partnerBeach_img varchar(100) not null,
  primary key(int_place_id)
) ENGINE = innodb default charset = utf8;

/* United States Recommended Destinations for User Survey.
categories = nature, nightlife, culture & beach*/
create table us_places (
  us_place_id int(11) not null auto_increment,
  int_placeID int(11) not null,
  us_culture varchar(100) not null,
  us_fam_nightlife varchar(100) not null,
  us_friends_nightlife varchar(100) not null,
  us_friends_nature varchar(100) not null,
  us_partner_nature varchar(100) not null,
  us_friends_beach varchar(100) not null,
  us_fam_beach varchar(100) not null,
  us_partner_beach varchar(100) not null,
  img_culture varchar(100) not null,
  us_famNight_img varchar(100) not null,
  us_friendNight_img varchar(100) not null,
  us_friendNature_img varchar(100) not null,
  us_partnerNature_img varchar(100) not null,
  us_friendBeach_img varchar(100) not null,
  us_famBeach_img varchar(100) not null,
  us_partnerBeach_img varchar(100) not null,
  primary key(us_place_id),
  foreign key(int_placeID) references int_places(int_place_id)
) ENGINE = innodb default charset = utf8;

create table user_feedback (
  feedback_id int(11) not null auto_increment,
  user_ID int(11) not null,
  name varchar(55) not null,
  email varchar(55) not null,
  suggestions longtext not null default '',
  improvements longtext not null default '',
  favorite_part varchar(255) not null default '',
  primary key(feedback_id),
  foreign key(user_ID) references User_Table(user_ID)
) ENGINE = innodb default charset = utf8;

/*INSERT Tables*/
INSERT INTO User_Table(user_id, name, email,f_name,l_name, profile_image)
VALUES (1, 'Edita Hussey', 'whussey0@abc.net.au','Edita','Hussey', 'www.googleimage.com');
(2, 'Adore Blucher', 'ablucher1@mozilla.org','Adore','Blucher', 'www.googleimage2.com'),
(3, 'Benedetto Kairns', 'ikairns2@google.de','Benedetto','Kairns', 'www.googleimage3.com'),
(4, 'Donella Stiegars', 'cstiegars3@narod.ru','Donella','Stiegars', 'www.googleimage4.com'),
(5, 'Martainn Grenville', 'hgrenville4@sohu.com','Martainn','Grenville', 'www.googleimage5.com');

INSERT INTO Group_Table(group_ID, user_id, group_date)
VALUES (1, 16, '2022-02-08'),
(1, 18, '2022-02-08');


INSERT INTO Trip(trip_ID, group_ID, location, arrival_date, depart_date)
VALUES(1, 1, "Italy",  "2022-10-01","2022-10-21");

INSERT INTO Itinerary(itinerary_ID, trip_ID, attraction_ID, user_id, start_date, end_date, trip_location, group_ID)
VALUES(1, 1, 1, 1, "2022-10-01","2022-10-21", "Italy", 1);
/*(2, 2, 3, 5, "2021-12-15","2021-12-25", "Croatia", 2);*/

INSERT INTO Travel_Blog(id,user_ID,Blog_Name,Blog_Description,Trip_Date,Blog_Image) VALUES
(1,6,"Spring Break", "Italy was amazing!", "2009-10-09","uploads/italy.jpg"),
(2,6,"Road Trip", "Mountains with my bestie in Montana!", "2020-11-20","uploads/montana.jpg"),
(3,21,"Honeymoon", "Honeymoon to the Maldives with my Husband!", "2013-01-04","uploads/maldives.jpg");

INSERT INTO contact_us(user_ID, name, email, phone, subject, message, sent_date) VALUES 
(1,'Edita Hussey','whussey0@abc.net.au','546-346-5224','Blog Issues','The blog is not saving or uploading my images.','22/01/02 01:00:44');

INSERT INTO post(user_ID, post_title, post_content, post_category, post_date, post_keyword, post_image) VALUES
(24, 'Madison, Wisconsin w/ Em', 3, '16/01/22', 'madison wisconsin em', 'uploads/madison.jpg'),
(1, 'Hiking on Mount Everest', 4, '10/11/01', 'mount everest', 'uploads/everest.jpg'),
(5,'It Stayed in Vegas', 12, '01/03/13', 'las vegas boys', 'uploads/vegas.jpg'),
(11, 'Fort Laudy for Senior Year', 1, '22/09/09', 'fort lauderdale laudy girls', 'uploads/laudy.jpg'); 

INSERT INTO category(user_ID, category_name) VALUES
(1,'Spring Break'),
(24,'Honeymoon'),
(11,'Girls Trip'),
(3,'Road Trip'),
(5,'Summer 2016'),
(23,'Music Festivals'),
(24,'Barcelona Study Abroad'),
(15,'Italy Trip'),
(24,'Mission Trip - Haiti'),
(23,'Adventure'),
(11,'Hawaii'),
(15,'Summer with the Guys');

insert into attractions (user_ID, category_id, attraction_name, attraction_country, attraction_city, attraction_description, attraction_image) values
(1,1,'Yellowstone National Park',232,'Wyoming','Yellowstone National Park is a nearly 3,500-sq.-mile wilderness recreation area atop a volcanic hot spot. Mostly in Wyoming, the park spreads into parts of Montana and Idaho too. Yellowstone features dramatic canyons, alpine rivers, lush forests, hot springs and gushing geysers, including its most famous, Old Faithful. It is also home to hundreds of animal species, including bears, wolves, bison, elk and antelope.','uploads/yellowstone.jpg'),
(2,18,'WinStar World Casino',232,'Oklahoma','Discover the thrill of winning and a world of luxury at WinStar World Casino and Resort – the ultimate casino resort destination for entertainment!','uploads/winstarCasino.jpg'),
(3,2,'Victoria and Albert Museum',231,'London','The V&A is the worlds leading museum of art and design, housing a permanent collection of over 2.3 million objects that span over 5,000 years of human creativity. The Museum holds many of the UKs national collections and houses some of the greatest resources for the study of architecture, furniture, fashion, textiles, photography, sculpture, painting, jewellery, glass, ceramics, book arts, Asian art and design, theatre and performance.','uploads/V&Amuseum.jpg'),
(4,5,'Anse Source dArgent',194,'La Digue Island of Seyechelles','Anse Source dArgent is one of the most popular beaches to be found on all the islands, with pink sands offset by towering granite boulders that have been worn by time and weather. The ocean here is sheltered by a reef, providing calm and shallow waters that make a perfect playground for little ones. Most will find it hard to tear themselves away from the lovely seclusion of Anse Source dArgent, but the island is ripe for exploring, with rows of beaches and craggy nooks.','uploads/AnseSourceDAgent.jpg'),
(5,12,'Leaning Tower of Pisa',107,'Pisa','The Leaning Tower of Pisa is one of the most remarkable architectural structures from medieval Europe. Tower of Pisa stands at 60 metres and until 1990 was leaning at about a 10 degree angle. Although it was designed to be perfectly vertical, it started to lean during construction.','uploads/LeaningTowerOfPisa.jpg'),
(6,7,'Volcano Boarding',160,'Leon','Adventurers have to hike to the top of the 2,300ft (701m) peak, each carrying their own wooden boards that they’ll eventually use to slide down. It is a tough hike, but the ride down is something really special that you’ll never forget. But holding a piece of string attached to a wooden board may sound like madness to some – will you be brave enough to try this before the next eruption?','uploads/VolcanoBoarding.jpg');

insert into attraction_category (cat_name) values
('National Park'),
('Museums & Galleries'),
('Amusement Park'),
('Nature/Adventure/Activity'),
('Beaches'),
('Mountains/Hills/Canyons'),
('Adrenaline High'),
('Wildlife'),
('Historical & Heritage'),
('Stadium'),
('Sports Facilities'),
('Tower'),
('Islands'),
('Festivals'),
('Monuments & Memorials'),
('Shopping Malls'),
('Zoo'),
('Casino'),
('Concerts'),
('Bar'),
('Restaurant'),
('Cafe & Bakery');

insert into reviews values
(1,1,1,5,'This place is awesome'),
(2,2,2,1,'Be careful! This place is keen on trying to trap people into spending all of their money and losing it.'),
(3,3,3,3,'I am not a museum person, but the V&A museum in london was unbelievable! Definitely worth the cost of $30/ticket.'),
(4,4,7,4,'One of the best beaches and Islands I have ever been too; and I have been to a lot of beaches.'),
(5,5,24,4,'This tower is definitely leaning way more than I thought. Super cool to see in person.');


/* The country_code column was dropped after inserting all of the countries.
The table name was changed to 'countries' after inserting all of the countries. */
/* INSERT INTO 'countries' values (country_id, country_name) */

INSERT INTO countries(country_name) VALUES ('Afghanistan');
INSERT INTO countries(country_name) VALUES ('Albania');
INSERT INTO countries(country_name) VALUES ('Algeria');
INSERT INTO countries(country_name) VALUES ('American Samoa');
INSERT INTO countries(country_name) VALUES ('Andorra');
INSERT INTO countries(country_name) VALUES ('Angola');
INSERT INTO countries(country_name) VALUES ('Anguilla');
INSERT INTO countries(country_name) VALUES ('Antarctica');
INSERT INTO countries(country_name) VALUES ('Antigua and Barbuda');
INSERT INTO countries(country_name) VALUES ('Argentina');
INSERT INTO countries(country_name) VALUES ('Armenia');
INSERT INTO countries(country_name) VALUES ('Aruba');
INSERT INTO countries(country_name) VALUES ('Australia');
INSERT INTO countries(country_name) VALUES ('Austria');
INSERT INTO countries(country_name) VALUES ('Azerbaijan');
INSERT INTO countries(country_name) VALUES ('Bahamas');
INSERT INTO countries(country_name) VALUES ('Bahrain');
INSERT INTO countries(country_name) VALUES ('Bangladesh');
INSERT INTO countries(country_name) VALUES ('Barbados');
INSERT INTO countries(country_name) VALUES ('Belarus');
INSERT INTO countries(country_name) VALUES ('Belgium');
INSERT INTO countries(country_name) VALUES ('Belize');
INSERT INTO countries(country_name) VALUES ('Benin');
INSERT INTO countries(country_name) VALUES ('Bermuda');
INSERT INTO countries(country_name) VALUES ('Bhutan');
INSERT INTO countries(country_name) VALUES ('Bolivia');
INSERT INTO countries(country_name) VALUES ('Bosnia and Herzegovina');
INSERT INTO countries(country_name) VALUES ('Botswana');
INSERT INTO countries(country_name) VALUES ('Bouvet Island');
INSERT INTO countries(country_name) VALUES ('Brazil');
INSERT INTO countries(country_name) VALUES ('British Indian Ocean Territory');
INSERT INTO countries(country_name) VALUES ('Brunei Darussalam');
INSERT INTO countries(country_name) VALUES ('Bulgaria');
INSERT INTO countries(country_name) VALUES ('Burkina Faso');
INSERT INTO countries(country_name) VALUES ('Burundi');
INSERT INTO countries(country_name) VALUES ('Cambodia');
INSERT INTO countries(country_name) VALUES ('Cameroon');
INSERT INTO countries(country_name) VALUES ('Canada');
INSERT INTO countries(country_name) VALUES ('Cape Verde');
INSERT INTO countries(country_name) VALUES ('Cayman Islands');
INSERT INTO countries(country_name) VALUES ('Central African Republic');
INSERT INTO countries(country_name) VALUES ('Chad');
INSERT INTO countries(country_name) VALUES ('Chile');
INSERT INTO countries(country_name) VALUES ('China');
INSERT INTO countries(country_name) VALUES ('Christmas Island');
INSERT INTO countries(country_name) VALUES ('Cocos (Keeling) Islands');
INSERT INTO countries(country_name) VALUES ('Colombia');
INSERT INTO countries(country_name) VALUES ('Comoros');
INSERT INTO countries(country_name) VALUES ('Democratic Republic of the Congo');
INSERT INTO countries(country_name) VALUES ('Republic of Congo');
INSERT INTO countries(country_name) VALUES ('Cook Islands');
INSERT INTO countries(country_name) VALUES ('Costa Rica');
INSERT INTO countries(country_name) VALUES ('Croatia (Hrvatska)');
INSERT INTO countries(country_name) VALUES ('Cuba');
INSERT INTO countries(country_name) VALUES ('Cyprus');
INSERT INTO countries(country_name) VALUES ('Czech Republic');
INSERT INTO countries(country_name) VALUES ('Denmark');
INSERT INTO countries(country_name) VALUES ('Djibouti');
INSERT INTO countries(country_name) VALUES ('Dominica');
INSERT INTO countries(country_name) VALUES ('Dominican Republic');
INSERT INTO countries(country_name) VALUES ('East Timor');
INSERT INTO countries(country_name) VALUES ('Ecuador');
INSERT INTO countries(country_name) VALUES ('Egypt');
INSERT INTO countries(country_name) VALUES ('El Salvador');
INSERT INTO countries(country_name) VALUES ('Equatorial Guinea');
INSERT INTO countries(country_name) VALUES ('Eritrea');
INSERT INTO countries(country_name) VALUES ('Estonia');
INSERT INTO countries(country_name) VALUES ('Ethiopia');
INSERT INTO countries(country_name) VALUES ( 'Falkland Islands (Malvinas)');
INSERT INTO countries(country_name) VALUES ( 'Faroe Islands');
INSERT INTO countries(country_name) VALUES ('Fiji');
INSERT INTO countries(country_name) VALUES ('Finland');
INSERT INTO countries(country_name) VALUES ('France');
INSERT INTO countries(country_name) VALUES ('France, Metropolitan');
INSERT INTO countries(country_name) VALUES ('French Guiana');
INSERT INTO countries(country_name) VALUES ('French Polynesia');
INSERT INTO countries(country_name) VALUES ('French Southern Territories');
INSERT INTO countries(country_name) VALUES ('Gabon');
INSERT INTO countries(country_name) VALUES ('Gambia');
INSERT INTO countries(country_name) VALUES ('Georgia');
INSERT INTO countries(country_name) VALUES ('Germany');
INSERT INTO countries(country_name) VALUES ('Ghana');
INSERT INTO countries(country_name) VALUES ('Gibraltar');
INSERT INTO countries(country_name) VALUES ('Guernsey');
INSERT INTO countries(country_name) VALUES ('Greece');
INSERT INTO countries(country_name) VALUES ('Greenland');
INSERT INTO countries(country_name) VALUES ('Grenada');
INSERT INTO countries(country_name) VALUES ('Guadeloupe');
INSERT INTO countries(country_name) VALUES ('Guam');
INSERT INTO countries(country_name) VALUES ('Guatemala');
INSERT INTO countries(country_name) VALUES ('Guinea');
INSERT INTO countries(country_name) VALUES ('Guinea-Bissau');
INSERT INTO countries(country_name) VALUES ('Guyana');
INSERT INTO countries(country_name) VALUES ('Haiti');
INSERT INTO countries(country_name) VALUES ('Heard and Mc Donald Islands');
INSERT INTO countries(country_name) VALUES ( 'Honduras');
INSERT INTO countries(country_name) VALUES ('Hong Kong');
INSERT INTO countries(country_name) VALUES ('Hungary');
INSERT INTO countries(country_name) VALUES ( 'Iceland');
INSERT INTO countries(country_name) VALUES ( 'India');
INSERT INTO countries(country_name) VALUES ('Isle of Man');
INSERT INTO countries(country_name) VALUES ('Indonesia');
INSERT INTO countries(country_name) VALUES ('Iran (Islamic Republic of)');
INSERT INTO countries(country_name) VALUES ('Iraq');
INSERT INTO countries(country_name) VALUES ('Ireland');
INSERT INTO countries(country_name) VALUES ('Israel');
INSERT INTO countries(country_name) VALUES ('Italy');
INSERT INTO countries(country_name) VALUES ('Ivory Coast');
INSERT INTO countries(country_name) VALUES ('Jersey');
INSERT INTO countries(country_name) VALUES ( 'Jamaica');
INSERT INTO countries(country_name) VALUES ('Japan');
INSERT INTO countries(country_name) VALUES ( 'Jordan');
INSERT INTO countries(country_name) VALUES ('Kazakhstan');
INSERT INTO countries(country_name) VALUES ('Kenya');
INSERT INTO countries(country_name) VALUES ('Kiribati');
INSERT INTO countries(country_name) VALUES ( 'Korea, Democratic People''s Republic of');
INSERT INTO countries(country_name) VALUES ('Korea, Republic of');
INSERT INTO countries(country_name) VALUES ('Kosovo');
INSERT INTO countries(country_name) VALUES ('Kuwait');
INSERT INTO countries(country_name) VALUES ('Kyrgyzstan');
INSERT INTO countries(country_name) VALUES ('Lao People''s Democratic Republic');
INSERT INTO countries(country_name) VALUES ('Latvia');
INSERT INTO countries(country_name) VALUES ('Lebanon');
INSERT INTO countries(country_name) VALUES ('Lesotho');
INSERT INTO countries(country_name) VALUES ('Liberia');
INSERT INTO countries(country_name) VALUES ('Libyan Arab Jamahiriya');
INSERT INTO countries(country_name) VALUES ('Liechtenstein');
INSERT INTO countries(country_name) VALUES ( 'Lithuania');
INSERT INTO countries(country_name) VALUES ('Luxembourg');
INSERT INTO countries(country_name) VALUES ('Macau');
INSERT INTO countries(country_name) VALUES ( 'North Macedonia');
INSERT INTO countries(country_name) VALUES ( 'Madagascar');
INSERT INTO countries(country_name) VALUES ('Malawi');
INSERT INTO countries(country_name) VALUES ('Malaysia');
INSERT INTO countries(country_name) VALUES ('Maldives');
INSERT INTO countries(country_name) VALUES ('Mali');
INSERT INTO countries(country_name) VALUES ('Malta');
INSERT INTO countries(country_name) VALUES ('Marshall Islands');
INSERT INTO countries(country_name) VALUES ( 'Martinique');
INSERT INTO countries(country_name) VALUES ('Mauritania');
INSERT INTO countries(country_name) VALUES ('Mauritius');
INSERT INTO countries(country_name) VALUES ( 'Mayotte');
INSERT INTO countries(country_name) VALUES ('Mexico');
INSERT INTO countries(country_name) VALUES ('Micronesia, Federated States of');
INSERT INTO countries(country_name) VALUES ('Moldova, Republic of');
INSERT INTO countries(country_name) VALUES ('Monaco');
INSERT INTO countries(country_name) VALUES ('Mongolia');
INSERT INTO countries(country_name) VALUES ('Montenegro');
INSERT INTO countries(country_name) VALUES ('Montserrat');
INSERT INTO countries(country_name) VALUES ('Morocco');
INSERT INTO countries(country_name) VALUES ('Mozambique');
INSERT INTO countries(country_name) VALUES ('Myanmar');
INSERT INTO countries(country_name) VALUES ('Namibia');
INSERT INTO countries(country_name) VALUES ('Nauru');
INSERT INTO countries(country_name) VALUES ('Nepal');
INSERT INTO countries(country_name) VALUES ('Netherlands');
INSERT INTO countries(country_name) VALUES ('Netherlands Antilles');
INSERT INTO countries(country_name) VALUES ('New Caledonia');
INSERT INTO countries(country_name) VALUES ('New Zealand');
INSERT INTO countries(country_name) VALUES ( 'Nicaragua');
INSERT INTO countries(country_name) VALUES ('Niger');
INSERT INTO countries(country_name) VALUES ('Nigeria');
INSERT INTO countries(country_name) VALUES ('Niue');
INSERT INTO countries(country_name) VALUES ( 'Norfolk Island');
INSERT INTO countries(country_name) VALUES ('Northern Mariana Islands');
INSERT INTO countries(country_name) VALUES ('Norway');
INSERT INTO countries(country_name) VALUES ( 'Oman');
INSERT INTO countries(country_name) VALUES ('Pakistan');
INSERT INTO countries(country_name) VALUES ('Palau');
INSERT INTO countries(country_name) VALUES ('Palestine');
INSERT INTO countries(country_name) VALUES ( 'Panama');
INSERT INTO countries(country_name) VALUES ('Papua New Guinea');
INSERT INTO countries(country_name) VALUES ('Paraguay');
INSERT INTO countries(country_name) VALUES ('Peru');
INSERT INTO countries(country_name) VALUES ( 'Philippines');
INSERT INTO countries(country_name) VALUES ( 'Pitcairn');
INSERT INTO countries(country_name) VALUES ( 'Poland');
INSERT INTO countries(country_name) VALUES ('Portugal');
INSERT INTO countries(country_name) VALUES ('Puerto Rico');
INSERT INTO countries(country_name) VALUES ( 'Qatar');
INSERT INTO countries(country_name) VALUES ('Reunion');
INSERT INTO countries(country_name) VALUES ('Romania');
INSERT INTO countries(country_name) VALUES ('Russian Federation');
INSERT INTO countries(country_name) VALUES ('Rwanda');
INSERT INTO countries(country_name) VALUES ('Saint Kitts and Nevis');
INSERT INTO countries(country_name) VALUES ( 'Saint Lucia');
INSERT INTO countries(country_name) VALUES ('Saint Vincent and the Grenadines');
INSERT INTO countries(country_name) VALUES ( 'Samoa');
INSERT INTO countries(country_name) VALUES ('San Marino');
INSERT INTO countries(country_name) VALUES ('Sao Tome and Principe');
INSERT INTO countries(country_name) VALUES ('Saudi Arabia');
INSERT INTO countries(country_name) VALUES ('Senegal');
INSERT INTO countries(country_name) VALUES ( 'Serbia');
INSERT INTO countries(country_name) VALUES ('Seychelles');
INSERT INTO countries(country_name) VALUES ( 'Sierra Leone');
INSERT INTO countries(country_name) VALUES ( 'Singapore');
INSERT INTO countries(country_name) VALUES ( 'Slovakia');
INSERT INTO countries(country_name) VALUES ( 'Slovenia');
INSERT INTO countries(country_name) VALUES ( 'Solomon Islands');
INSERT INTO countries(country_name) VALUES ( 'Somalia');
INSERT INTO countries(country_name) VALUES ('South Africa');
INSERT INTO countries(country_name) VALUES ( 'South Georgia South Sandwich Islands');
INSERT INTO countries(country_name) VALUES ( 'South Sudan');
INSERT INTO countries(country_name) VALUES ( 'Spain');
INSERT INTO countries(country_name) VALUES ( 'Sri Lanka');
INSERT INTO countries(country_name) VALUES ( 'St. Helena');
INSERT INTO countries(country_name) VALUES ( 'St. Pierre and Miquelon');
INSERT INTO countries(country_name) VALUES ( 'Sudan');
INSERT INTO countries(country_name) VALUES ( 'Suriname');
INSERT INTO countries(country_name) VALUES ( 'Svalbard and Jan Mayen Islands');
INSERT INTO countries(country_name) VALUES ('Swaziland');
INSERT INTO countries(country_name) VALUES ( 'Sweden');
INSERT INTO countries(country_name) VALUES ( 'Switzerland');
INSERT INTO countries(country_name) VALUES ( 'Syrian Arab Republic');
INSERT INTO countries(country_name) VALUES ( 'Taiwan');
INSERT INTO countries(country_name) VALUES ( 'Tajikistan');
INSERT INTO countries(country_name) VALUES ( 'Tanzania, United Republic of');
INSERT INTO countries(country_name) VALUES ( 'Thailand');
INSERT INTO countries(country_name) VALUES ( 'Togo');
INSERT INTO countries(country_name) VALUES ('Tokelau');
INSERT INTO countries(country_name) VALUES ( 'Tonga');
INSERT INTO countries(country_name) VALUES ('Trinidad and Tobago');
INSERT INTO countries(country_name) VALUES ('Tunisia');
INSERT INTO countries(country_name) VALUES ( 'Turkey');
INSERT INTO countries(country_name) VALUES ('Turkmenistan');
INSERT INTO countries(country_name) VALUES ('Turks and Caicos Islands');
INSERT INTO countries(country_name) VALUES ('Tuvalu');
INSERT INTO countries(country_name) VALUES ( 'Uganda');
INSERT INTO countries(country_name) VALUES ('Ukraine');
INSERT INTO countries(country_name) VALUES ('United Arab Emirates');
INSERT INTO countries(country_name) VALUES ('United Kingdom');
INSERT INTO countries(country_name) VALUES ( 'United States');
INSERT INTO countries(country_name) VALUES ('United States minor outlying islands');
INSERT INTO countries(country_name) VALUES ('Uruguay');
INSERT INTO countries(country_name) VALUES ( 'Uzbekistan');
INSERT INTO countries(country_name) VALUES ( 'Vanuatu');
INSERT INTO countries(country_name) VALUES ( 'Vatican City State');
INSERT INTO countries(country_name) VALUES ('Venezuela');
INSERT INTO countries(country_name) VALUES ( 'Vietnam');
INSERT INTO countries(country_name) VALUES ( 'Virgin Islands (British)');
INSERT INTO countries(country_name) VALUES ( 'Virgin Islands (U.S.)');
INSERT INTO countries(country_name) VALUES ( 'Wallis and Futuna Islands');
INSERT INTO countries(country_name) VALUES ( 'Western Sahara');
INSERT INTO countries(country_name) VALUES ( 'Yemen');
INSERT INTO countries(country_name) VALUES ('Zambia');
INSERT INTO countries(country_name) VALUES ( 'Zimbabwe');

insert into us_places values
(1,1,'New Mexico','San Francisco','New Orleans','Lake Tahoe','Montana','Fort Lauderdale','Sanibel Island','Destin Beach','uploads/newmexico.jpg','uploads/sanfran.jpg','uploads/neworleans.jpg','uploads/laketahoe.jpg','uploads/montana.jpg','uploads/fortlaudy.jpg','uploads/sanibelisland.jpg','uploads/destin.jpg'),
(2,2,'Seattle','Salt Lake City','Los Angeles','Jackson Hole','Sedona','Miami','Maui','Leguna Beach','uploads/seattle.jpg','uploads/saltlakecity.jpg','uploads/losangeles.jpg','uploads/jacksonhole.jpg','uploads/sedona.jpg','uploads/miami.jpg','uploads/maui.jpg','uploads/legunabeach.jpg'),
(3,3,'Charleston','Key West','Miami','Colorado','Kauai','Folly Beach','Kiawah Island','Cape May Beach','uploads/charleston.jpg','uploads/keywest.jpg','uploads/miami.jpg','uploads/colorado.jpg','uploads/kauai.jpg','uploads/follybeach.jpg','uploads/kiawahisland.jpg','uploads/capemaybeach.jpg'),
(4,4,'Washington D.C.','New Orleans','New York City','Yellowstone','Maui','Maui','Outer Banks','Clearwater Beach','uploads/charleston.jpg','uploads/keywest.jpg','uploads/miami.jpg','uploads/colorado.jpg','uploads/kauai.jpg','uploads/follybeach.jpg','uploads/kiawahisland.jpg','uploads/capemaybeach.jpg'),
(5,5,'New Mexico','San Francisco','New Orleans','Lake Tahoe','Montana','Fort Lauderdale','Sanibel Island','Destin Beach','uploads/newmexico.jpg','uploads/sanfran.jpg','uploads/neworleans.jpg','uploads/laketahoe.jpg','uploads/montana.jpg','uploads/fortlaudy.jpg','uploads/sanibelisland.jpg','uploads/destin.jpg'),
(6,6,'Seattle','Salt Lake City','Los Angeles','Jackson Hole','Sedona','Miami','Maui','Leguna Beach','uploads/seattle.jpg','uploads/saltlakecity.jpg','uploads/losangeles.jpg','uploads/jacksonhole.jpg','uploads/sedona.jpg','uploads/miami.jpg','uploads/maui.jpg','uploads/legunabeach.jpg');

insert into int_places values
(1,'Bhutan','Paris','Paris','Bangkok','South Africa','New Zeland','Australia','Spain','Bora Bora','Saint John','Mexico','uploads/bhutan.jpg','uploads/paris.jpg','uploads/paris.jpg','uploads/bangkok.jpg','uploads/southafrica.jpg','uploads/southislands.jpg','uploads/australia.jpg','uploads/spain.jpg','uploads/borabora.jpg','uploads/saintjohn.jpg','uploads/cabo.jpg');
(2,'Cambodia','Rome','Rio de Janeiro','Buenos Aires','Iceland','French Polynesia','Turkey','Thailand','Maldives','Saint Martin','Belize','uploads/cambodia.jpg','uploads/rome.jpg','uploads/riodejaneiro.jpg','uploads/buenosaires.jpg','uploads/iceland.jpg','uploads/frenchpolynesia.jpg','uploads/turkey.jpg','uploads/thailand.jpg','uploads/maldives.jpg','uploads/saintmartin.jpg','uploads/belize.jpg'),
(3,'India','London','Barcelona','Berlin','Namibia','Columbia','Austria','Costa Rica','Turks & Caicos','Turks & Caicos','Jamaica','uploads/india.jpg','uploads/london.jpg','uploads/barcelona.jpg','uploads/berlin.jpg','uploads/namibia.jpg','uploads/columbia.jpg','uploads/austria.jpg','uploads/costarica.jpg','uploads/turks&caicos.jpg','uploads/turks&caicos.jpg','uploads/jamaica.jpg'),
(4,'Costa Rica','Dubai','Cartegena','Venice','Vietnam','Costa Rica','New Zealand','Portugal','Cabo','Bora Bora','Anguilla','uploads/costarica.jpg','uploads/dubai.jpg','uploads/cartegena.jpg','uploads/venice.jpg','uploads/vietnam.jpg','uploads/costarica.jpg','uploads/newzealand.jpg','uploads/portugal.jpg','uploads/cabo.jpg','uploads/borabora.jpg','uploads/anguilla.jpg'),
(5,'Croatia','Tokyo','Amsterdam','Rome','Australia','Portugal','Greece','Argentina','Panama','Maldives','Chile','uploads/croatia.jpg','uploads/turkey.jpg','uploads/amsterdam.jpg','uploads/rome.jpg','uploads/australia.jpg','uploads/portugal.jpg','uploads/greece.jpg','uploads/argentina.jpg','uploads/panama.jpg','uploads/maldives.jpg','uploads/chile.jpg'),
(6,'Japan','Marrakech','Ibiza','Paris','Bolivia','Greenland','Galapagos Islands','Great Barrier Reef','Jamaica','Australia','Barbados','uploads/japan.jpg','uploads/marrakech.jpg','uploads/ibiza.jpg','uploads/paris.jpg','uploads/bolivia.jpg','uploads/greenland.jpg','uploads/galapagosislands.jpg','uploads/greatBarrierReef.jpg','uploads/jamaica.jpg','uploads/australia.jpg','uploads/barbados.jpg');
