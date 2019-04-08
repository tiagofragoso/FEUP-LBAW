DROP TABLE IF EXISTS categories CASCADE;
DROP TABLE IF EXISTS currencies CASCADE;
DROP TABLE IF EXISTS event_reports CASCADE;
DROP TABLE IF EXISTS user_reports CASCADE;
DROP TABLE IF EXISTS answers CASCADE;
DROP TABLE IF EXISTS questions CASCADE;
DROP TABLE IF EXISTS thread_comments CASCADE;
DROP TABLE IF EXISTS threads CASCADE;
DROP TABLE IF EXISTS files CASCADE;
DROP TABLE IF EXISTS poll_votes CASCADE;
DROP TABLE IF EXISTS poll_options CASCADE;
DROP TABLE IF EXISTS polls CASCADE;
DROP TABLE IF EXISTS comment_likes CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS post_likes CASCADE;
DROP TABLE IF EXISTS posts CASCADE;
DROP TABLE IF EXISTS follows CASCADE;
DROP TABLE IF EXISTS invite_requests CASCADE;
DROP TABLE IF EXISTS participations CASCADE;
DROP TABLE IF EXISTS tickets CASCADE;
DROP TABLE IF EXISTS events CASCADE;
DROP TABLE IF EXISTS admins CASCADE;
DROP TABLE IF EXISTS members CASCADE;
DROP TABLE IF EXISTS users CASCADE;

DROP TYPE IF EXISTS event_type CASCADE;
DROP TYPE IF EXISTS event_status CASCADE;
DROP TYPE IF EXISTS participation_type CASCADE;
DROP TYPE IF EXISTS "status" CASCADE;
DROP TYPE IF EXISTS post_type CASCADE;

CREATE TYPE event_type AS ENUM ('Concert', 'Festival', 'Liveset');
CREATE TYPE event_status AS ENUM ('Planning', 'Tickets', 'Live');
CREATE TYPE participation_type AS ENUM ('Host', 'Artist', 'Owner', 'Participant');
CREATE TYPE "status" AS ENUM ('Pending', 'Accepted', 'Declined');
CREATE TYPE post_type AS ENUM ('Post', 'Poll', 'File');

CREATE TABLE users (
    id serial PRIMARY KEY,
    "name" varchar(30),
    username varchar(15) UNIQUE NOT NULL,
    email varchar(255) UNIQUE NOT NULL,
    "password" text NOT NULL
);

