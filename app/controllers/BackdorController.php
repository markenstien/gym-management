<?php 

    class BackdorController extends Controller
    {
        public function cleanDb() {
            $db = Database::getInstance();

            $db->query(
                "truncate instructor_commissions"
            );
            $db->execute();

            $db->query(
                "truncate payments"
            );
            $db->execute();


            $db->query(
                "truncate user_programs"
            );
            $db->execute();


            $db->query(
                "truncate instructor_packages"
            );
            $db->execute();

            $db->query(
                "DELETE FROM users where user_type != 'admin'"
            );
            $db->execute();

            $db->query(
                "UPDATE users set membership_expiry_date = null"
            );
            $db->execute();
        }
    }