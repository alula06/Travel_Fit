<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

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


    <div style="float:left"><h3>Listings Directory</h3></div>
    <div style="float:right"><a href="<?=asset('listing')?>"><button id="addNew"><i class="fa fa-plus"></i> Add New</button></a></div>
    <div style="clear:both"></div>
    <table>
        <tr>
            <td width="25">edit</td>
            <td width="25">id</td>
            <td>name</td>
            <td>description</td>
            <td width="35">delete</td>
        </tr>
    <?php
    foreach($listings as $key => $listing){ //key=>$listing
    ?>
        <tr>
            <td><a href="<?=asset('listing')?>/<?=$listing->id?>"><i class="fa fa-edit"></i></a></td>
            <td><?=$listing->id?></a></td>
            <td><?=$listing->name?></td>
            <td><?=$listing->description?></td>
            <td data-listings-name="<?=$listing->name ?>"><a class="delete" href="<?=asset('listings/delete')?>/<?=$listing->id?>"><i class="fa fa-times"></i></a></td>
        </tr>
    <?php
    }
    ?>
    </table>


