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
    <!--<a href="<?=asset('destinations')?>">&lt;&lt; back to Listings</a><br/>-->    
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $listing can be NULL
    
        $formUrl = 'destination' . (is_null($destination)?'':'/'.$destination->id);
    ?>
    
    <?= Form::model($destination,array('url' => $formUrl))?>
    <table>
        <thead>
            <tr>
                <th><h3><?=is_null($destination)?'Add Destinations':'Edit Destinations'?></h3></th>
            </tr>
        </thead>
        <tr>
            <!-- name field -->
            <td width="90"><?php echo Form::label('name', 'Name'); ?></td>
            <td><?php 
                    echo Form::text('name',  Input::old('name', ($destination ? $destination->name:NULL)));
                    if($errors->has('name')){
                        echo $errors->first('name',"<span class='error'>:message</span>");
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <!-- description field -->
            <td><?php echo Form::label('parent_id', 'Parent Id');?></td>
            <td><?php echo Form::text('parent_id'); 
                    if($errors->has('parent_id')){
                        echo $errors->first('parent_id',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
         <tr>
            <!-- description field -->
            <td><?php echo Form::label('lat', 'Latitude');?></td>
            <td><?php echo Form::text('lat'); 
                    if($errors->has('lat')){
                        echo $errors->first('lat',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
        <tr>
            <!-- description field -->
            <td><?php echo Form::label('lng', 'Longitude');?></td>
            <td><?php echo Form::text('lng'); 
                    if($errors->has('lng')){
                        echo $errors->first('lng',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
        <tr>
            <!-- description field -->
            <td><?php echo Form::label('description', 'Description');?></td>
            <td><?php echo Form::text('description'); 
                    if($errors->has('description')){
                        echo $errors->first('description',"<span class='error'>:message</span>");
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
