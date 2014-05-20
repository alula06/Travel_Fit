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
    <!--<a href="<?=asset('/admin/reviews')?>">&lt;&lt; back to Reviews</a><br/>-->    
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $review can be NULL
    
        $formUrl = '/admin/review' . (is_null($review)?'':'/'.$review->id);
    ?>
    
    <?= Form::model($review,array('url' => $formUrl))?>
    <table>
        <thead>
            <tr>
                <th><h3><?=is_null($review)?'Add Reviews':'Edit Reviews'?></h3></th>
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
            <td><?php echo Form::label('review', 'Review');?></td>
            <td><?php echo Form::text('review'); 
                    if($errors->has('review')){
                        echo $errors->first('review',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
        <tr>
            <!-- rating field -->
            <td><?php echo Form::label('rating', 'Rating');?></td>
            <td><?php echo Form::text('rating'); 
                    if($errors->has('rating')){
                        echo $errors->first('rating',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
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
    <?php  ?>
</div>
