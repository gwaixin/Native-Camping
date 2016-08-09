<?php

// Student
Breadcrumbs::register('student', function($breadcrumbs)
{
    $breadcrumbs->push('Student', action('StudentController@index'));
});

// Student > Teachers
Breadcrumbs::register('teacherList', function($breadcrumbs)
{
    $breadcrumbs->parent('student');
    $breadcrumbs->push('Teacher List', action('StudentController@teachers'));
});

// Student > Teachers > Detail
Breadcrumbs::register('teacherDetail', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('teacherList');
    $breadcrumbs->push('Teacher Detail', action('StudentController@teacherDetail', $id));
});


