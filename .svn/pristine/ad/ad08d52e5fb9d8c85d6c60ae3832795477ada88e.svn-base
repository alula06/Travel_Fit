<?php

?>

<style>
    table{
        
    }
    td {
        
        padding: 5px;
    }
    
</style>

<div class="container">
    <!--<a href="<?=asset('images')?>">&lt;&lt; back to Listings</a><br/>-->    
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $listing can be NULL
    
        $formUrl = 'image' . (is_null($image)?'':'/'.$image->id);
    ?>
    
    <?= Form::model($image,array('url' => $formUrl))?>
    <table>
        <thead>
            <tr>
                <th><h3><?=is_null($image)?'Add Images':'Edit Images'?></h3></th>
            </tr>
        </thead>
        <tr>
            <!-- name field -->
            <td width="90"><?php echo Form::label('listing_id', 'Listing Id'); ?></td>
            <td><?php 
                    echo Form::text('listing_id',  Input::old('listing_id', ($image ? $image->listing_id:NULL)));
                    if($errors->has('listing_id')){
                        echo $errors->first('listing_id',"<span class='error'>:message</span>");
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <!-- description field -->
            <td><?php echo Form::label('review_id', 'Review Id');?></td>
            <td><?php echo Form::text('review_id'); 
                    if($errors->has('review_id')){
                        echo $errors->first('value',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
         <tr>
            <!-- description field -->
            <td><?php echo Form::label('filename', 'File Name');?></td>
            <td><?php echo Form::text('filename'); 
                    if($errors->has('filename')){
                        echo $errors->first('filename',"<span class='error'>:message</span>");
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
