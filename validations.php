<?php

    function sanitize_data($data = '') {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    function validate_required_data($data = '') {

        $data = sanitize_data($data);

        if (!empty($data))
        {
            return $data;
        }
        return FALSE;
    }

    function validate_email_data($email = '') {

        $email = sanitize_data($email);

        if(empty($email))
        {
            return '';
        }
        
        // remobe the illegal characters
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // this is to validate the email if contain the valid email address
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return $email;
        }
        return FALSE;
    }
?>