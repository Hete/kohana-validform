<?php

defined('SYSPATH') or die('No direct script access.');

return array(
    "notifications.error" => ":message pour le champ :field",
    "validform.formisinvalid" => "Le formulaire est invalide",
    "validform.errorforfield" => "Erreurs pour :field",
    // Validation
    'validation.alpha' => ':field doit contenir uniquement des lettres',
    'validation.alpha_dash' => ':field doit contenir uniquement des lettres, des chiffres et des dash',
    'validation.alpha_numeric' => ':field must doit contenir uniquement des lettres et des chiffres',
    'validation.color' => ':field doit être une couleur',
    'validation.credit_card' => ':field doit être un numéro de carte de crédit',
    'validation.date' => ':field doit être une date',
    'validation.decimal' => ':field doit être un nombre avec :param2 décimales',
    'validation.digit' => ':field must be a digit',
    'validation.email' => ':field doit être une adresse courriel',
    'validation.email_domain' => ':field must contain a valid email domain',
    'validation.equals' => ':field doit être égal à :param2',
    'validation.exact_length' => ':field doit contenir exactement :param2 caractères',
    'validation.in_array' => ':field must be one of the available options',
    'validation.ip' => ':field doit être une adresse ip',
    'validation.matches' => ':field doit être égal à :param2',
    'validation.min_length' => ':field must be at least :param2 characters long',
    'validation.max_length' => ':field must not exceed :param2 characters long',
    'validation.not_empty' => ':field ne doit pas être vide',
    'validation.numeric' => ':field doit être numérique',
    'validation.phone' => ':field doit être un numéro de téléphone',
    'validation.range' => ':field must be within the range of :param2 to :param3',
    'validation.regex' => ':field does not match the required format',
    'validation.url' => ':field doit être un url',
);
?>
