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
DROP TABLE IF EXISTS follow;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS postLike;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS commentLike;
DROP TABLE IF EXISTS poll;
DROP TABLE IF EXISTS pollOption;
DROP TABLE IF EXISTS pollVote;
DROP TABLE IF EXISTS file;
DROP TABLE IF EXISTS thread;
DROP TABLE IF EXISTS threadComment;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS answer;
DROP TABLE IF EXISTS userReport;
DROP TABLE IF EXISTS eventReport;
DROP TABLE IF EXISTS currency;
DROP TABLE IF EXISTS category;

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

CREATE TABLE follow (

    followerId integer REFERENCES member ON DELETE CASCADE,
    followedId integer REFERENCES member ON DELETE CASCADE,
    PRIMARY KEY (followerId,followedId)
);

CREATE TABLE post (
    id integer PRIMARY KEY,
    content text NOT NULL,
    postDate date NOT NULL DEFAULT today,
    likes integer NOT NULL DEFAULT 0 CHECK (likes >=0),
    eventId integer REFERENCES event ON DELETE CASCADE,
    authorId integer REFERENCES member
);

CREATE TABLE postLike (

    userId integer REFERENCES member ON DELETE CASCADE,
    postId integer REFERENCES post ON DELETE CASCADE,
    PRIMARY KEY(userId,postId)
);

CREATE TABLE comment(
    id integer PRIMARY KEY,
    content text NOT NULL,
    commentDate date NOT NULL DEFAULT today,
    likes integer NOT NULL DEFAULT 0 CHECK (likes >=0),
    postId integer REFERENCES post ON DELETE CASCADE,
    userId integer REFERENCES user,
    parent integer REFERENCES comment

);

CREATE TABLE commentLike(
    userId integer REFERENCES member ON DELETE CASCADE,
    commentId integer REFERENCES comment ON DELETE CASCADE,
    PRIMARY KEY(userId,commentId)
);

CREATE TABLE poll(
    postId integer PRIMARY KEY REFERENCES post ON DELETE CASCADE,
    title text NOT NULL
);

CREATE TABLE pollOption(
    id integer PRIMARY KEY,
    postId integer REFERENCES poll ON DELETE CASCADE,
    name text NOT NULL,
    votes integer NOT NULL DEFAULT 0 CHECK (votes >=0)
);

CREATE TABLE pollVote(
    pollOptionId integer REFERENCES pollOption ON DELETE CASCADE,
    userId integer REFERENCES member ON DELETE CASCADE,
    PRIMARY KEY(pollOptionId,userId)
);

CREATE TABLE file(
    postId integer REFERENCES post ON DELETE CASCADE,
    file text NOT NULL
);

CREATE TABLE thread(
    id integer PRIMARY KEY,
    content text NOT NULL,
    threadDate date NOT NULL DEFAULT today,
    eventId integer REFERENCES event ON DELETE CASCADE,
    authorId integer REFERENCES member
);
CREATE TABLE threadComment(
    id integer PRIMARY KEY,
    content NOT NULL,
    commentDate date NOT NULL DEFAULT today,
    threadId integer REFERENCES thread ON DELETE CASCADE,
    userId integer REFERENCES member
);

CREATE TABLE question(
    id integer PRIMARY KEY,
    question text NOT NULL,
    eventId integer REFERENCES event ON DELETE CASCADE
);

CREATE TABLE answer (
    id integer PRIMARY KEY,
    answer text NOT NULL,
    questionId integer REFERENCES question ON DELETE CASCADE
);

CREATE TABLE userReport(
    userId integer REFERENCES member,
    reportedUser integer REFERENCES member,
    status reportStatus NOT NULL,
    reportDate date NOT NULL DEFAULT today,
    PRIMARY KEY(userId,reportedUser)
);

CREATE TABLE eventReport(
    eventId integer REFERENCES event,
    userId integer REFERENCES member,
    status reportStatus NOT NULL,
    reportDate date NOT NULL DEFAULT today,
    PRIMARY KEY(userId,eventId)
);

CREATE TABLE currency(
    id integer PRIMARY KEY,
    code text UNIQUE NOT NULL,
    name text UNIQUE NOT NULL
);
CREATE TABLE category(
    id integer PRIMARY KEY,
    name text UNIQUE NOT NULL
);