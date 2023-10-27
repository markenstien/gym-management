truncate instructor_commissions;
truncate instructor_sessions;
truncate instructor_session_attendees;
truncate instructed_sessions;
truncate regular_sessions;
truncate payments;
truncate user_programs;


DELETE FROM users where user_type != 'admin';
UPDATE users set membership_expiry_date = null;

truncate instructor_packages;