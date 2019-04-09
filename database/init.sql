-- Schema

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
    category integer NOT NULL REFERENCES categories ON DELETE CASCADE,
    search tsvector,
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

-- Triggers

--Trigger: participations_count

DROP TRIGGER IF EXISTS participations_count ON participations;

CREATE OR REPLACE FUNCTION participations_count() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
        UPDATE events
        SET participants = participants + 1
        WHERE New.event_id = events.id AND New.type = 'Participant';
    END IF;

    IF TG_OP = 'DELETE' THEN
        UPDATE events
        SET participants = participants - 1
        WHERE Old.event_id = events.id AND Old.type = 'Participant';
    END IF;
    RETURN NEW;
END
$BODY$ 
LANGUAGE 'plpgsql';

CREATE TRIGGER participations_count
    AFTER INSERT OR DELETE ON participations
    FOR EACH ROW
    EXECUTE PROCEDURE participations_count();


--Trigger: post_likes_count

DROP TRIGGER IF EXISTS post_likes_count ON post_likes;

CREATE OR REPLACE FUNCTION post_likes_count() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
        UPDATE posts
        SET likes = likes + 1
        WHERE New.post_id = posts.id;
    END IF;

    IF TG_OP = 'DELETE' THEN
        UPDATE posts
        SET likes = likes - 1
        WHERE Old.post_id = posts.id;
    END IF;
    RETURN NEW;
END
$BODY$ 
LANGUAGE 'plpgsql';

CREATE TRIGGER post_likes_count
    AFTER INSERT OR DELETE ON post_likes
    FOR EACH ROW
    EXECUTE PROCEDURE post_likes_count();

--Trigger: comment_likes_count

DROP TRIGGER IF EXISTS comment_likes_count ON comment_likes;

CREATE OR REPLACE FUNCTION comment_likes_count() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
        UPDATE comments
        SET likes = likes + 1
        WHERE New.comment_id = comments.id;
    END IF;

    IF TG_OP = 'DELETE' THEN
        UPDATE comments
        SET likes = likes - 1
        WHERE Old.comment_id = comments.id;
    END IF;
    RETURN NEW;
END
$BODY$ 
LANGUAGE 'plpgsql';

CREATE TRIGGER comment_likes_count
    AFTER INSERT OR DELETE ON comment_likes
    FOR EACH ROW
    EXECUTE PROCEDURE comment_likes_count();

--Trigger: comments_count

DROP TRIGGER IF EXISTS comments_count ON comments;

CREATE OR REPLACE FUNCTION comments_count() RETURNS TRIGGER AS
$BODY$
BEGIN   
    UPDATE posts
    SET comments = comments + 1
    WHERE New.post_id = posts.id;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER comments_count
    AFTER INSERT ON comments
    FOR EACH ROW
    EXECUTE PROCEDURE comments_count();

--Trigger: followers_count

DROP TRIGGER IF EXISTS followers_count ON follows;

CREATE OR REPLACE FUNCTION followers_count() RETURNS TRIGGER AS
$BODY$
BEGIN 
    IF TG_OP = 'INSERT' THEN
        UPDATE members
        SET "following" = "following" + 1
        WHERE New.follower_id = members.user_id;
    
        UPDATE members
        SET followers = followers + 1
        WHERE New.followed_id = members.user_id;
    END IF;

    IF TG_OP = 'DELETE' THEN
        UPDATE members
        SET "following" = "following" - 1
        WHERE Old.follower_id = members.user_id;
    
        UPDATE members
        SET followers = followers - 1
        WHERE Old.followed_id = members.user_id;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER followers_count
    AFTER INSERT OR DELETE ON follows
    FOR EACH ROW
    EXECUTE PROCEDURE followers_count();

--Trigger: accept_invitation

DROP TRIGGER IF EXISTS accept_invitation ON invite_requests;

CREATE OR REPLACE FUNCTION accept_invitation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF New.status = 'Accepted' THEN
        INSERT INTO participations("user_id", event_id, "type")
        VALUES (New.invited_user_id, New.event_id, New.type);
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER accept_invitation
    AFTER UPDATE ON invite_requests
    FOR EACH ROW
    EXECUTE PROCEDURE accept_invitation();

--Trigger: poll_option_votes

DROP TRIGGER IF EXISTS poll_option_votes ON poll_votes;

CREATE OR REPLACE FUNCTION poll_option_votes() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE poll_options
    SET votes = votes + 1
    WHERE New.poll_option = poll_options.id;

    IF TG_OP = 'UPDATE' THEN
        UPDATE poll_options
        SET votes = votes - 1
        WHERE Old.poll_option = poll_options.id;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER poll_option_votes
    AFTER INSERT OR UPDATE ON poll_votes
    FOR EACH ROW
    EXECUTE PROCEDURE poll_option_votes();

--Trigger: event_owner

DROP TRIGGER IF EXISTS event_owner ON participations;

