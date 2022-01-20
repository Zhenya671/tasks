
CREATE TABLE users
(
    id_user      INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email        varchar(256) NOT NULL UNIQUE,
    first_name   varchar(128) NOT NULL,
    last_name    varchar(128) NOT NULL,
    password     varchar(256) NOT NULL,
    created_date timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_general_ci;

SELECT * FROM `users`