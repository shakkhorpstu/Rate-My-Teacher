<?php

Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/course/{department_short_name}', 'Frontend\PagesController@departmentCourse')->name('departmentCourse');
Route::get('/teacher/{course_code}', 'Frontend\TeacherController@courseTeacher')->name('courseTeacher');
Route::get('/review/{teacher_username}/{year}/{course_teacher_id}', 'Frontend\ReviewController@review')->name('courseTeacherReview');
Route::get('/teacher', 'Frontend\TeacherController@index')->name('teacher');
Route::get('/teahcer/course/{username}', 'Frontend\TeacherController@teacherTakenCourse')->name('teacherTakenCourse');
Route::get('/teacher/{course_code}/{username}/{course_teacher_id}/{course_year}', 'Frontend\ReviewController@teacherReview')->name('teacherCourseReview');
Route::post('review/submit', 'Frontend\ReviewController@submitReview')->name('teacher.review.submit');


/**
* Student Routes => All routes associate to student account
*/
Route::group(['prefix' => 'student'], function(){

    Route::get('/dashboard', 'Frontend\StudentController@index')->name('student.dashboard');

    Route::get('/sign-up', 'Auth\Student\RegisterController@showRegistrationForm')->name('student.register');
    Route::post('/sign-up', 'Auth\Student\RegisterController@register')->name('registerStudent');
    Route::get('/verify/{verify_token}', 'Auth\Student\VerificationController@verify')->name('student.verify');
    Route::get('/verify/student/{student_id}/{verify_token}', 'Auth\Student\VerificationController@verification_page')->name('student.verification');

    Route::get('/login', 'Auth\Student\LoginController@showLoginForm')->name('student.login');
    Route::post('/login', 'Auth\Student\LoginController@login')->name('student.login.submit');
    Route::post('/logout', 'Auth\Student\LoginController@logout')->name('student.logout');

    //Password resets routes
    Route::post('/password/email', 'Auth\Student\ForgotPasswordController@sendResetLinkEmail')->name('student.password.email');
    Route::get('/password/reset', 'Auth\Student\ForgotPasswordController@showLinkRequestForm')->name('student.password.request');
    Route::post('/password/reset', 'Auth\Student\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\Student\ResetPasswordController@showResetForm')->name('student.password.reset');
    Route::get('/confirm-account/{verify_token}', 'Auth\Student\RegisterController@confirmAccount')->name('student.account.confirm');

});




/**
* Admin Routes => All routes associate to employee
*/
Route::group(['prefix' => 'admin'], function(){

    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

    //Password resets routes
    Route::post('/password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::get('/', 'Backend\PagesController@index')->name('admin.dashboard');


   // Faculty Routes
   Route::group(['prefix' => 'faculty'], function(){
       Route::get('/', 'Backend\FacultyController@index')->name('admin.faculty.index');
       Route::post('/add', 'Backend\FacultyController@store')->name('admin.faculty.store');
       Route::post('/edit/{id}', 'Backend\FacultyController@update')->name('admin.faculty.update');
       Route::post('/delete/{id}', 'Backend\FacultyController@destroy')->name('admin.faculty.delete');
   });


   // Department Routes
   Route::group(['prefix' => 'department'], function(){
       Route::get('/', 'Backend\DepartmentController@index')->name('admin.department.index');
       Route::post('/add', 'Backend\DepartmentController@store')->name('admin.department.store');
       Route::post('/edit/{id}', 'Backend\DepartmentController@update')->name('admin.department.update');
       Route::post('/delete/{id}', 'Backend\DepartmentController@destroy')->name('admin.department.delete');
   });


   // Course Routes
   Route::group(['prefix' => 'course'], function(){
       Route::get('/', 'Backend\CourseController@index')->name('admin.course.index');
       Route::post('/add', 'Backend\CourseController@store')->name('admin.course.store');
       Route::post('/edit/{id}', 'Backend\CourseController@update')->name('admin.course.update');
       Route::post('/delete/{id}', 'Backend\CourseController@destroy')->name('admin.course.delete');
   });


   // Review Question Routes
   Route::group(['prefix' => 'review-question'], function(){
       Route::get('/', 'Backend\ReviewQuestionController@index')->name('admin.question.index');
       Route::post('/add', 'Backend\ReviewQuestionController@store')->name('admin.question.store');
       Route::post('/edit/{id}', 'Backend\ReviewQuestionController@update')->name('admin.question.update');
       Route::post('/delete/{id}', 'Backend\ReviewQuestionController@destroy')->name('admin.question.delete');
   });


   // Teacher Routes
   Route::group(['prefix' => 'teacher'], function(){
       Route::get('/', 'Backend\TeacherController@index')->name('admin.teacher.index');
       Route::post('/add', 'Backend\TeacherController@store')->name('admin.teacher.store');
       Route::post('/edit/{id}', 'Backend\TeacherController@update')->name('admin.teacher.update');
       Route::post('/delete/{id}', 'Backend\TeacherController@destroy')->name('admin.teacher.delete');
   });


   // Student Routes
   Route::group(['prefix' => 'student'], function(){
       Route::get('/', 'Backend\StudentController@index')->name('admin.student.index');
       Route::get('/upgrade-semester', 'Backend\StudentController@upgradeSemester')->name('admin.student.upgradeSemester');
       Route::get('/add', 'Backend\StudentController@create')->name('admin.student.add');
       Route::post('/add', 'Backend\StudentController@store')->name('admin.student.store');
       Route::post('/edit/{id}', 'Backend\StudentController@update')->name('admin.student.update');
       Route::post('/delete/{id}', 'Backend\StudentController@destroy')->name('admin.student.delete');
       Route::post('/upload', 'Backend\StudentController@uploadExcel')->name('admin.student.uploadExcel');
   });


   // Course Teacher Routes
   Route::group(['prefix' => 'course-teacher'], function(){
       Route::get('/', 'Backend\CourseTeacherController@index')->name('admin.courseTeacher.index');
       Route::post('/add', 'Backend\CourseTeacherController@store')->name('admin.courseTeacher.store');
       Route::post('/edit/{id}', 'Backend\CourseTeacherController@update')->name('admin.courseTeacher.update');
       Route::post('/delete/{id}', 'Backend\CourseTeacherController@destroy')->name('admin.courseTeacher.delete');
   });
});
