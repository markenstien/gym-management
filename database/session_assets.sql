create table session_assets(
    id int(10) not null PRIMARY KEY AUTO_INCREMENT,
    asset_id int(10) not null,
    session_id int(10) not null,
    created_at timestamp DEFAULT now(),
    updated_at timestamp DEFAULT now() ON UPDATE now()
);