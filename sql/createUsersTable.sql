CREATE TABLE users
(
  id SERIAL PRIMARY KEY,
  email character varying(255) NOT NULL UNIQUE,
  password character varying(255) NOT NULL,
  first_name character varying(255),
  last_name character varying(255),
  university_id bigint NOT NULL REFERENCES universities(id),
  course_id bigint NOT NULL REFERENCES courses(id)
)
