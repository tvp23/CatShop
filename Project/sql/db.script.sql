create table catshop_alerts
(
    id      int auto_increment
        primary key,
    message text                 not null,
    color   char(10)             not null,
    active  tinyint(1) default 0 not null,
    constraint catshop_alerts_id_uindex
        unique (id)
);

create table catshop_products
(
    id          int auto_increment
        primary key,
    name        char(32)       not null,
    price       decimal(15, 2) not null,
    quantity    int            not null,
    image       char(255)      null,
    description text           null,
    constraint catshop_products_id_uindex
        unique (id)
);

create table catshop_users
(
    id       int auto_increment
        primary key,
    name     char(32) not null,
    email    char(25) not null,
    password char(75) not null,
    role     char(10) not null,
    constraint catshop_users_email_uindex
        unique (email),
    constraint catshop_users_id_uindex
        unique (id)
);

