<?php

defined('SYSPATH') or die('No direct script access.');

return array( 
    // Fields
    'field.email' => 'email',
    'field.name' => 'name',
    'field.phone' => 'phone',
    'field.zip_code' => 'zip code',
    // Validation
    'validation.alpha' => ':field must contain only letters',
    'validation.alpha_dash' => ':field must contain only numbers, letters and dashes',
    'validation.alpha_numeric' => ':field must contain only letters and numbers',
    'validation.color' => ':field must be a color',
    'validation.credit_card' => ':field must be a credit card number',
    'validation.date' => ':field must be a date',
    'validation.decimal' => ':field must be a decimal with :param2 places',
    'validation.digit' => ':field must be a digit',
    'validation.email' => ':field must be a email address',
    'validation.email_domain' => ':field must contain a valid email domain',
    'validation.equals' => ':field must equal :param2',
    'validation.exact_length' => ':field must be exactly :param2 characters long',
    'validation.in_array' => ':field must be one of the available options',
    'validation.ip' => ':field must be an ip address',
    'validation.matches' => ':field must be the same as :param2',
    'validation.min_length' => ':field must be at least :param2 characters long',
    'validation.max_length' => ':field must not exceed :param2 characters long',
    'validation.not_empty' => ':field must not be empty',
    'validation.numeric' => ':field must be numeric',
    'validation.phone' => ':field must be a phone number',
    'validation.range' => ':field must be within the range of :param2 to :param3',
    'validation.regex' => ':field does not match the required format',
    'validation.url' => ':field must be a url',
);
?>
