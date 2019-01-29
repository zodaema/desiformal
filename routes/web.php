<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/showPortfolio/{page}', 'PortfolioController@showPortfolio');
Route::get('/portfolioDetail/{id}', 'PortfolioController@portfolioDetail');
Route::get('/totalPage', 'PortfolioController@totalPage')->name('totalPage');
Route::get('/searchQueue/{month}/{year}', 'QueueController@searchQueue')->name('searchQueue');

Route::prefix('admincp')->group(function(){
    Auth::routes(['register' => false]);
});

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admincp')->group(function () {
        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

        /* Portfolio Page */
        Route::get('', function () {
            return redirect('admincp/portfolio');
        });
        Route::get('portfolio', 'Admincp\PortfolioController@index')->name('portfolio');
        Route::get('portfolio/showTable', 'Admincp\PortfolioController@showTable')->name('portfolio.showTable');
        Route::get('portfolio/destroy/{id}', 'Admincp\PortfolioController@destroy')->name('portfolio.destroy');
        Route::post('portfolio/add/', 'Admincp\PortfolioController@add')->name('portfolio.add');
        Route::put('portfolio/edit/{id}', 'Admincp\PortfolioController@edit')->name('portfolio.edit');
        Route::get('portfolio/getData/{id}', 'Admincp\PortfolioController@getData')->name('portfolio.getData');

        /* Queue Page */
        Route::get('queue', 'Admincp\QueueController@index')->name('queue');
        Route::get('queue/plus/{month}/{year}', 'Admincp\QueueController@plus')->name('queuePlus');
        Route::get('queue/minus/{month}/{year}', 'Admincp\QueueController@minus')->name('queueMinus');
    });
});
