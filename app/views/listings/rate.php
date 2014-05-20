<?php
if(is_null($listing)){
    echo "No listing to rate.";
}

if(!$signedIn){
    ?>
    <div class="page">
    Please login or <a data-toggle="modal" data-target="#reg" >Register.</a>
</div>
    <?php
}

if(!is_null($listing) && $signedIn){
?>
<style>
    th{background-color:#CCC;}
    td,th{padding: 5px;}
</style>
<div class='page'>
    <?php if(isset($backToSearch)){ ?>
        <a role="button" class="btn btn-info" href="<?=e($backToSearch)?>"> < Back to Search Results</a>
    <?php }
?>
    <h3 style="display:inline-block;">Rate this Venue</h3>
    <h2><b><a href="<?=asset('/listing/'.e($listing->id))?>"><?=e($listing->name)?></a></b></h2>
    <?=e($listing->description)?>
    <hr/>
    <form action='<?=asset('listing/rate/'.$listing->id)?>' method='POST'>
    <table border='1' style='border-collapse:collapse;'>
        <thead>
            <tr>
                <th>Rating</th>
                <th>TravelFit Rating</th>
                <th>Your Rating</th>
            </tr>
        </thead>
    <?php
        foreach($listing->ratings as $rating){
            // show rating category label
            ?>
        <tr>
            <td><?=$rating->category->name?></td>
            <td style="font-size:12px;">
            <?php
            // if rating > 0
            if($rating->value > 0){
                // round rating value to whole number
                $roundedValue = round($rating->value,0);
                // loop in increments of 1 from min to max for category
                for($i=1;$i<=$rating->category->max;$i++){
                    // if we've passed value, show empty, else show filled
                    $iconClass = ($i<=$rating->value)?"fa-circle":"fa-circle-o";
                    ?>
                    <i class='fa <?=$iconClass?>'></i>
                    <?
                }
            } else { ?> <i>No ratings yet</i> <?php } ?>
            </td>
            <td>
                <?php
                $currentUserRating = NULL;
                if(isset($userRatings[$rating->id])){
                    $currentUserRating = $userRatings[$rating->id];
                }
                ?>
                <select name="listing_ratings[<?=$rating->id?>]">
                    <option value=""></option>
                    <?php
                    // loop from min to max in 1's
                    $i=1;
                    $max = (int)$rating->category->max;
                    while($i<=$max){ ?>
                        <option value="<?=$i?>" <?php if(!is_null($currentUserRating) && $currentUserRating->value==$i){ echo 'selected="selected"'; } ?> ><?=$i?></option>
                        <?php
                        $i++;
                    }
                ?>
                </select>
                &nbsp;out&nbsp;of&nbsp;<?php echo $rating->category->max;?>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
        <!-- save button -->
        <br/>
        <?php echo Form::submit('Save and Go Back to Venue');?>
    </form>
</div>
<?php
}
?>