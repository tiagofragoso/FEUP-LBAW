-- PRAGMA FOREIGN_KEYS=ON;

DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS currencies;
DROP TABLE IF EXISTS event_reports;
DROP TABLE IF EXISTS user_reports;
DROP TABLE IF EXISTS answers;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS thread_comments;
DROP TABLE IF EXISTS threads;
DROP TABLE IF EXISTS files;
DROP TABLE IF EXISTS poll_votes;
DROP TABLE IF EXISTS poll_options;
DROP TABLE IF EXISTS polls;
DROP TABLE IF EXISTS comment_likes;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS post_likes;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS follows;
DROP TABLE IF EXISTS invite_requests;
DROP TABLE IF EXISTS participations;
DROP TABLE IF EXISTS tickets;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS users;

CREATE TYPE event_type AS ENUM ('Concert', 'Festival', 'Liveset');
CREATE TYPE event_status AS ENUM ('Planning', 'Tickets', 'Live');
CREATE TYPE participation_type AS ENUM ('Host', 'Artist', 'Owner', 'Participant');
CREATE TYPE status AS ENUM ('Pending', 'Accepted', 'Declined');

CREATE TABLE users (
    id integer PRIMARY KEY,
    name text,
    username text UNIQUE NOT NULL,
    email text UNIQUE NOT NULL,
    password text NOT NULL
);

CREATE TABLE members (
    user_id integer PRIMARY KEY REFERENCES users ON DELETE CASCADE,
    birthdate date NOT NULL,
    banned boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE admins (
    user_id integer PRIMARY KEY REFERENCES users ON DELETE CASCADE
);

CREATE TABLE events (
    id integer PRIMARY KEY,
    title text NOT NULL,
    start_date date,
    end_date date,
    location text,
    address text,
    price numeric DEFAULT 0 CONSTRAINT positive_price CHECK (price >= 0),
    brief text,
    description text,
    ticket_sale_start_date date,
    banned boolean NOT NULL DEFAULT FALSE,
    category text REFERENCES categories ON DELETE CASCADE,
    type event_type NOT NULL,
    visibility boolean NOT NULL DEFAULT TRUE,
    status event_status NOT NULL,
    currency text REFERENCES currencies ON DELETE CASCADE
);

CREATE TABLE tickets (
    id integer PRIMARY KEY,
    qrcode text NOT NULL,
    purchase_date date NOT NULL DEFAULT today,
    price numeric NOT NULL CONSTRAINT positive_price CHECK (price >= 0),
    owner integer REFERENCES members ON DELETE CASCADE,
    event_id integer REFERENCES events ON DELETE CASCADE
);

CREATE TABLE participations (
    id integer PRIMARY KEY,
    user_id integer REFERENCES members ON DELETE CASCADE,
    event_id integer REFERENCES events ON DELETE CASCADE,
    type participation_type NOT NULL,
    participation_date date NOT NULL DEFAULT today
);

CREATE TABLE invite_requests (
    id integer PRIMARY KEY,
    user_id integer REFERENCES members ON DELETE CASCADE,
    invited_user_id integer REFERENCES members ON DELETE CASCADE,
    event_id integer REFERENCES events ON DELETE CASCADE,
    type participation_type NOT NULL,
    invite_status status NOT NULL,
    invite_date date NOT NULL DEFAULT today
);

CREATE TABLE follows (
    follower_id integer REFERENCES members ON DELETE CASCADE,
    followed_id integer REFERENCES members ON DELETE CASCADE,
    PRIMARY KEY (followerId,followedId)
);

CREATE TABLE posts (
    id integer PRIMARY KEY,
    content text NOT NULL,
    post_date date NOT NULL DEFAULT today,
    likes integer NOT NULL DEFAULT 0 CONSTRAINT positive_likes CHECK (likes >=0),
    event_id integer REFERENCES events ON DELETE CASCADE,
    author_id integer REFERENCES members ON DELETE CASCADE
);

CREATE TABLE post_likes (
    user_id integer REFERENCES members ON DELETE CASCADE,
    post_id integer REFERENCES posts ON DELETE CASCADE,
    PRIMARY KEY(user_id, post_id)
);

CREATE TABLE comments (
    id integer PRIMARY KEY,
    content text NOT NULL,
    comment_date date NOT NULL DEFAULT today,
    likes integer NOT NULL DEFAULT 0 CONSTRAINT positive_likes CHECK (likes >=0),
    post_id integer REFERENCES posts ON DELETE CASCADE,
    user_id integer REFERENCES members ON DELETE CASCADE,
    parent integer REFERENCES comments ON DELETE CASCADE
);

CREATE TABLE comment_likes (
    user_id integer REFERENCES members ON DELETE CASCADE,
    comment_id integer REFERENCES comments ON DELETE CASCADE,
    PRIMARY KEY(user_id, comment_id)
);

CREATE TABLE polls (
    post_id integer PRIMARY KEY REFERENCES posts ON DELETE CASCADE,
    title text NOT NULL
);

CREATE TABLE poll_options (
    id integer PRIMARY KEY,
    post_id integer REFERENCES polls ON DELETE CASCADE,
    name text NOT NULL,
    votes integer NOT NULL DEFAULT 0 CONSTRAINT positive_votes CHECK (votes >=0)
);

CREATE TABLE poll_votes (
    poll_option_id integer REFERENCES poll_options ON DELETE CASCADE,
    user_id integer REFERENCES members ON DELETE CASCADE,
    PRIMARY KEY(poll_option_id, user_id)
);

CREATE TABLE files (
    post_id integer REFERENCES posts ON DELETE CASCADE,
    file text NOT NULL
);

CREATE TABLE threads (
    id integer PRIMARY KEY,
    content text NOT NULL,
    thread_date date NOT NULL DEFAULT today,
    event_id integer REFERENCES events ON DELETE CASCADE,
    author_id integer REFERENCES members ON DELETE CASCADE
);

CREATE TABLE thread_comments (
    id integer PRIMARY KEY,
    content text NOT NULL,
    comment_date date NOT NULL DEFAULT today,
    thread_id integer REFERENCES threads ON DELETE CASCADE,
    user_id integer REFERENCES members ON DELETE CASCADE
);

CREATE TABLE questions (
    id integer PRIMARY KEY,
    content text NOT NULL,
    event_id integer REFERENCES events ON DELETE CASCADE
);

CREATE TABLE answers (
    id integer PRIMARY KEY,
    content text NOT NULL,
    question_id integer REFERENCES questions ON DELETE CASCADE
);

CREATE TABLE user_reports (
    user_id integer REFERENCES members ON DELETE CASCADE,
    reported_user integer REFERENCES members ON DELETE CASCADE,
    report_status status NOT NULL,
    report_date date NOT NULL DEFAULT today,
    PRIMARY KEY(user_id, reported_user)
);

CREATE TABLE event_reports (
    event_id integer REFERENCES events ON DELETE CASCADE,
    user_id integer REFERENCES members ON DELETE CASCADE,
    report_status status NOT NULL,
    report_date date NOT NULL DEFAULT today,
    PRIMARY KEY(user_id, event_id)
);

CREATE TABLE currencies (
    id integer PRIMARY KEY,
    code text UNIQUE NOT NULL,
    name text UNIQUE NOT NULL
);

CREATE TABLE categories (
    id integer PRIMARY KEY,
    name text UNIQUE NOT NULL
);