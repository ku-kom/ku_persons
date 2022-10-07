#
# Add SQL definition of database tables
#
# Persons in contact box
CREATE TABLE tt_content (
    ku_persons_contact_box varchar(255) DEFAULT '' NOT NULL,
    ku_persons_list varchar(255) DEFAULT '' NOT NULL
);