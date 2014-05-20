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
    <!--<a href="<?=asset('users')?>">&lt;&lt; back to Users</a><br/>-->    
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $user can be NULL
    
        $formUrl = 'user' . '/'. $user->id;
    ?>
    
    <?= Form::model($user,array('url' => $formUrl))?>
    <table>
        <thead>
            <tr>
                <th colspan="2"><h3>Edit Your Profile</h3></th>
            </tr>
        </thead>
        <tr>
            <!-- firstname field -->
            <td width="150"><?php echo Form::label('firstname', 'First Name'); ?></td>
            <td><?php 
                    echo Form::text('firstname',  Input::old('firstname', ($user ? $user->firstname:NULL)));
                    if($errors->has('firstname')){
                        echo $errors->first('firstname',"<span class='error'>:message</span>");
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <!-- lastname field -->
            <td><?php echo Form::label('lastname', 'Last Name');?></td>
            <td><?php echo Form::text('lastname'); 
                    if($errors->has('lastname')){
                        echo $errors->first('lastname',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
        <tr>
            <!-- email field -->
            <td><?php echo Form::label('email', 'Email');?></td>
            <td><?php echo Form::text('email'); 
                    if($errors->has('email')){
                        echo $errors->first('email',"<span class='error'>:message</span>");
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
