CREATE VIEW program_participants_total as 
    SELECT count(*) as total, program_id
    FROM program_participants
    GROUP by program_id;


DROP VIEW if exists program_participants_total;




truncate programs;
truncate program_participants;
truncate program_sessions;