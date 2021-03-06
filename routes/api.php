<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\CandidateTestController;
use App\Http\Controllers\API\HeaderImageController;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\API\ExamSessionController;
use App\Http\Controllers\API\AnswerController;
use App\Http\Controllers\API\SubjectsController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\QuestionSetController;
use App\Http\Controllers\API\GAdminController;
use App\Http\Controllers\API\CAdminController;
use App\Http\Controllers\API\EAdminController;
use App\Http\Controllers\API\ProctorController;
use App\Http\Controllers\API\ProctorDetailsController;
use App\Http\Controllers\API\SessionsController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\ConfigurationsController;
use App\Http\Controllers\API\ProgramController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/


Route::post('login',[AuthController::class, 'login'])->name('postlogin');
Route::get('login',[AuthController::class, 'getlogin'])->name('login');
Route::post('OTP/send',[AuthController::class, 'sendOTP'])->name('sendOTP');
Route::post('OTP/resend',[AuthController::class, 'resendOTP'])->name('resendOTP');
Route::post('OTP/verify',[AuthController::class, 'verifyOTP'])->name('verifyOTP');
Route::post('register',[AuthController::class, 'register'])->name('register');
Route::get('settings',[SettingsController::class, 'index'])->name('settings');
Route::get('configurations', [ConfigurationsController::class, 'show'])->name('getConfig');

//--------------------------General Student Exam API----------------------------
Route::middleware(['auth:api'])->group(function()
{
    Route::get('whoAmI',[AuthController::class, 'index'])->name('whoAmI');
    Route::get('isLoggedIn',[AuthController::class, 'isLoggedIn'])->name('isLoggedIn');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('exam', [ExamController::class, 'index'])->name('getExam');
    Route::get('exam/{id}', [ExamController::class, 'show'])->name('getExam1');
    Route::put('exam/{id}', [ExamController::class, 'update'])->name('putExam');

    Route::put('examSession', [ExamSessionController::class, 'update'])->name('putExam');
    Route::get('examSession', [ExamSessionController::class, 'show'])->name('getExam');

    Route::get('headerImage', [HeaderImageController::class, 'index'])->name('headerImage');

    Route::get('answer', [AnswerController::class, 'index'])->name('getAnswer');
    Route::put('answer/{id}', [AnswerController::class, 'update'])->name('updateAnswer');

    Route::post('proctor', [ProctorController::class, 'store'])->name('PostProctor');
    Route::post('proctorDetails', [ProctorDetailsController::class, 'store'])->name('PostroctorDetails');

    Route::get('paper/{id}', [SubjectsController::class, 'showById'])->name('getSubjectsById');
    Route::get('subject/topic', [SubjectsController::class, 'getTopic'])->name('getTopic');

});
//---------------------------------Student API End------------------------------

//--------------------------Specific ADMIN Roles API----------------------------s
Route::middleware(['auth:api','admin'])->group(function()
{
    Route::get('user', [UsersController::class, 'index'])->name('getUser');
    Route::post('user', [UsersController::class, 'store'])->name('postUser');
    Route::delete('user/{id}', [UsersController::class, 'del'])->name('delUser');
    Route::put('user/{id}', [UsersController::class, 'update'])->name('updateUser');
    Route::post('user/upload', [UsersController::class, 'upload'])->name('uploadUser');
    Route::get('user/{id}', [UsersController::class, 'show'])->name('getUser1');

    Route::put('sessions', [SessionsController::class, 'update'])->name('putSessions');

    Route::put('configurations', [ConfigurationsController::class, 'update'])->name('putConfig');
    Route::get('configurations/{id}', [ConfigurationsController::class, 'index'])->name('getMyConfig');
    Route::post('configurations', [ConfigurationsController::class, 'store'])->name('postConfig');

    Route::get('program', [ProgramController::class, 'index'])->name('getProgram');
    Route::get('program/inst', [ProgramController::class, 'indexProgInst'])->name('indexProgInst');
    Route::delete('program/inst/{id}', [ProgramController::class, 'deleteProgInst'])->name('deleteProgInst');
    Route::post('program', [ProgramController::class, 'store'])->name('storeProgram');
    Route::post('program/upload', [ProgramController::class, 'upload'])->name('uploadProgram');
    Route::post('program/inst/upload', [ProgramController::class, 'uploadProgInst'])->name('uploadProgramInst');
    Route::get('program/{username}', [ProgramController::class, 'show'])->name('showProgram');
    Route::delete('program/{id}', [ProgramController::class, 'del'])->name('delProgram');

    Route::get('paper', [SubjectsController::class, 'show'])->name('getSubjects');
    

    Route::get('questions/{paper_id}', [QuestionSetController::class, 'show'])->name('getQuestions');
    Route::get('questions/specification/compare', [QuestionSetController::class, 'specificationCompare'])->name('getQuestSpecificationCompare');

    Route::post('subject', [SubjectsController::class, 'store'])->name('postSubject');
    Route::put('subject/{id}', [SubjectsController::class, 'update'])->name('updateSubject');
    Route::post('subject/upload', [SubjectsController::class, 'upload'])->name('uploadSubject');
    Route::post('subject/test/upload', [SubjectsController::class, 'uploadTest'])->name('uploadTestSubject');
    Route::put('subject/test/{id}', [SubjectsController::class, 'updateTest'])->name('updateTestSubject');
    Route::put('subject/config/{id}', [SubjectsController::class, 'updateConfig'])->name('updateConfigSubject');
    Route::get('subject', [SubjectsController::class, 'index'])->name('getSubject');
    
    Route::delete('subject/{id}', [SubjectsController::class, 'del'])->name('delSubject');

    
    Route::post('subject/topic', [SubjectsController::class, 'storeTopic'])->name('storeTopic');
    Route::post('subject/topic/upload', [SubjectsController::class, 'storeTopicUpload'])->name('storeTopicUpload');
    Route::delete('subject/topic/{id}', [SubjectsController::class, 'delTopic'])->name('delTopic');

    Route::post('exam/upload', [ExamController::class, 'upload'])->name('uploadExam');
    Route::delete('exam/{id}', [ExamController::class, 'del'])->name('delExam');

    Route::get('exam/report/count', [ExamController::class, 'examReportCount'])->name('examReportCount');
    Route::get('exam/bypaperid/type', [ExamController::class, 'examByPaperIdAndType'])->name('examByPaperIdAndType');

});
//------------------------------------------------------------------------------
?>
