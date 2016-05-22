<?php

/**
 * Created by PhpStorm.
 * Date: 29.04.2016
 * Time: 21:43
 */
class Constants
{
    const
        ERROR_NOT_FOUND = 404,
        ERROR_ACCESS_DENIED = 403,
        

        STUDENT_ROLE = 'student',
        EMPLOYER_ROLE = 'employer',

        UPLOAD_PHOTOS_DIR = __DIR__ . '/../uploads/photos/',
        UPLOAD_PHOTOS_URL = '/uploads/photos/',
        DEFAULT_PHOTO_URL = '/assets/img/default-avatar.png'
    ;
}