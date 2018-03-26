<?php

namespace App\Form;

interface Form
{

    const
        /**
         * @var string
         */
        NAME_EMAIL = "email",
        /**
         * @var string
         */
        NAME_PSWD = "pswd",
        /**
         * @var string
         */
        NAME_CONFIRM = "confirm",
        /**
         * @var string
         */
        NAME_CHANNEL_ID = "channel",
        /**
         * @var string
         */
        NAME_CHANNEL_NAME = "channel_name",
        /**
         * @var string
         */
        NAME_CHANNEL_DESCR = "channel_descr",
        /**
         * @var string
         */
        NAME_CHANNEL_CAPACITY = "channel_capacity",
        /**
         * @var string
         */
        REGEX_PSWD = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",
        /**
         * @var string
         */
        ERR_TOKEN = "Invalid token",
        /**
         * @var string
         */
        ERR_EMAIL = "Submit a valid email",
        /**
         * @var string
         */
        ERR_COMPLETE = "Please complete the form",
        /**
         * @var string
         */
        ERR_PSWD = "The password must contain UpperCase, LowerCase and Number",
        /**
         * @var string
         */
        ERR_CONFIRM = "Please confirm correctly the password",
        /**
         * @var string
         */
        ERR_USER_EXISTS = "User already exists",
        /**
         * @var string
         */
        ERR_CREDENTIALS = "Bad credentials";

}
