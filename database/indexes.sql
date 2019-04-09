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
