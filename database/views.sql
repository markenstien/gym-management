DROP VIEW if exists program_participants_total;
CREATE VIEW program_participants_total as 
    SELECT count(*) as total, program_id
    FROM program_participants
    GROUP by program_id;

DROP VIEW IF exists v_program_participants;
CREATE VIEW v_program_participants AS SELECT 
    pp.id as id,
    sessions_taken as sessions_taken,
    payments as member_payment,
    
    program_name, program_code,
    program.start_date, program.sessions as program_session,
    program.status as program_status,
    program.id as program_id,

    instructor.firstname as instructor_firstname,
    instructor.lastname as instructor_lastname,
    instructor.id as instructor_id,

    member.firstname as member_firstname,
    member.lastname as member_lastname,
    member.membership_expiry_date,
    member.gender, member.user_identification,
    member.email, member.phone,
    member.id as member_id

    FROM program_participants as pp
        LEFT JOIN programs as program
            ON pp.program_id = program.id

        LEFT JOIN users as instructor
            ON instructor.id = program.instructor_id

        LEFT JOIN users as member
            ON member.id = pp.member_id;





DROP VIEW IF exist v_instructed_sessions;
DROP VIEW IF exists v_sessions;
CREATE VIEW v_sessions AS SELECT 
    u_session.id as id,
    u_session.created_at as created_at,
    u_session.last_update as last_update,
    u_session.session_type,
    session_taken, package_session,
    package_name,price,
    consume_type,

    instructor.firstname as instructor_firstname,
    instructor.lastname as instructor_lastname,
    instructor.id as instructor_id,

    member.firstname as member_firstname,
    member.lastname as member_lastname,
    member.membership_expiry_date,
    member.gender, member.user_identification,
    member.email, member.phone,
    member.id as member_id

    FROM sessions as u_session
        LEFT JOIN instructor_packages as instructor_packge
            ON u_session.package_id = instructor_packge.id

        LEFT JOIN users as instructor
            ON instructor.id = u_session.instructor_id

        LEFT JOIN users as member
            ON member.id = u_session.member_id;


DROP VIEW IF exists v_regular_sessions;
CREATE VIEW v_regular_sessions AS SELECT 
    regular_session.id as id,
    regular_session.created_at as created_at,
    regular_session.last_update as last_update,
    session_taken, package_session,
    package_name,price,

    member.firstname as member_firstname,
    member.lastname as member_lastname,
    member.membership_expiry_date,
    member.gender, member.user_identification,
    member.email, member.phone,
    member.id as member_id

    FROM regular_sessions as regular_session
        LEFT JOIN instructor_packages as instructor_packge
            ON regular_session.package_id = instructor_packge.id

        LEFT JOIN users as member
            ON member.id = regular_session.member_id;