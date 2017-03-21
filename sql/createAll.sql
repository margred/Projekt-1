CREATE TABLE universities
(
  id SERIAL PRIMARY KEY,
  name character varying(255)
);

CREATE TABLE courses
(
  id SERIAL PRIMARY KEY,
  name character varying(255)
);

CREATE TABLE users
(
  id SERIAL PRIMARY KEY,
  email character varying(255) NOT NULL UNIQUE,
  password character varying(255) NOT NULL,
  first_name character varying(255),
  last_name character varying(255),
  university_id bigint NOT NULL REFERENCES universities(id),
  course_id bigint NOT NULL REFERENCES courses(id)
);

CREATE TABLE lectures
(
  id SERIAL PRIMARY KEY,
  name character varying(255) NOT NULL,
  university_id bigint NOT NULL REFERENCES universities(id),
  course_id bigint NOT NULL REFERENCES courses(id)
);

CREATE TABLE learning_groups
(
  id SERIAL PRIMARY KEY,
  lecture_id bigint NOT NULL REFERENCES lectures(id),
  location character varying(255)
);

CREATE TABLE learning_groups_users
(
  learning_group_id bigint NOT NULL REFERENCES learning_groups(id),
  user_id bigint NOT NULL REFERENCES users(id),
  PRIMARY KEY(learning_group_id, user_id)
);

INSERT INTO public.universities (id, name) VALUES (1, 'HAW Hamburg');
INSERT INTO public.universities (id, name) VALUES (2, 'University Hamburg');
INSERT INTO public.universities (id, name) VALUES (3, 'TU Hamburg');

INSERT INTO public.courses (id, name) VALUES (1, 'Media Systems');
INSERT INTO public.courses (id, name) VALUES (2, 'Medien Technik');

INSERT INTO public.lectures (id, name, university_id, course_id) VALUES (1, 'Programmieren 1', 1, 1);
INSERT INTO public.lectures (id, name, university_id, course_id) VALUES (2, 'Projekte 1', 1, 1);
INSERT INTO public.lectures (id, name, university_id, course_id) VALUES (3, 'Tontechnik', 1, 2);
