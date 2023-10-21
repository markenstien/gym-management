create table assets(
    id int(10) not null PRIMARY KEY AUTO_INCREMENT,
    title varchar(100),
    user_id int(10) comment 'if null then all users can use this asset',
    description text,
    is_active boolean default false,
    created_at timestamp default now()
);