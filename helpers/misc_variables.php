<?php

$fieldSpecs = [
    'userType' => [
        'null'=>false, 
        'charValidate'=>false, 
        'password'=>false, 
        'match'=>false, 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please select a user type',
        'uniqueValue'=>false,
        'uniqueValueExistsMessage'=>false,
        'uniqueValueModel'=>false,
        'uniqueValueTable'=>false,
        'uniqueValueTableId'=>false,
        'uniqueValueField'=>false,
    ],

    'firstName' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>false, 
        'match'=>false, 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please enter a first name',
        'uniqueValue'=>false,
        'uniqueValueExistsMessage'=>false,
        'uniqueValueModel'=>false,
        'uniqueValueTable'=>false,
        'uniqueValueTableId'=>false,
        'uniqueValueField'=>false,
    ],

    'lastName' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>false, 
        'match'=>false, 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please enter a last name',
        'uniqueValue'=>false,
        'uniqueValueExistsMessage'=>false,
        'uniqueValueModel'=>false,
        'uniqueValueTable'=>false,
        'uniqueValueTableId'=>false,
        'uniqueValueField'=>false,
    ],

    'gender' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>false, 
        'match'=>false, 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please select a gender',
        'uniqueValue'=>false,
        'uniqueValueExistsMessage'=>false,
        'uniqueValueModel'=>false,
        'uniqueValueTable'=>false,
        'uniqueValueTableId'=>false,
        'uniqueValueField'=>false,
    ],
    
    'email' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>false, 
        'match'=>false, 
        'emailValidate'=>true,
        'emptyFieldMessage'=>'Please enter a valid email address',
        'uniqueValue'=>true,
        'uniqueValueExistsMessage'=>'This email address is in use',
        'uniqueValueModel'=>'User',
        'uniqueValueTable'=>'tbl_users',
        'uniqueValueTableId'=>'user_id',
        'uniqueValueField'=>'email',
    ],
    
    'password' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>true, 
        'match'=>false, 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please enter a password',
        'uniqueValue'=>false,
        'uniqueValueExistsMessage'=>false,
        'uniqueValueModel'=>false,
        'uniqueValueTable'=>false,
        'uniqueValueTableId'=>false,
        'uniqueValueField'=>false,
    ],
    
    'confirmPassword' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>true, 
        'match'=>'password', 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please confirm the password',
        'uniqueValue'=>false,
        'uniqueValueExistsMessage'=>false,
        'uniqueValueModel'=>false,
        'uniqueValueTable'=>false,
        'uniqueValueTableId'=>false,
        'uniqueValueField'=>false,
    ],

    'languageName' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>false, 
        'match'=>false, 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please enter a language name',
        'uniqueValue'=>true,
        'uniqueValueExistsMessage'=>'This language name already exists',
        'uniqueValueModel'=>'Language',
        'uniqueValueTable'=>'tbl_languages',
        'uniqueValueTableId'=>'language_id',
        'uniqueValueField'=>'language_name',
    ],

    'codeBaseName' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>false, 
        'match'=>false, 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please enter a code base name',
        'uniqueValue'=>true,
        'uniqueValueExistsMessage'=>'This code base name already exists',
        'uniqueValueModel'=>'CodeBase',
        'uniqueValueTable'=>'tbl_code_bases',
        'uniqueValueTableId'=>'code_base_id',
        'uniqueValueField'=>'code_base_name',
    ],

    'libraryName' => [
        'null'=>false, 
        'charValidate'=>true, 
        'password'=>false, 
        'match'=>false, 
        'emailValidate'=>false,
        'emptyFieldMessage'=>'Please enter a library name',
        'uniqueValue'=>true,
        'uniqueValueExistsMessage'=>'This library name already exists',
        'uniqueValueModel'=>'Library',
        'uniqueValueTable'=>'tbl_libraries',
        'uniqueValueTableId'=>'library_id',
        'uniqueValueField'=>'library_name',
    ],
];





$illegalNameChars = [
    ' ',
    '\\',
    '/',
    ',',
    '\'',
    '"',
    ':',
    ';',
    '|',
    ']',
    ']',
    '}',
    '{',
    '+',
    '=',
    ')',
    ')',
    '*',
    '&',
    '^',
    '%',
    '$',
    '#',
    '!',
    '`',
    '~',
    '~'
];

    



$illegalCharsErrorText = 'You have entered illegal characters in this field';


$insertErrorMessage = 'There was an error inserting into the database. Please try again. If the problem persists, please contact support.';


$emailFormatErrorMessage = 'The format of this email address is incorrect';

    

?>