<?php

use Cursos\Controller\{Delete,
    FetchCoursesJson,
    FormInsertion,
    FormLogin,
    FormUpdate,
    ListCourses,
    Logout,
    Persistence,
    RealizeLogin};

return [
    '/' => ListCourses::class,
    '/new-course' => FormInsertion::class,
    '/save-course' => Persistence::class,
    '/delete-course' => Delete::class,
    '/update-course' => FormUpdate::class,
    '/login' => FormLogin::class,
    '/realize-login' => RealizeLogin::class,
    '/logout' => Logout::class,
    '/fetch-courses-json' => FetchCoursesJson::class
];
