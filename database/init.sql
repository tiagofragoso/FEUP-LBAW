-- PRAGMA FOREIGN_KEYS=ON;

DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS member;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS event;
DROP TABLE IF EXISTS ticket;
DROP TABLE IF EXISTS participation;
DROP TABLE IF EXISTS invite_request;
DROP TABLE IF EXISTS follow;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS post_like;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS comment_like;
DROP TABLE IF EXISTS poll;
DROP TABLE IF EXISTS poll_option;
DROP TABLE IF EXISTS poll_vote;
DROP TABLE IF EXISTS file;
DROP TABLE IF EXISTS thread;
DROP TABLE IF EXISTS thread_comment;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS answer;
DROP TABLE IF EXISTS user_report;
DROP TABLE IF EXISTS event_report;
DROP TABLE IF EXISTS currency;
DROP TABLE IF EXISTS category;

CREATE TYPE event_type AS ENUM ('Concert', 'Festival', 'Liveset');
CREATE TYPE event_status AS ENUM ('Planning', 'Tickets', 'Live');
CREATE TYPE participation_type AS ENUM ('Host', 'Artist', 'Owner', 'Participant');
CREATE TYPE status AS ENUM ('Pending', 'Accepted', 'Declined');

CREATE TABLE user (
    id integer PRIMARY KEY,
    name text,
    username text UNIQUE NOT NULL,
    email text UNIQUE NOT NULL,
    password text NOT NULL
);

CREATE TABLE member (
    user_id integer PRIMARY KEY REFERENCES user ON DELETE CASCADE,
    birthdate date NOT NULL,
    banned boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE admin (
    user_id integer PRIMARY KEY REFERENCES user ON DELETE CASCADE
);

CREATE TABLE event (
    id integer PRIMARY KEY,
    title text NOT NULL,
    start_date date,
    end_date date,
    location text,
    address text,
    price numeric DEFAULT 0 CONTRAINT positive_price CHECK (price >= 0),
    brief text,
    description text,
    ticket_sale_start_date date,
    banned boolean NOT NULL DEFAULT FALSE,
    category text REFERENCES category ON DELETE CASCADE,
    type event_type NOT NULL,
    visibility boolean NOT NULL DEFAULT TRUE,
    status event_status NOT NULL,
    currency text REFERENCES currency ON DELETE CASCADE
);

CREATE TABLE ticket (
    id integer PRIMARY KEY,
    qrcode text NOT NULL,
    purchase_date date NOT NULL DEFAULT today,
    price numeric NOT NULL CONTRAINT positive_price CHECK (price >= 0),
    owner integer REFERENCES member ON DELETE CASCADE,
    event_id integer REFERENCES event ON DELETE CASCADE
);

CREATE TABLE participation (
    id integer PRIMARY KEY,
    user_id integer REFERENCES member ON DELETE CASCADE,
    event_id integer REFERENCES event ON DELETE CASCADE,
    type participation_type NOT NULL,
    participation_date date NOT NULL DEFAULT today
);

CREATE TABLE invite_request (
    id integer PRIMARY KEY,
    user_id integer REFERENCES member ON DELETE CASCADE,
    invited_user_id integer REFERENCES member ON DELETE CASCADE,
    event_id integer REFERENCES event ON DELETE CASCADE,
    type participation_type NOT NULL,
    invite_status status NOT NULL,
    invite_date date NOT NULL DEFAULT today
);

CREATE TABLE follow (
    follower_id integer REFERENCES member ON DELETE CASCADE,
    followed_id integer REFERENCES member ON DELETE CASCADE,
    PRIMARY KEY (followerId,followedId)
);

CREATE TABLE post (
    id integer PRIMARY KEY,
    content text NOT NULL,
    post_date date NOT NULL DEFAULT today,
    likes integer NOT NULL DEFAULT 0 CONTRAINT positive_likes CHECK (likes >=0),
    event_id integer REFERENCES event ON DELETE CASCADE,
    author_id integer REFERENCES member ON DELETE CASCADE
);

CREATE TABLE post_like (
    user_id integer REFERENCES member ON DELETE CASCADE,
    post_id integer REFERENCES post ON DELETE CASCADE,
    PRIMARY KEY(user_id, post_id)
);

CREATE TABLE comment (
    id integer PRIMARY KEY,
    content text NOT NULL,
    comment_date date NOT NULL DEFAULT today,
    likes integer NOT NULL DEFAULT 0 CONTRAINT positive_likes CHECK (likes >=0),
    post_id integer REFERENCES post ON DELETE CASCADE,
    user_id integer REFERENCES user ON DELETE CASCADE,
    parent integer REFERENCES comment ON DELETE CASCADE
);

CREATE TABLE comment_like (
    user_id integer REFERENCES member ON DELETE CASCADE,
    comment_id integer REFERENCES comment ON DELETE CASCADE,
    PRIMARY KEY(user_id, comment_id)
);

CREATE TABLE poll (
    post_id integer PRIMARY KEY REFERENCES post ON DELETE CASCADE,
    title text NOT NULL
);

CREATE TABLE poll_option (
    id integer PRIMARY KEY,
    post_id integer REFERENCES poll ON DELETE CASCADE,
    name text NOT NULL,
    votes integer NOT NULL DEFAULT 0 CONTRAINT positive_votes CHECK (votes >=0)
);

CREATE TABLE poll_vote (
    poll_option_id integer REFERENCES poll_option ON DELETE CASCADE,
    user_id integer REFERENCES member ON DELETE CASCADE,
    PRIMARY KEY(poll_option_id, user_id)
);

CREATE TABLE file (
    post_id integer REFERENCES post ON DELETE CASCADE,
    file text NOT NULL
);

CREATE TABLE thread (
    id integer PRIMARY KEY,
    content text NOT NULL,
    thread_date date NOT NULL DEFAULT today,
    event_id integer REFERENCES event ON DELETE CASCADE,
    author_id integer REFERENCES member ON DELETE CASCADE
);

CREATE TABLE thread_comment (
    id integer PRIMARY KEY,
    content text NOT NULL,
    comment_date date NOT NULL DEFAULT today,
    thread_id integer REFERENCES thread ON DELETE CASCADE,
    user_id integer REFERENCES member ON DELETE CASCADE
);

CREATE TABLE question (
    id integer PRIMARY KEY,
    question text NOT NULL,
    event_id integer REFERENCES event ON DELETE CASCADE
);

CREATE TABLE answer (
    id integer PRIMARY KEY,
    answer text NOT NULL,
    question_id integer REFERENCES question ON DELETE CASCADE
);

CREATE TABLE user_report (
    user_id integer REFERENCES member ON DELETE CASCADE,
    reported_user integer REFERENCES member ON DELETE CASCADE,
    report_status status NOT NULL,
    report_date date NOT NULL DEFAULT today,
    PRIMARY KEY(user_id, reported_user)
);

CREATE TABLE event_report (
    event_id integer REFERENCES event ON DELETE CASCADE,
    user_id integer REFERENCES member ON DELETE CASCADE,
    report_status status NOT NULL,
    report_date date NOT NULL DEFAULT today,
    PRIMARY KEY(user_id, event_id)
);

CREATE TABLE currency (
    id integer PRIMARY KEY,
    code text UNIQUE NOT NULL,
    name text UNIQUE NOT NULL
);

CREATE TABLE category (
    id integer PRIMARY KEY,
    name text UNIQUE NOT NULL
);