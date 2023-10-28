alter table instructor_packages
    add column consume_type char(50);

alter table instructor_packages
    add column auto_last_update datetime;


alter table assets
    add column asset_category char(50);


UPDATE instructor_packages
    SET auto_last_update = '2023-10-26';
