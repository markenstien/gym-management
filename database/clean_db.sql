truncate instructor_commissions;
truncate instructor_sessions;
truncate instructor_session_attendees;
truncate payments;
truncate user_programs;

DELETE FROM users where user_type != 'admin';