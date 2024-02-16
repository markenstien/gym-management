alter table workout_sets
    add is_public boolean default false,
    add is_assigned_to int(10);