<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Admincp\Portfolio;

class PortfolioController extends Controller
{
    const item_per_page = 4;

    public static function showPortfolio($page_number){
      $page_number = filter_var($page_number, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
      if(!is_numeric($page_number)){die('Invalid page number!');}

      $page_position = (($page_number-1) * PortfolioController::item_per_page);
      $portfolios = Portfolio::limit(PortfolioController::item_per_page)->offset($page_position)->orderBy('id', 'desc')->get();

      // return $portfolios->toJson();
      return $portfolios;
    }

    public function portfolioDetail($id){
      $portfolios = Portfolio::find($id);
      return $portfolios->toJson();
    }

    public static function totalPage(){
      $portfolios = Portfolio::count();
      $total_pages = ceil($portfolios/PortfolioController::item_per_page);
      return $total_pages;
    }
}
