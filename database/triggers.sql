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

--Trigger: 