CREATE TABLE members (
    "user_id" integer PRIMARY KEY REFERENCES users ON DELETE CASCADE,
    birthdate date,
    followers integer NOT NULL DEFAULT 0 CONSTRAINT positive_followers CHECK (followers >= 0),
    "following" integer NOT NULL DEFAULT 0 CONSTRAINT positive_following CHECK ("following" >= 0),
    banned boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE admins (
    "user_id" integer PRIMARY KEY REFERENCES users ON DELETE CASCADE
);

CREATE TABLE currencies (
    id serial PRIMARY KEY,
    code varchar(3) UNIQUE NOT NULL,
    "name" text UNIQUE NOT NULL
);

CREATE TABLE categories (
    id serial PRIMARY KEY,
    "name" varchar(20) UNIQUE NOT NULL
);

CREATE TABLE events (
    id serial PRIMARY KEY,
    title varchar(60) NOT NULL,
    "start_date" timestamp CONSTRAINT future_start_date CHECK ("start_date" > CURRENT_TIMESTAMP),
    "end_date" timestamp CONSTRAINT future_end_date CHECK ("end_date" > CURRENT_TIMESTAMP),
    "location" varchar(50),
    "address" varchar(100),
    participants integer NOT NULL DEFAULT 0 CONSTRAINT positive_participants CHECK (participants >= 0),
    price numeric DEFAULT 0 CONSTRAINT positive_price CHECK (price >= 0),
    brief varchar(140),
    "description" text,
    ticket_sale_start_date timestamp CONSTRAINT future_ticket_sale_date CHECK ("ticket_sale_start_date" > CURRENT_TIMESTAMP),
    banned boolean NOT NULL DEFAULT FALSE,
    "type" event_type NOT NULL,
    "private" boolean NOT NULL DEFAULT FALSE,
    "status" event_status NOT NULL,
    currency integer NOT NULL REFERENCES currencies ON DELETE CASCADE,
    category integer NOT NULL REFERENCES categories ON DELETE CASCADE
    CONSTRAINT event_dates_integrity CHECK ("start_date" < "end_date"),
    CONSTRAINT ticket_sale_date_integrity CHECK ("ticket_sale_start_date" < "start_date")
);

CREATE TABLE tickets (
    id serial PRIMARY KEY,
    qrcode text NOT NULL,
    purchase_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_purchase_date CHECK ("purchase_date" <= CURRENT_TIMESTAMP),
    price numeric NOT NULL CONSTRAINT positive_price CHECK (price >= 0),
    "owner" integer NOT NULL REFERENCES members ON DELETE CASCADE,
    event_id integer NOT NULL REFERENCES events ON DELETE CASCADE
);

CREATE TABLE participations (
    id serial PRIMARY KEY,
    "user_id" integer NOT NULL REFERENCES members ON DELETE CASCADE,
    event_id integer NOT NULL REFERENCES events ON DELETE CASCADE,
    "type" participation_type NOT NULL,
    "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_date CHECK ("date" <= CURRENT_TIMESTAMP),
    UNIQUE("user_id", event_id)
);

CREATE TABLE invite_requests (
    id serial PRIMARY KEY,
    "user_id" integer NOT NULL REFERENCES members ON DELETE CASCADE,
    invited_user_id integer NOT NULL REFERENCES members ON DELETE CASCADE,
    event_id integer NOT NULL REFERENCES events ON DELETE CASCADE,
    "type" participation_type NOT NULL,
    "status" status NOT NULL DEFAULT 'Pending',
    "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_date CHECK ("date" <= CURRENT_TIMESTAMP)
);

CREATE TABLE follows (
    follower_id integer REFERENCES members ON DELETE CASCADE,
    followed_id integer REFERENCES members ON DELETE CASCADE,
    PRIMARY KEY (follower_id, followed_id)
);

CREATE TABLE posts (
    id serial PRIMARY KEY,
    content varchar(5000) NOT NULL,
    "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_date CHECK ("date" <= CURRENT_TIMESTAMP),
    likes integer NOT NULL DEFAULT 0 CONSTRAINT positive_likes CHECK (likes >= 0),
    comments integer NOT NULL DEFAULT 0 CONSTRAINT positive_comments CHECK (comments >= 0),
    event_id integer NOT NULL REFERENCES events ON DELETE CASCADE,
    author_id integer NOT NULL REFERENCES members ON DELETE CASCADE,
    "type" post_type NOT NULL DEFAULT 'Post'
);

CREATE TABLE post_likes (
    "user_id" integer REFERENCES members ON DELETE CASCADE,
    post_id integer REFERENCES posts ON DELETE CASCADE,
    PRIMARY KEY("user_id", post_id)
);

CREATE TABLE comments (
    id serial PRIMARY KEY,
    content varchar(2500) NOT NULL,
    "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_date CHECK ("date" <= CURRENT_TIMESTAMP),
    likes integer NOT NULL DEFAULT 0 CONSTRAINT positive_likes CHECK (likes >= 0),
    post_id integer NOT NULL REFERENCES posts ON DELETE CASCADE,
    "user_id" integer NOT NULL REFERENCES members ON DELETE CASCADE,
    parent integer REFERENCES comments ON DELETE CASCADE
);


CREATE TABLE comment_likes (
    "user_id" integer REFERENCES members ON DELETE CASCADE,
    comment_id integer REFERENCES comments ON DELETE CASCADE,
    PRIMARY KEY("user_id", comment_id)
);

CREATE TABLE polls (
    post_id integer PRIMARY KEY REFERENCES posts ON DELETE CASCADE,
    title varchar(100) NOT NULL 
);

CREATE TABLE poll_options (
    id serial PRIMARY KEY,
    post_id integer NOT NULL REFERENCES polls ON DELETE CASCADE,
    "name" varchar(30) NOT NULL,
    votes integer NOT NULL DEFAULT 0 CONSTRAINT positive_votes CHECK (votes >= 0)
);

CREATE TABLE poll_votes (
    poll_id integer REFERENCES polls ON DELETE CASCADE,
    "user_id" integer REFERENCES members ON DELETE CASCADE,
    poll_option integer NOT NULL REFERENCES poll_options,
    PRIMARY KEY(poll_id, "user_id")
);

CREATE TABLE files (
    post_id integer PRIMARY KEY REFERENCES posts ON DELETE CASCADE,
    "file" text NOT NULL 
);

CREATE TABLE threads (
    id serial PRIMARY KEY,
    content varchar(5000) NOT NULL,
    "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_date CHECK ("date" <= CURRENT_TIMESTAMP),
    event_id integer NOT NULL REFERENCES events ON DELETE CASCADE,
    author_id integer NOT NULL REFERENCES members ON DELETE CASCADE
);

CREATE TABLE thread_comments (
    id serial PRIMARY KEY,
    content varchar(2500) NOT NULL,
    "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_date CHECK ("date" <= CURRENT_TIMESTAMP),
    thread_id integer NOT NULL REFERENCES threads ON DELETE CASCADE,
    "user_id" integer NOT NULL REFERENCES members ON DELETE CASCADE
);

CREATE TABLE questions (
    id serial PRIMARY KEY,
    content varchar(1000) NOT NULL,
    event_id integer NOT NULL REFERENCES events ON DELETE CASCADE
);

CREATE TABLE answers (
    question_id integer PRIMARY KEY REFERENCES questions ON DELETE CASCADE,
    content varchar(1000) NOT NULL
);

CREATE TABLE user_reports (
    "user_id" integer REFERENCES members ON DELETE CASCADE,
    reported_user integer REFERENCES members ON DELETE CASCADE,
    "status" status NOT NULL DEFAULT 'Pending',
    "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_date CHECK ("date" <= CURRENT_TIMESTAMP),
    PRIMARY KEY("user_id", reported_user)
);

CREATE TABLE event_reports (
    event_id integer REFERENCES events ON DELETE CASCADE,
    "user_id" integer REFERENCES members ON DELETE CASCADE,
    "status" status NOT NULL DEFAULT 'Pending',
    "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP CONSTRAINT past_date CHECK ("date" <= CURRENT_TIMESTAMP),
    PRIMARY KEY("user_id", event_id)
);
