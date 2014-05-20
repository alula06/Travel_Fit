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
    <!--<a href="<?=asset('roles')?>">&lt;&lt; back to Listings</a><br/>-->    
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $listing can be NULL
    
        $formUrl = 'role' . (is_null($role)?'':'/'.$role->id);
    ?>
    
    <?= Form::model($role,array('url' => $formUrl))?>
    <table>
        <thead>
            <tr>
                <th><h3><?=is_null($role)?'Add Roles':'Edit Roles'?></h3></th>
            </tr>
        </thead>
        
        <tr>
            <!-- description field -->
            <td><?php echo Form::label('name', 'Name');?></td>
            <td><?php echo Form::text('name'); 
                    if($errors->has('name')){
                        echo $errors->first('name',"<span class='error'>:message</span>");
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
