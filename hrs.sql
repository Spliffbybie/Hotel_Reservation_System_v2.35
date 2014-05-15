# --------------------------------------------------------
#
#

CREATE TABLE Bookings (
   booking_id int(10) unsigned NOT NULL auto_increment,
   start_date date DEFAULT '0000-00-00' NOT NULL,
   end_date date DEFAULT '0000-00-00' NOT NULL,
   client_id int(10) unsigned,
   corporate_id int(10) unsigned,
   singles int(10) unsigned,
   twices int(10) unsigned,
   doubles int(10) unsigned,
   triples int(10) unsigned,
   executives int(10) unsigned,
   special_requests text,
   booking_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   total_cost float(10,2) unsigned DEFAULT '0.00' NOT NULL,
   is_seen tinyint(1) DEFAULT '0' NOT NULL,
   exec_guest_number int(10) unsigned DEFAULT '0' NOT NULL,
   special_id int(10) unsigned DEFAULT '0' NOT NULL,
   is_deleted tinyint(4) DEFAULT '0' NOT NULL,
   childs int(1) unsigned DEFAULT '0' NOT NULL,
   PRIMARY KEY (booking_id),
   KEY start_date (start_date),
   KEY end_date (end_date),
   KEY booking_time (booking_time)
);

#



# --------------------------------------------------------
#
# Структура таблицы для таблицы 'Clients'
#

CREATE TABLE Clients (
   client_id int(10) unsigned NOT NULL auto_increment,
   first_name varchar(64),
   surname varchar(64),
   title varchar(16),
   cc_info varchar(255),
   confirm_type varchar(64),
   street_addr text,
   city varchar(64),
   province varchar(128),
   zip varchar(64),
   country varchar(64),
   phone varchar(64),
   fax varchar(64),
   email varchar(128),
   additional_comments text,
   ip varchar(32),
   PRIMARY KEY (client_id)
);

#
#


# --------------------------------------------------------
#


CREATE TABLE Corporates (
   corporate_id int(10) unsigned NOT NULL auto_increment,
   type set('corporate','airline','tour') NOT NULL,
   name varchar(128),
   address text,
   phone varchar(64),
   fax varchar(64),
   contact_name varchar(128),
   email varchar(128),
   username varchar(64) NOT NULL,
   password varchar(64),
   max_booking int(10) unsigned DEFAULT '0' NOT NULL,
   PRIMARY KEY (corporate_id),
   UNIQUE username (username)
);

#
# Сдампать данные таблицы 'Corporates'
#

