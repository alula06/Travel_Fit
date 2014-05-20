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
           var proceed = confirm('Are you sure you want to delete this record ?');
           if(!proceed){
               e.preventDefault();
           }
        });
    });
</script>

<div class="container">
    <div style="float:left"><h3>Roles Directory</h3></div>
    <div style="float:right"><a href="<?=asset('role')?>"><button id="addNew"><i class="fa fa-plus"></i> Add New</button></a></div>
    <div style="clear:both"></div>
    <table>
        <tr>
            <td width="25">edit</td>
            <td width="25">id</td>
            <td>name</td>
            <td width="35">delete</td>
        </tr>
    <?php
    foreach($roles as $key => $role){ //key=>$listing
    ?>
        <tr>
            <td><a href="<?=asset('role')?>/<?=$role->id?>"><i class="fa fa-edit"></i></a></td>
            <td><?=$role->id?></a></td>
            <td><?=$role->name?></td>
            <td data-roles-name="<?=$role->id ?>"><a class="delete" href="<?=asset('roles/delete')?>/<?=$role->id?>"><i class="fa fa-times"></i></a></td>
        </tr>
    <?php
    }
    ?>
    </table>
</div>

