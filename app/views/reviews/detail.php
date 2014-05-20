<?php

?>



<div class="container">
    
    <?php if(isset($backToSearch)){ ?>
        <a role="button" class="btn btn-info" href="<?=e($backToSearch)?>"> < Back to Search Results</a>
    <?php }
?>
    <?php
                if($signedIn){ ?>
    <?php 
        if($listing){
            
        $formUrl = 'review/listing/'.$listing->id;
    ?>
    
    <?= Form::model($review,array('url' => $formUrl, 'files' => true))?>
    <table>
        <thead>
            <tr>
                <td colspan='2'>
                    <?php if(!is_null($review)){
                        // user has review
                    ?>
                    <h3 style="display:inline-block;">Edit Your Review</h3> <a href="<?=asset('/review/delete/'.$review->id)?>" class="btn">Delete This Review</a>
                    
                    <?php
                    } else {
                        // no review yet
                    ?>
                    <h3>Write a Review</h3>
                    
                    <?php } ?>
                    
                    <h2><b><a href="<?=asset('/listing/'.e($listing->id))?>"><?=e($listing->name)?></a></b></h2>
                    <?=e($listing->description)?>
                </td>
                <?php echo Form::hidden('listings_id', $listing->id); ?>
                
            </tr>
        </thead>
        <tr>
            <!-- title field -->
            <td width="90"><?php echo Form::label('title', 'Title'); ?></td>
            <td><?php 
                    echo Form::text('title',  Input::old('title', ($review ? $review->title:NULL)));
                    if($errors->has('title')){
                        echo $errors->first('title',"<span class='error'>:message</span>");
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <!-- review field -->
            <td valign='top'><?php echo Form::label('review', 'Review');?></td>
            <td><?php echo Form::textarea('review',Input::old('review', ($review ? $review->review:NULL)), array('rows'=>4)); 
                    if($errors->has('review')){
                        echo $errors->first('review',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
        <tr>
            
        <tr>
            <!-- photo field -->
            <td><?php echo Form::label('photo', 'Photo');?></td>
            <td><?php echo Form::file('photo');?></td>
        </tr> 
        
        <tr>
            <td></td>
            <td>
                <!-- save button -->
                <?php echo Form::submit('Save');?>
            </td>
        </tr>
    </table>
    <?= Form::close()?>
    <?php 
        } else {
    ?>
        <br/>
        <div class="jumbotron">
          <h4>What would you like to review?</h4>
          <p>Review a healthy eatery, gym, sports facility, or outdoors activity you experienced.</p>
        </div>
            <?=$searchbar?>
            
    
    <?php
        }
    
    ?>

<?php } else {
                ?>
            Please login or <a data-toggle="modal" data-target="#reg" >Register.</a>
            

            <? } ?>

    </div>