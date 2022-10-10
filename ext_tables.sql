#
# Add SQL definition of database tables
#
# Persons in contact box
CREATE TABLE tt_content (
    ku_persons_list_search varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_kupersons (
    realName varchar(80) DEFAULT '' NOT NULL,
    jobTitle varchar(255) DEFAULT '' NOT NULL,
    email varchar(255) DEFAULT '' NOT NULL,
    telephone VARCHAR(32) NOT NULL default NULL,
    mobile VARCHAR(32) NOT NULL default NULL,
    PRIMARY KEY (email)
);