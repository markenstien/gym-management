alter table users 
    add column is_active boolean default false;


/*
clean users*/

truncate instructor_packages;
truncate instructor_programs;
truncate instructor_sessions;
truncate instructor_session_attendees;
truncate session_assets;
truncate payments;