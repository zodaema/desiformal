<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Admincp\Portfolio;

class PortfolioController extends Controller
{
    //
    public static function showPortfolio(){
      $portfolios = Portfolio::all()->sortByDesc('id');
      return $portfolios;
    }
}
