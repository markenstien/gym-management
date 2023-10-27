drop table if exists program_sessions;
create table program_sessions(
    id int(10) not null primary key AUTO_INCREMENT,
    program_id int(10) not null,
    attendees text,
    session_date date,
    status char(10),
    remarks text,
    created_at timestamp default now()
);