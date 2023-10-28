truncate instructor_commissions;
truncate payments;
truncate user_programs;


DELETE FROM users where user_type != 'admin';
UPDATE users set membership_expiry_date = null;

truncate instructor_packages;