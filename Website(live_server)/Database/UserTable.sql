create table users
(
    id         int auto_increment
        primary key,
    firstName  varchar(50)                           not null,
    lastName   varchar(50)                           not null,
    email      varchar(100)                          not null,
    password   varchar(255)                          not null,
    user_image longblob                              null,
    isAdmin    tinyint(1)                            not null default 0,
    created_at timestamp default current_timestamp() not null,
    constraint email
        unique (email)
);
