/**
*list of programs company offer with instructors 
*/
create table instructor_programs(
    id int(10) not null primary key auto_increment,
    program_name varchar(100),
    description text,
    is_active boolean default true,
    created_at timestamp default now()
);
/*
*dummy data
*/

INSERT INTO instructor_programs(program_name, description)
VALUES('Body Building program', 'lorem'),
('Cardio Program', 'lorem');

/*
*packages members can select
*/
create table instructor_packages(
    id int(10) not null primary key auto_increment,
    package_name varchar(100),
    program_id int(10),
    price decimal(10,2),
    sessions tinyint,
    is_active boolean default true,
    created_at timestamp default now()
);

INSERT INTO instructor_packages(package_name, program_id, price, sessions)
VALUES('Basic Body Building Package', 1, 5000, 12),
('Premium Cardio Building Package', 2, 8000, 22);


create table instructor_sessions(
    id int(10) not null primary key auto_increment,
    instructor_id int(10),
    session_name varchar(100),
    start_date date,
    start_time time,
    program_id int(10),
    status enum('pending','cancelled','completed') default 'pending',
    created_at datetime,
    created_by int(10),
    updated_at datetime
);

create table instructor_session_attendees(
    id int(10) not null primary key auto_increment,
    instructor_session_id int(10),
    user_id int(10),
    created_at timestamp default now(),
    user_confirmation datetime default null
);

/*
*for recording purposes only
*/
drop table if exists user_programs;
create table user_programs(
    id int(10) primary key auto_increment,
    instructor_id int(10),
    user_id int(10),
    program_id int(10),
    package_id int(10),
    sessions tinyint,
    is_cancelled boolean default false,
    created_at timestamp default now()
);


create table instructor_commissions(
    id int(10) not null primary key auto_increment,
    instructor_id int(10),
    user_program_id int(10),
    amount decimal(10,2),
    entry_type enum('ADD','DEDUCT'),
    remarks varchar(100),
    created_at timestamp default now()
);


alter table instructor_packages
    add column is_instructed boolean default false;

alter table instructor_packages
    add column is_member boolean default false;