<?php
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	include("config.inc.php");  //include config file
	//Get page number from Ajax POST
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
	}else{
		$page_number = 1; //if there's no page number, set it to 1
	}
	
	//get total number of records from database for pagination
	$results = $mysqli_conn->query("SELECT COUNT(*) FROM portfolio");
	$get_total_rows = $results->fetch_row(); //hold total records in variable
	//break records into pages
	$total_pages = ceil($get_total_rows[0]/$item_per_page);
	
	//get starting position to fetch the records
	$page_position = (($page_number-1) * $item_per_page);
	
	//SQL query that will fetch group of records depending on starting position and item per page. See SQL LIMIT clause
	$results1 = $mysqli_conn->query("SELECT * FROM portfolio ORDER BY id desc LIMIT $page_position, $item_per_page");
    $results2 = $mysqli_conn->query("SELECT * FROM portfolio ORDER BY id desc LIMIT $page_position, $item_per_page");
	
	//Display records fetched from database.
	
    echo' <section id="portfolio" class="portfolio bg-light-gray">
            <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>ตัวอย่างผลงาน</h2>
                    <h3>ตัวอย่างผลงานการออกแบบเว็บไซต์ที่ผ่านมา</h3>
                </div>
            </div>
            <div class="row">';
    
    while($row = $results1->fetch_assoc()) {
        
        echo '
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal'.$row[id].'" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="'.$dirpic.''.$row[smallpic].'" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4><b>'.$row[name].'</b></h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>';
    } 
    
    echo '</div>';
	
	echo '<div align="center">';
	/* We call the pagination function here to generate Pagination link for us. 
	As you can see I have passed several parameters to the function. */
	echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
	echo '</div></section>';
    
    while($row = $results2->fetch_assoc()) {
        echo '
            <div class="portfolio-modal modal fade" id="portfolioModal'.$row[id].'" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="modal-body">
                                    <h2>'.$row[name].'</h2>
                                    <center><img class="img-responsive img-centered" src="'.$dirpic.''.$row[fullpic].'" alt=""></center>
                                    <ul class="list-inline">
                                        <li>Date: '.$row[dates].'</li>
                                        <li>Client: '.$row[client].'</li>
                                        <li>Link : <a href="'.$row[link].'" target="_blank">'.$row[name].'</a></li>
                                        <li>Category: Website Design</li>
                                    </ul>
                                    <button type="button" class="btn btn-primary btn-lg btn3d" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }
    
}
################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 1; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="first"><a href="#" data-page="1" title="First"><i class="fa fa-angle-double-left"></i></a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous"><i class="fa fa-angle-left"></i></a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active"><a>'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active"><a>'.$current_page.'</a></li>';
        }else{ //regular current link
            $pagination .= '<li class="active"><a>'.$current_page.'</a></li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next"><i class="fa fa-angle-right"></i></a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last"><i class="fa fa-angle-double-right"></i></a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}
?>