INSERT INTO Corporates VALUES ( '4', 'tour', 'Test Company', '56785685', '684', '84584', '8468', '846784 68', 'test', '45845', '80');
INSERT INTO Corporates VALUES ( '12', 'tour', 'operator', 'abc', '12345', '12345', 'op', 'op@', 'op', 'op', '123');
INSERT INTO Corporates VALUES ( '8', 'airline', 'RICS', '8', '123456', '654321', 'Sergey', 'dh', 'serge', 'ricsg', '45645');
INSERT INTO Corporates VALUES ( '11', 'airline', 'New airline', 'Saint-Petersburg
', '(718) 648-5746', '2983611', 'Max', 'info@1-web-development.co.uk', 'New', '12345', '6');
INSERT INTO Corporates VALUES ( '10', 'tour', 'lotus', 'Saint-Petersburg
', '2345', '23467237', 'lotus', 'lotus@rics.ru', 'lotus', 'lotus', '5');

# --------------------------------------------------------
#
# Структура таблицы для таблицы 'Messages'
#

CREATE TABLE Messages (
   id int(10) unsigned NOT NULL auto_increment,
   operator_id int(10) unsigned DEFAULT '0' NOT NULL,
   time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   action text,
   PRIMARY KEY (id),
   KEY id (id),
   KEY time (time)
);


# --------------------------------------------------------
#
# Структура таблицы для таблицы 'Operators'
#

CREATE TABLE Operators (
   operator_id int(10) unsigned NOT NULL auto_increment,
   username varchar(64) NOT NULL,
   password varchar(64) NOT NULL,
   details text,
   name varchar(64) NOT NULL,
   can_delete tinyint(4) DEFAULT '0' NOT NULL,
   PRIMARY KEY (operator_id),
   UNIQUE username (username)
);

#
# Сдампать данные таблицы 'Operators'
#

INSERT INTO Operators VALUES ( '1', 'administrator', 'administrator', 'The administration account', 'administrator', '0');
INSERT INTO Operators VALUES ( '2', 'operator', 'operator', 'The first operator\'s account', 'operator', '0');
INSERT INTO Operators VALUES ( '3', 'operator2', 'operator2', 'The second operator\'s account.', 'operator2', '0');

# --------------------------------------------------------
#
# Структура таблицы для таблицы 'Rates'
#

CREATE TABLE Rates (
   rate_id int(10) unsigned NOT NULL auto_increment,
   date date DEFAULT '0000-00-00' NOT NULL,
   singles float(10,2) unsigned,
   twins float(10,2) unsigned,
   doubles float(10,2) unsigned,
   triples float(10,2) unsigned,
   executives float(10,2) unsigned,
   special_desc_id int(10) unsigned DEFAULT '0' NOT NULL,
   corporate_id int(10) unsigned DEFAULT '0' NOT NULL,
   PRIMARY KEY (rate_id),
   KEY date (date),
   KEY special_desc_id (special_desc_id),
   KEY corporate_id (corporate_id)
);



# --------------------------------------------------------
#
# Структура таблицы для таблицы 'Rooms'
#

CREATE TABLE Rooms (
   id int(10) unsigned NOT NULL auto_increment,
   date date DEFAULT '0000-00-00' NOT NULL,
   single int(10) unsigned DEFAULT '0' NOT NULL,
   triple int(10) unsigned DEFAULT '0' NOT NULL,
   executive int(10) unsigned DEFAULT '0' NOT NULL,
   is_corporate tinyint(1) DEFAULT '0' NOT NULL,
   PRIMARY KEY (id),
   KEY corporate_id (is_corporate),
   KEY date (date)
);

# --------------------------------------------------------


CREATE TABLE Settings (
   name varchar(64) NOT NULL,
   text text,
   comment text,
   PRIMARY KEY (name)
);

#
#

INSERT INTO Settings VALUES ( 'exchange_rate', '0.60', '1 Euro equals this value of main currency');
INSERT INTO Settings VALUES ( 'currency', 'Cyprus Pound', 'The sign of the main currency');
INSERT INTO Settings VALUES ( 'currency_euro', 'US dollars', 'The sign of EURO');
INSERT INTO Settings VALUES ( 'max_client_booking', '4', 'The maximum number of rooms usual client can reserve');
INSERT INTO Settings VALUES ( 'calendar_month_number', '5', 'The number of month displayed in automatic calendar');
INSERT INTO Settings VALUES ( 'mail_client_from', 'Reservation System <hotel@rics.ru>', 'An address that will appear in the From field of client\'s mail reader.');
INSERT INTO Settings VALUES ( 'mail_client_subject', 'Booking Confirmation', 'A subject of mail sent to user.');
INSERT INTO Settings VALUES ( 'mail_client_reply_to', 'info@rics.ru', 'Reply-to field.');
INSERT INTO Settings VALUES ( 'mail_client_x_mailer', 'Reservation System', 'X-Mailer field');
INSERT INTO Settings VALUES ( 'mail_admin_address', 'info@rics.ru', 'An address where new bookings must be sent to.');
INSERT INTO Settings VALUES ( 'links_at_end_of_booking', 'https://www.safeweb.com/o/_:http://www.hrs.ricssoft.co.uk', 'The name of page on which passes at end of booking');

# --------------------------------------------------------
#

#

CREATE TABLE Specials (
   special_id int(10) unsigned NOT NULL auto_increment,
   text text,
   length int(10) unsigned,
   PRIMARY KEY (special_id)
);

##

INSERT INTO Specials VALUES ( '17', '', '0');
INSERT INTO Specials VALUES ( '15', '', '0');
INSERT INTO Specials VALUES ( '16', '', '0');
INSERT INTO Specials VALUES ( '12', 'New Years Special', '3');
INSERT INTO Specials VALUES ( '18', '', '0');
INSERT INTO Specials VALUES ( '22', '', '0');
INSERT INTO Specials VALUES ( '26', '', '5');
INSERT INTO Specials VALUES ( '25', 'Offerta speciale', '10');

# --------------------------------------------------------
#
#

CREATE TABLE inventory (
   id int(1) unsigned NOT NULL auto_increment,
   single text,
   twin text,
   doubl text,
   triple text,
   executive text,
   KEY id (id)
);

#
#

INSERT INTO inventory VALUES ( '1', '5', '5', '3', '5', '3');

# --------------------------------------------------------
#
# Структура таблицы для таблицы 'occupancy'
#

CREATE TABLE occupancy (
   id int(1) unsigned NOT NULL auto_increment,
   single int(1) unsigned DEFAULT '0' NOT NULL,
   twin int(1) unsigned DEFAULT '0' NOT NULL,
   doubl int(1) unsigned DEFAULT '0' NOT NULL,
   triple int(1) unsigned DEFAULT '0' NOT NULL,
   executive int(1) unsigned DEFAULT '0' NOT NULL,
   KEY id (id)
);

#
# Сдампать данные таблицы 'occupancy'
#

INSERT INTO occupancy VALUES ( '1', '1', '2', '3', '2', '7');
INSERT INTO occupancy VALUES ( '2', '0', '2', '1', '1', '1');
