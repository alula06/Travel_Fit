<style>
    #ratings-table td{padding: 2px 5px;}
    .red{color:red;}
</style>
<div class="page">
<?php
if(!is_null($listing)){
    switch($listing->type){
        case 'eatery':
            $plural = 'eateries';
            break;
        case 'sports':
            $plural = 'sports facilities';
            break;
        case 'gym':
            $plural = 'gyms';
            break;
        case 'outdoor':
            $plural = 'outdoors activites';
            break;
    }
    
    // set reviews count to a number
    $reviewsCount = ($count > 0)?$count:0;
    $reviewsLabel = ($reviewsCount>1 || $reviewsCount<1)?'reviews':'review';
?>
    <div class="row">
    <div class="col-md-12">
    <?php if(isset($backToSearch)){ ?>
        <a role="button" class="btn btn-info" href="<?=e($backToSearch)?>"> < Back to Search Results</a>
    <?php }
    ?>
    <!-- LISTING NAME -->
    <h1><?=$listing->name?>  <small>(<?=ucfirst($listing->type)?>)</small></h1>
    <h3><?php if($userReview){
                $reviewButtonText = 'Edit Your Review';
            }else{
                $reviewButtonText = 'Write a Review';
            }  ?>
            <a href="<?=asset('/review/listing/'.$listing->id)?>" class="btn btn-primary"><?=$reviewButtonText?></a> &nbsp;&nbsp;<?=$reviewsCount?> reviews</h3>
        </div>
    </div>
        <div class="row">
    <div class="col-md-6 ">
            <?php if(!is_null($images->first())) { 
                $image = $images->first(); 
                $type = Images::where('id', $image->images_id)->pluck('fileType');
            ?>
            <a class="fancybox-thumb" rel="fancybox-thumb" href="<?=asset('/images/listings/'.$image->images_id.'.'.$type)?>" >
                <img src="<?=asset('/images/listings/'.$image->images_id.'.'.$type)?>" alt="" style="width: 300px; height: 260px;"/>
            </a>

            <div style="margin: auto; width: 100%; height:50px; overflow: auto; float:left; display:inline; "> 
            <?php foreach ($images as $image) { ?>
                    <?php $type = Images::where('id', $image->images_id)->pluck('fileType')?>    
                        <a class="fancybox-thumb" rel="fancybox-thumb" href="<?=asset('/images/listings/'.$image->images_id.'.'.$type)?>"  >
                            <img src="<?=asset('/images/listings/'.$image->images_id.'.'.$type)?>" alt="" style="width:50px; height:50px;" />
                        </a>

               <?php } ?>
                </div>
            <?php } else { ?>
                <a class="fancybox-thumb" rel="fancybox-thumb" href="<?=asset('/images/thumb2.jpg')?>" >
                <img src="<?=asset('/images/thumb2.jpg')?>" alt="" style="margin: auto; width: 300px; height: 260px;"/>
            </a>
           <?php } ?>


        </div>
        <div class="col-md-6 border" style='padding-top:5px; padding-bottom: 5px;'>
            <!-- RATE BUTTON -->
            <div class='pull-right'></div>
            <div class='pull-left'>
            <?php 
                // ADDRESS
                $address = '';


                if(strlen($listing->address1)){
                   $address .= $listing->address1 . '<br/>';
                }
                if(strlen($listing->address2)){
                   $address .= $listing->address2 . '<br/>';
                }

                if($listing->destination){
                    // get city, state from destinations
                    $address .= $listing->destination->name . ", " . $listing->destination->state . "<br/>";
                } else {
                    // get city, state from address
                    if(strlen($listing->city)){
                       $address .= $listing->city;
                    }
                    if(strlen($listing->state)){
                        if(strlen($listing->city)){$address .= ", ";}
                        $address .= $listing->state;
                        if(strlen($listing->city)){$address .= '<br/>';}
                    }
                }

                if(strlen($listing->phone)){
                   $address .= $listing->phone . '<br/>';
                }

                if(strlen($address)){ ?>
                    <address><strong><?=$listing->name?></strong><br/><?=$address?></address>
                <? } ?>
            </div>
            <div style='clear:both'></div>

                




                <table width='100%'  style="border:none; font-size: 15px; padding: 10px">
                <?php
                /** Overall Rating & Healthy Rating **/
                //$ratings = array($listing->getOverallRating(), $listing->getHealthyRating());
                foreach($listing->ratings as $key=>$rating){
                    if(!is_null($rating)){
                    ?>
                    <tr>
                        <td style='line-height: 90%'><?php 

                        // RATING CATEGORY
                        echo $rating->category->name;
                        // show disclaimer for Healthy Rating
                        if($rating->category->id==2){
                    ?>
                            <br/><a rel='tooltip' data-toggle="tooltip" data-placement="right" title="" data-original-title="Healthy Rating represents the subjective personal experiences of our user community. This rating does not represent any review of any establishment by TravelFit or any other certification authority." style="text-decoration: none; font-size: 9px;">What's this?</a>
                    <?php }

                        ?> 
                        </td>
                        <td valign='top'>
                    <?php    
                    // if rating > 0
                    if($rating->value > 0){
                        // round rating value to whole number
                        $roundedValue = round($rating->value,0);
                        // loop in increments of 1 from min to max for category
                        for($j=1;$j<=$rating->category->max;$j++){
                            // if we've passed value, show empty, else show filled
                            if($rating->category->id==2){
                                $iconClass = 'red fa-heart'; 
                            } else {
                                $iconClass = 'fa-star';
                            }
                            $iconClassSuffix = ($j<=$rating->value)?"":"-o";
                            ?>
                            <i class='fa <?=$iconClass.$iconClassSuffix?>'></i>
                            <?
                        }
                        ?>
                          &nbsp;<?=($rating->num_ratings)?>&nbsp;<?=($rating->num_ratings>1)?'ratings':'rating'?>
                        <?
                    } else { ?> <i>No ratings yet</i> <?php }

                     ?>
                        </td>
                        <?php
                        if($key<1){ ?>
                        <td rowspan='99' valign='top'><a href="<?=asset('/listing/rate/'.$listing->id)?>" class="btn btn-primary">Rate It <i class='fa red fa-heart'></i></a></td>
                        <?php } ?>

                    </tr>
                    <?php
                    }
                }
                ?>
                </table>
            
                <!-- DESCRIPTION -->
                <?php
                if(strlen(e($listing->description))){ ?>
                <div class="panel panel-default">
                  <div class="panel-body" style='font-size: 13px;'>
                    <strong>About <?=$listing->name?></strong><br/>
                    <?= e($listing->description) ?>
                  </div>
                  <!--<div class="panel-footer">Panel footer</div>-->
                </div>            
                <?php } ?>
        </div>
        </div>
    <div style="clear:both"></div>
    
    <div class="row">
        <div class="col-md-12">
        <h1>Reviews for <?=$listing->name?></h1><hr style='margin-bottom:0px;'/>
        <?php 
        if(count($reviews)){ 
            $num = 1; 
            foreach ($reviews as $review) { ?>
        <div class="panel panel-default">
            <div class="panel-heading"><h3><?php echo $num ?>. &nbsp;<?= e($review->title) ?></h3></div>
            <div class="panel-body">
                        <?php 
                            // get user from review
                            $reviewUser = $review->user;
                            // get user's ratings for this listing
                            $userRatings = $reviewUser->userRatings()->where('listings_id',$listing->id)->get();
                           
                            if(count($userRatings)){
                        ?>
                            
                            <div class="panel panel-default">
                                <div class="panel-body">
                           
                                    <!-- INDIVIDUAL USER RATINGS -->
                                    <table cellpadding='5'  style="border:none; font-size: 15px; padding: 10px">
                                    <?php
                                    foreach($userRatings as $key=>$userRating){
                                        if(!is_null($userRating)){
                                            $listingRating = $userRating->listingRating;

                                            // if rating > 0
                                            if($userRating->value > 0){ 
                                    ?>

                                        <tr>
                                            <td style='line-height: 90%'>
                                    <?php 

                                                // RATING CATEGORY
                                                echo $listingRating->category->name;
                                                // show disclaimer for Healthy Rating
                                                if($listingRating->category->id==2){
                                    ?>
                                                <br/><a rel='tooltip' data-toggle="tooltip" data-placement="right" title="" data-original-title="Healthy Rating represents the subjective personal experiences of our user community. This rating does not represent any review of any establishment by TravelFit or any other certification authority." style="text-decoration: none; font-size: 9px;">What's this?</a>
                                    <?php       } ?> 
                                            </td>
                                            <td valign='top'>
                                    <?php
                                            // loop in increments of 1 from min to max for category
                                            for($j=1;$j<=$listingRating->category->max;$j++){
                                                // if we've passed value, show empty, else show filled
                                                if($listingRating->category->id==2){
                                                    $iconClass = 'red fa-heart'; 
                                                } else {
                                                    $iconClass = 'fa-star';
                                                }
                                                $iconClassSuffix = ($j<=$userRating->value)?"":"-o";
                                    ?>
                                                <i class='fa <?=$iconClass.$iconClassSuffix?>'></i>
                                    <?php
                                            }
                                        }

                                    ?>
                                            </td>
                                        </tr>

                                    <?php
                                        }
                                    }
                                    ?>
                                    </table>
                                </div>
                            </div>
                
                            <?php } ?>


                            <!-- REVIEW BODY -->
                             <blockquote>
                              <p><?= e($review->review) ?></p>
                              <?php if($reviewUser){ ?>
                                <small><?=$reviewUser->firstname . ' ' . $reviewUser->lastname?></small>
                              <?php } ?>
                            </blockquote>
                            
                        </td>
                        <?php $num++ ?>
                    <hr style='margin-bottom:0px;margin-top: 0px;'/>
                    
            </div>
        </div>
            <?php }
            
            } else { 
                // NO REVIEWS
                echo "No reviews yet."; 
                
            } ?>
        
    </div>
<?php

        } else {
?>
    Listing not found.
<?php    
        }
        ?>
</div>
</div>
