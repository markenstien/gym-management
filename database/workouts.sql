create table workouts(
    id int(10) not null PRIMARY KEY AUTO_INCREMENT,
    workout_name varchar(100),
    workout_tag varchar(100),
    created_at timestamp DEFAULT now(),
    created_by int(10),
    updated_at timestamp DEFAULT now() ON UPDATE now()
);


create table workout_sets(
    id int(10) not null PRIMARY KEY AUTO_INCREMENT,
    set_name varchar(100),
    set_tag varchar(100) comment 'eg. abs, chest',
    schedule enum('Sun','Mon','Tue','Wed','Thu','Fri','Sat'),
    user_id int(10) not null,

    last_set_taken datetime comment 'the last time the user played this set',
    created_at timestamp DEFAULT now(),
    updated_at timestamp DEFAULT now() ON UPDATE now()
);

drop table if exists workout_set_items;
create table workout_set_items(
    id int(10) not null PRIMARY KEY AUTO_INCREMENT,
    workout_set_id int(10),
    workout_id int(10) not null,
    rep_count tinyint default 1,
    work_time_hr tinyint default 0,
    work_time_min tinyint default 0,
    work_time_sec tinyint default 0,

    rest_time_hr tinyint default 0,
    rest_time_min tinyint default 0,
    rest_time_sec tinyint default 0,
    
    is_completed boolean default false,
    last_set_item_taken datetime
);