CREATE TABLE learning_groups_users
(
  learning_group_id bigint NOT NULL REFERENCES learning_groups(id),
  user_id bigint NOT NULL REFERENCES users(id),
  PRIMARY KEY(learning_group_id, user_id)
)
