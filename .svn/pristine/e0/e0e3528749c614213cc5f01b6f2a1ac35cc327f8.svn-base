<style>
    table.ratings-table{width: 360px;font-size:14px;}
    table.ratings-table td{padding: 2px 5px;}
    .red{color:red;}
    .search-result-description{}
</style>
<div class="page">
    <h3 class="nomargin">Search Results</h3>
    Can't find the business you were looking for? &nbsp; <a class="btn btn-success" href="<?=asset('/listing/new')?>">Add Venue</a>
    <div class="search-result-container">

        <table class="text-left searchresults">
        <?php
        if(count($results)){
        ?>
            <h4><?=count($results)?> results found.</h4>
        <?php    
        }
        
            foreach($results as $key=>$result_info){
                $result = $result_info['value'];
                $listing = Listings::find($result->id);
                    /* LISTINGS */
        ?>
                <tr>
                    <!-- thumbnail -->
                    <td class="search-result-thumb-container" valign='top'>
                        <a href="<?=asset('/listing/'.$result->id)?>"><img class='thumbnail' src="<?=asset('/images/thumbnail.jpg')?>"><br></a>
                    </td>
                    <!-- /thumbnail -->
                    <!-- info -->
                    <td valign='top' class="search-result-description">
                        <!-- title & type -->
                        <strong><a href="<?=asset('/listing/'.$result->id)?>"><?=$key+1?>. <?=e($result->name)?></a></strong> <span class="muted"><i>- <?=ucfirst($result->type)?></i></span>
                        <br/>
                        
                        <!-- rating icons -->
                        <table class='ratings-table'>
                        <?php
                        /** Overall Rating & Healthy Rating **/
                        
                        $ratings = array($listing->getOverallRating(), $listing->getHealthyRating());
                        foreach($ratings as $key=>$rating){
                            if(!is_null($rating)){
                            ?>
                            <tr>
                                <td style='line-height: 90%'><?php 
                                        echo ($key<1)?'Overall Rating':'Healthy Rating';
                                        if($key==1){
                                    ?>
                                 <br/><a rel='tooltip' data-toggle="tooltip" data-placement="right" title="" data-original-title="Healthy Rating represents the subjective personal experiences of our user community. This rating does not represent any review of any establishment by TravelFit or any other certification authority." style="text-decoration: none; font-size: 9px;">What's this?</a>
                                    <?php }
                                        
                                        ?> </td>
                                <td valign='top'>
                            <?php    
                            // if rating > 0
                            if($rating->value > 0){
                                // round rating value to whole number
                                $roundedValue = round($rating->value,0);
                                // loop in increments of 1 from min to max for category
                                for($j=1;$j<=$rating->category->max;$j++){
                                    // if we've passed value, show empty, else show filled
                                    $iconClass = ($key<1)?'fa-star':'red fa-heart';
                                    $iconClassSuffix = ($j<=$rating->value)?"":"-o";
                                    ?>
                                    <i class='fa <?=$iconClass.$iconClassSuffix?>'></i>
                                    <?
                                }
                                ?>
                                  &nbsp;(<?=($rating->num_ratings)?>&nbsp;<?=($rating->num_ratings>1)?'ratings':'rating'?>)
                                <?
                            } else { ?> <i>No ratings yet</i> <?php }

                             ?>
                                </td>
                                <?php if($key==0){?>
                                <td rowspan='99' align='right'></td>
                                <?php }?>
                            </tr>
                            <?php
                            }
                        }
                        ?>
                        </table>
                        <!-- reviews -->
                        <?php
                            
                            
                        ?>
                        <b><?=$result_info['reviewsCount']?> User Reviews</b><br/>
                        <a class="btn btn-primary" href="<?=asset('/review/listing/'.$result->id)?>">Add Review</a>&nbsp;&nbsp;&nbsp;<a href="<?=asset('/listing/rate/'.$listing->id)?>" class="btn btn-primary">Rate It  <i class='fa red fa-heart'></i></a> 
                        <br/>
                    </td>
                    <!-- /info -->
                </tr>
        <?php
            }
            ?>
        </table>
    </div>
</div>