<?php

defined('SYSPATH') or die('No direct script access.');

return array(
    // Fields
    'field.address' => 'adresse',
    'field.city' => 'ville',
    'field.email' => 'courriel',
    'field.name' => 'nom',
    'field.phone' => 'téléphone',
    'field.state' => 'état',
    'field.zip_code' => 'code postal',
    // Validation
    'validation.alpha' => ':field doit contenir uniquement des lettres',
    'validation.alpha_dash' => ':field doit contenir uniquement des lettres, des chiffres et des dash',
    'validation.alpha_numeric' => ':field must doit contenir uniquement des lettres et des chiffres',
    'validation.color' => ':field doit être une couleur',
    'validation.credit_card' => ':field doit être un numéro de carte de crédit',
    'validation.date' => ':field doit être une date',
    'validation.decimal' => ':field doit être un nombre avec :param2 décimales',
    'validation.digit' => ':field doit être un chiffre',
    'validation.email' => ':field doit être une adresse courriel',
    'validation.email_domain' => ":field doit provenir d'un domaine existant",
    'validation.equals' => ':field doit être égal à :param2',
    'validation.exact_length' => ':field doit contenir exactement :param2 caractères',
    'validation.in_array' => ':field doit être une des options disponibles',
    'validation.ip' => ':field doit être une adresse ip',
    'validation.matches' => ':field doit être égal à :param2',
    'validation.min_length' => ":field doit être d'au moins :param2 caractères",
    'validation.max_length' => ':field ne doit pas excéder :param2 caractères',
    'validation.not_empty' => ':field ne doit pas être vide',
    'validation.numeric' => ':field doit être numérique',
    'validation.phone' => ':field doit être un numéro de téléphone',
    'validation.range' => ':field doit être entre :param2 et :param3 inclusivement',
    'validation.regex' => ':field doit correspondre au format requis',
    'validation.url' => ':field doit être un url',
);
?>
