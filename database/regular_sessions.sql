create table regular_sessions(
    id int(10) not null PRIMARY KEY AUTO_INCREMENT,
    member_id int(10) not null,
    package_id int(10) not null,
    package_session tinyint,
    session_taken tinyint,
    created_at datetime,
    last_update datetime
);