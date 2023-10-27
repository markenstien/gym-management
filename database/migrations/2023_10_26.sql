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
    member.id as member_id

    FROM program_participants as pp
        LEFT JOIN programs as program
            ON pp.program_id = program.id

        LEFT JOIN users as instructor
            ON instructor.id = program.instructor_id

        LEFT JOIN users as member
            ON member.id = pp.member_id;



alter table payments add column net_amount decimal(10,2),
add column internal_remarks text;