CREATE TABLE lectures
(
  id SERIAL PRIMARY KEY,
  name character varying(255) NOT NULL,
  university_id bigint NOT NULL REFERENCES universities(id),
  course_id bigint NOT NULL REFERENCES courses(id)
)
