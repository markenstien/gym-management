<?php
    namespace Services;

    class UserService {
        const ADMIN = 'ADMIN';
        const STAFF = 'STAFF';
        const MEMBER = 'MEMBER';

        public function getTypes() {
            return [
                self::ADMIN,
                self::STAFF,
                self::MEMBER
            ];
        }
    }