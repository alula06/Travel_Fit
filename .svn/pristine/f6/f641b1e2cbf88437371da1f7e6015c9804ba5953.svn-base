<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<style>

    
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

<div class="container directory">
    <div style="float:left"><h3>Destinations Directory</h3></div>
    <div style="float:right"><a href="<?=asset('destination')?>"><button id="addNew"><i class="fa fa-plus"></i> Add New</button></a></div>
    <div style="clear:both"></div>
    <table>
        <tr>
            <td width="25">edit</td>
            <td width="25">id</td>
            <td>name</td>
            <td>parent_id</td>
            <td>latitude</td>
            <td>longitude</td>
            <td>description</td>
            <td width="35">delete</td>
        </tr>
    <?php
    foreach($destinations as $key => $destination){ //key=>$listing
    ?>
        <tr>
            <td><a href="<?=asset('destination')?>/<?=$destination->id?>"><i class="fa fa-edit"></i></a></td>
            <td><?=$destination->id?></a></td>
            <td><?=$destination->name?></td>
            <td><?=$destination->parent_id?></td>
            <td><?=$destination->lat?></a></td>
            <td><?=$destination->lng?></td>
            <td><?=$destination->description?></td>
            <td data-ratings-name="<?=$destination->name ?>"><a class="delete" href="<?=asset('destinations/delete')?>/<?=$destination->id?>"><i class="fa fa-times"></i></a></td>
        </tr>
    <?php
    }
    ?>
    </table>
</div>

