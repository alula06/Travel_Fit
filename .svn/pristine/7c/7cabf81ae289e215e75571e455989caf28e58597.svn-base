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
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $user can be NULL
     $formUrl = 'admin/users' . '/'. $user->id;
    ?>
    
    <?= Form::model($user,array('url' => $formUrl))?>
    <table>
        <thead>
            <tr>
                <th><h3>Edit User</h3></th>
            </tr>
        </thead>
        <tr>
            <!-- firstname field -->
            <td width="90"><?php echo Form::label('firstname', 'First Name'); ?></td>
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
            <!-- roles -->
            <td>Roles</td>
            <td>
            <?php
                
            //echo print_r($user->roles(),1);
            foreach($all_user_roles as $role){
                // if currently signed in user is already an admin, can't uncheck it, so render it as hidden
                if($role->name=="admin" && $signedInUser && $signedInUser->roles->contains(1) && $user->id == $signedInUser->id){
            ?>
                <input type="hidden" name="roles[]" value="1" />&nbsp;&nbsp;&nbsp;&nbsp; 
            <?php
                } else {
                // editable choice, render as checkbox    
            ?>
                <input type="checkbox" name="roles[]" value="<?=$role->id?>" <?php if($user->roles->contains($role->id)){ echo 'checked="checked"'; } ?> />
            <?php
                }
                echo ' '.$role->name.'<br/>';
            }
            ?>
            </td>
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
