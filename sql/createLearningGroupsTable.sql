CREATE TABLE learning_groups
(
  id SERIAL PRIMARY KEY,
  lecture_id bigint NOT NULL REFERENCES lectures(id),
  location character varying(255)
)
