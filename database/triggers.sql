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
