drop table if exists programs;
create table programs(
    id int(10) not null primary key AUTO_INCREMENT,
    program_name varchar(100),
    program_code char(10) unique,
    package_id int(10) not null,
    start_date date,
    description text,
    instructor_id int(10) not null,
    status varchar(10) comment 'pending,ongoing,completed,cancelled',
    sessions tinyint,
    program_amount decimal(10,2),
    created_at timestamp default now()
);