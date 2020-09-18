<?php

class Register {

    protected $messages = [
        'general' => [],
        'error' => []
    ];

    const MINIMUM_AGE = 18;
    const MAXIMUM_AGE = 130;

    public function __construct($data)
    {
        $firstName = $this->sanitizeData($data['first_name']);
        $firstNameValidate = $this->validateFirstName($firstName);

        $lastName = $this->sanitizeData($data['last_name']);
        $lastNameValidate = $this->validateLastName($lastName);

        $dob = $this->sanitizeData($data['dob']);
        $dobValidate = $this->validateBirthday($dob);

        if ($dobValidate) {
            $ageValidate = $this->validateAge($dob);
        }

        $zip = $this->sanitizeData($data['zip']);
        $zipValidate = $this->validateZip($zip);

        $email = $this->sanitizeData($data['email']);
        $emailValidate = $this->validateEmail($email);

        $agreementValidate = $this->validateAgreement($data['agreement']);

        if (!count($this->messages['error']) && $firstNameValidate && $lastNameValidate && $dobValidate && $ageValidate && $zipValidate && $emailValidate && $agreementValidate) {
            $this->messages['general'][] = 'Successfully Registered';
        } else {
            $this->messages['error'][] = 'Something went wrong';
        }

        if (count($this->messages)) {
            $this->displayMessages();
        }

    }

    public function validateAgreement($agreement)
    {
        if (isset($agreement) && $agreement == '1') {
            return true;
        } else {
            $this->messages['error'][] = 'You must agree to the terms and conditions';
            return false;
        }
    }

    public function validateEmail($email)
    {
        if (isset($email)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                $this->messages['error'][] = 'Email Invalid';
                return false;
            }
        } else {
            $this->messages['error'][] = 'Email required';
            return false;
        }
    }

    public function validateZip($zip)
    {
        if (isset($zip) && is_numeric($zip)) {
            if (strlen($zip) > 5) {
                $this->messages['error'][] = 'Zip Code too long';
                return false;
            } elseif (strlen($zip) < 5) {
                $this->messages['error'][] = 'Zip Code not long enough';
                return false;
            } else {
                return true;
            }
        } else {
            $this->messages['error'][] = 'Zip invalid, US zip codes only, must only contain numbers.';
            return false;
        }
    }
    

    public function validateAge(string $dob)
    {
        $dob = new DateTime($dob);
        $today = new DateTime();
        $age = $today->diff($dob)->y;

        if ($this->isBirthday($dob, $today)) {
            $this->messages['general'][] = 'Happy Birthday';
        }

        if ($age >= self::MAXIMUM_AGE) {
            $this->messages['error'][] = 'You\'re Probably not that old.';
            return false;
        }

        if ($age < self::MINIMUM_AGE) {
            $this->messages['error'][] = 'You must be 18 or older to participate';
            return false;
        }

        return true;
    }

    public function isBirthday(DateTime $dob, DateTime $today) : bool
    {
        if ($dob->format('m-d') == $today->format('m-d')) {
            return true;
        } else {
            return false;
        }
    }

    public function validateFirstName(string $firstName) : bool
    {
        if (isset($firstName)) {
            return true;
        } else {
            $this->messages['error'][] = 'First Name Missing';
            return false;
        }
    }

    public function validateLastName(string $lastName) : bool
    {
        if (isset($lastName)) {
            return true;
        } else {
            $this->messages['error'][] = 'Last Name Missing';
            return false;
        }
    }

    public function validateBirthday(string $dob)
    {
        $format = 'Y-m-d';

        if (isset($dob) && $dob != '') {
            $dobDateTime = DateTime::createFromFormat($format, $dob);
            if ($dobDateTime && $dobDateTime->format($format) == $dob) {
                return true;
            } else {
                $this->messages['error'][] = 'Date of birth formatted incorrectly';
                return false;
            }
        } else {
            $this->messages['error'][] = 'Date of birth missing';
            return false;
        }
    }

    public function sanitizeData($value)
    {
        return htmlspecialchars(stripslashes(trim($value)), ENT_QUOTES);
    }

    public function displayMessages()
    {
        foreach ($this->messages as $key => $messages) {
            foreach ($messages as $message) {
                echo $key.': '. $message . '<br>';
            }
        }
    }

}

$register = new Register($_POST);

