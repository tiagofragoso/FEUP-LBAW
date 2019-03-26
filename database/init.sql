-- PRAGMA FOREIGN_KEYS=ON;

-- TODO list:
-- -snake case?
-- -enum values
-- -QRcode url?

DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS member;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS event;
DROP TABLE IF EXISTS ticket;
DROP TABLE IF EXISTS participation;
DROP TABLE IF EXISTS inviteRequest;

CREATE TYPE eventType AS ENUM ('Concert', 'Festival', 'Liveset');
CREATE TYPE eventStatus AS ENUM ('Planning', '?', 'Live');
CREATE TYPE participationType AS ENUM ('?', '?', '?');
CREATE TYPE status AS ENUM ('PENDING', 'ACCEPTED', 'DECLINED?');

CREATE TABLE user (
    id integer PRIMARY KEY,
    name text,
    username text UNIQUE NOT NULL,
    email text UNIQUE NOT NULL,
    password text NOT NULL
);

CREATE TABLE member (
    userId integer PRIMARY KEY REFERENCES user,
    birthdate date NOT NULL,
    banned boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE admin (
    userId integer PRIMARY KEY REFERENCES user
);

CREATE TABLE event (
    id integer PRIMARY KEY,
    title text NOT NULL,
    startDate date,
    endDate date,
    location text,
    address text,
    price numeric DEFAULT 0 CONTRAINT positive_price CHECK (price >= 0),
    brief text,
    description text,
    ticketSaleStartDate date,
    banned boolean NOT NULL DEFAULT FALSE,
    category text REFERENCES category,
    type eventType NOT NULL,
    visibility boolean NOT NULL DEFAULT TRUE,
    status eventStatus NOT NULL,
    currency text REFERENCES currency
);

CREATE TABLE ticket (
    id integer PRIMARY KEY,
    qrcode text NOT NULL, -- URL?
    purchaseDate date NOT NULL DEFAULT today,
    price numeric NOT NULL CONTRAINT positive_price CHECK (price >= 0),
    owner integer REFERENCES member,
    eventId integer REFERENCES event
);

CREATE TABLE participation (
    id integer PRIMARY KEY,
    userId integer REFERENCES member,
    eventId integer REFERENCES event,
    type participationType NOT NULL,
    participationDate date NOT NULL DEFAULT today -- TODO: change name?
);

CREATE TABLE inviteRequest (
    id integer PRIMARY KEY,
    userId integer REFERENCES member,
    invitedUserId integer REFERENCES member,
    eventId integer REFERENCES event,
    type participationType NOT NULL,
    inviteStatus status NOT NULL,
    inviteDate date NOT NULL DEFAULT today --TODO: change name?
);