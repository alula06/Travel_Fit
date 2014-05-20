<?php

?>


<div class="container">
    <!--<a href="<?=asset('ratings')?>">&lt;&lt; back to Listings</a><br/>-->    
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $listing can be NULL
    
        $formUrl = 'rating' . (is_null($rating)?'':'/'.$rating->id);
    ?>
    
    <?= Form::model($rating,array('url' => $formUrl))?>
    <table>
        <thead>
            <tr>
                <th><h3><?=is_null($rating)?'Add Ratings':'Edit Ratings'?></h3></th>
            </tr>
        </thead>
        <tr>
            <!-- name field -->
            <td width="90"><?php echo Form::label('rating_category_id', 'Rating Category Id'); ?></td>
            <td><?php 
                    echo Form::text('rating_category_id',  Input::old('rating_category_id', ($rating ? $rating->rating_category_id:NULL)));
                    if($errors->has('rating_category_id')){
                        echo $errors->first('rating_category_id',"<span class='error'>:message</span>");
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <!-- description field -->
            <td><?php echo Form::label('value', 'Value');?></td>
            <td><?php echo Form::text('value'); 
                    if($errors->has('value')){
                        echo $errors->first('value',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
         <tr>
            <!-- description field -->
            <td><?php echo Form::label('user_id', 'User Id');?></td>
            <td><?php echo Form::text('user_id'); 
                    if($errors->has('user_id')){
                        echo $errors->first('user_id',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
        <tr>
            <!-- description field -->
            <td><?php echo Form::label('review_id', 'Review Id');?></td>
            <td><?php echo Form::text('review_id'); 
                    if($errors->has('review_id')){
                        echo $errors->first('review_id',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
        <tr>
            <!-- description field -->
            <td><?php echo Form::label('listing_id', 'Listing Id');?></td>
            <td><?php echo Form::text('listing_id'); 
                    if($errors->has('listing_id')){
                        echo $errors->first('listing_id',"<span class='error'>:message</span>");
                    }
            ?></td>
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
    <?php  ?>
</div>
