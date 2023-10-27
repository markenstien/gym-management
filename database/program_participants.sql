create table program_participants(
    id int(10) not null primary key AUTO_INCREMENT,
    program_id int(10),
    member_id int(10),
    sessions_taken tinyint comment 'number of times this participant attended the session',
    payments decimal(10,2) comment 'if payment adjustments is available',
    status char(10) comment 'completed, on-going, cancelled',
    created_at timestamp default now()
);