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