<?php

?>

<style>
    table{
        
    }
    td {
        
        padding: 5px;
    }
    
</style>

<div class="container directory">
    <!--<a href="<?=asset('users')?>">&lt;&lt; back to Users</a><br/>-->    
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $user can be NULL
    
        $formUrl = 'register';
    ?>
    
    <?= Form::model($user,array('url' => $formUrl))?>
    <table>
        <thead>
            <tr>
                <th><h3>Registration</h3></th>
            </tr>
        </thead>
        <tr>
            <!-- firstname field -->
            <td width="90"><?php echo Form::label('firstname', 'First Name'); ?></td>
            <td><?php 
                    echo Form::text('firstname');
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
            <!-- password field -->
            <td><?php echo Form::label('password', 'Password');?></td>
            <td><?php echo Form::password('password'); 
                    if($errors->has('password')){
                        echo $errors->first('password',"<span class='error'>:message</span>");
                    }
            ?></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <!-- register button -->
                <?php echo Form::submit('Register');?>
            </td>
        </tr>
    </table>
    <?= Form::close()?>
    <?php  ?>
</div>