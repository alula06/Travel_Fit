<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<style>
    table{
        width: 100%;
    }
    td {
        border: solid 1px #000;
        padding: 15px;
    }
    
</style>
 
<script type="text/javascript">
    $(document).ready(function(){
        $('a.delete').on('click', function(e){
           var proceed = confirm('Are you sure you want to delete ' + $(this).parent().attr('data-user-fullname') + '?');
           if(!proceed){
               e.preventDefault();
           }
        });
    });
</script>

<div class="container directory">
    <div style="float:left"><h3>User Directory</h3></div>
    <div style="clear:both"></div>
    <table>
        <tr>
            <td width="25">edit</td>
            <td width="25">id</td>
            <td>firstname</td>
            <td>lastname</td>
            <td>email</td>
            <td>password</td>
            <td width="35">delete</td>
        </tr>
    <?php
    foreach($users as $key=>$user){
    ?>
        <tr>
            <td><a href="<?=asset('user')?>/<?=$user->id?>"><i class="fa fa-edit"></i></a></td>
            <td><?=$user->id?></a></td>
            <td><?=e($user->firstname)?></td>
            <td><?=e($user->lastname)?></td>
            <td><?=e($user->email)?></td>
            <td><?=e($user->password)?></td>
            <td data-user-fullname="<?=e($user->firstname) . ' ' . e($user->lastname)?>"><a class="delete" href="<?=asset('user/delete')?>/<?=$user->id?>"><i class="fa fa-times"></i></a></td>
        </tr>
    <?php
    }
    ?>
    </table>
</div>