CREATE OR REPLACE FUNCTION event_owner() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS 
        (SELECT * FROM participations WHERE New.event_id = event_id AND "type" = 'Owner')
    AND New.type = 'Owner' THEN 
        RAISE EXCEPTION 'An event can only have one owner';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER event_owner
    BEFORE INSERT OR UPDATE ON participations
    FOR EACH ROW
    EXECUTE PROCEDURE event_owner();

--Trigger: create_poll

DROP TRIGGER IF EXISTS create_poll ON polls;

CREATE OR REPLACE FUNCTION create_poll() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE posts
    SET "type" = 'Poll'
    WHERE New.post_id = posts.id;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER create_poll
    AFTER INSERT ON polls
    FOR EACH ROW
    EXECUTE PROCEDURE create_poll();

--Trigger: create_file

DROP TRIGGER IF EXISTS create_file ON files;

CREATE OR REPLACE FUNCTION create_file() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE posts
    SET "type" = 'File'
    WHERE New.post_id = posts.id;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER create_file
    AFTER INSERT ON files
    FOR EACH ROW
    EXECUTE PROCEDURE create_file();

--Trigger: ban_user

DROP TRIGGER IF EXISTS ban_user ON user_reports;

CREATE OR REPLACE FUNCTION ban_user() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF New.status = 'Accepted' THEN
        UPDATE members 
        SET banned = true
        WHERE New.reported_user = members.user_id;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER ban_user
    AFTER UPDATE ON user_reports
    FOR EACH ROW
    EXECUTE PROCEDURE ban_user();

--Trigger: ban_event

DROP TRIGGER IF EXISTS ban_event ON event_reports;

CREATE OR REPLACE FUNCTION ban_event() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF New.status = 'Accepted' THEN
        UPDATE events 
        SET banned = true
        WHERE New.event_id = events.id;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER ban_event
    AFTER UPDATE ON event_reports
    FOR EACH ROW
    EXECUTE PROCEDURE ban_event();

--Trigger: make_invitation

DROP TRIGGER IF EXISTS make_invitation ON invite_requests;

CREATE OR REPLACE FUNCTION make_invitation() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS 
        (SELECT * FROM participations WHERE "user_id" = New.user_id AND event_id = New.event_id AND ("type" = 'Owner' OR "type" = 'Host'))
    THEN RAISE EXCEPTION 'Only a host or event owner can make invitations';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';

CREATE TRIGGER make_invitation
    BEFORE INSERT ON invite_requests
    FOR EACH ROW
    EXECUTE PROCEDURE make_invitation();

--Trigger: event_search_update

DROP TRIGGER IF EXISTS event_search_update ON events;

CREATE OR REPLACE FUNCTION event_search_update() RETURNS TRIGGER AS 
$BODY$
BEGIN
	IF TG_OP = 'INSERT' THEN
		NEW.search = setweight(to_tsvector('english', NEW.title), 'A') || setweight(to_tsvector('english', NEW.brief), 'B') || 
		setweight(to_tsvector('english', NEW.description), 'C') ;
	END IF;
	IF TG_OP = 'UPDATE' THEN
		IF NEW.title <> OLD.title OR NEW.brief <> OLD.brief OR NEW.description <> OLD.description THEN
			NEW.search = setweight(to_tsvector('english', NEW.title), 'A') || setweight(to_tsvector('english', NEW.brief), 'B') || 
			setweight(to_tsvector('english', NEW.description), 'C') ;
		END IF;
	END IF;
	RETURN NEW;
END
$BODY$ 
LANGUAGE 'plpgsql';

CREATE TRIGGER event_search_update
    BEFORE INSERT OR UPDATE ON events 
    FOR EACH ROW
    EXECUTE PROCEDURE event_search_update();

-- Indexes

DROP INDEX IF EXISTS trending_idx;
CREATE INDEX trending_idx ON events ("private", "start_date", participants);

DROP INDEX IF EXISTS search_idx;
CREATE INDEX search_idx ON events USING GIN (search);

DROP INDEX IF EXISTS participation_event_user_idx;
CREATE INDEX participation_event_user_idx ON participations (event_id, "user_id");

DROP INDEX IF EXISTS participation_event_type_idx;
CREATE INDEX participation_event_type_idx ON participations (event_id, "type");

DROP INDEX IF EXISTS post_event_idx;
CREATE INDEX post_event_idx ON posts (event_id, "date");

DROP INDEX IF EXISTS poll_post_idx;
CREATE INDEX poll_post_idx ON poll_options USING hash (post_id);

DROP INDEX IF EXISTS question_event_idx;
CREATE INDEX question_event_idx ON questions USING hash (event_id);

DROP INDEX IF EXISTS feed_participations_idx;
CREATE INDEX feed_participations_idx ON participations ("user_id", "date");

DROP INDEX IF EXISTS username_idx;
CREATE INDEX username_idx ON users USING hash ("username");

DROP INDEX IF EXISTS invite_requests_idx;
CREATE INDEX invite_requests_idx ON invite_requests ("user_id", "status");
