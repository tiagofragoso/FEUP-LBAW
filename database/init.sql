-- PRAGMA FOREIGN_KEYS=ON;

DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS member;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS event;

CREATE TYPE eventType AS ENUM ('Concert', 'Festival', 'Liveset');
CREATE TYPE eventStatus AS ENUM ('Concert', 'Festival', 'Liveset');

CREATE TABLE user (
    id integer PRIMARY KEY,
    name text,
    username text UNIQUE NOT NULL,
    email text UNIQUE NOT NULL,
    password text NOT NULL
)

CREATE TABLE member (
    userId integer PRIMARY KEY REFERENCES user,
    birthdate date NOT NULL,
    banned boolean NOT NULL DEFAULT FALSE
)

CREATE TABLE admin (
    userId integer PRIMARY KEY REFERENCES user
)

CREATE TABLE event (
    id integer PRIMARY KEY,
    title text NOT NULL,
    startDate date,
    endDate date,
    location text,
    address text,
    price numeric DEFAULT 0 CHECK (price >= 0),
    brief text,
    description text,
    ticketSaleStartDate date,
    banned boolean NOT NULL DEFAULT FALSE,
    category text REFERENCES category,
    type eventType NOT NULL,
    -- visibility TODO
    status eventStatus NOT NULL,
    currency text REFERENCES currency
)