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
    <div style="float:left"><h3>Ratings Directory</h3></div>
    <div style="float:right"><a href="<?=asset('rating')?>"><button id="addNew"><i class="fa fa-plus"></i> Add New</button></a></div>
    <div style="clear:both"></div>
    <table>
        <tr>
            <td width="25">edit</td>
            <td width="25">id</td>
            <td>rating_category_id</td>
            <td>value</td>
            <td>user_id</td>
            <td>review_id</td>
            <td>listing_id</td>
            <td width="35">delete</td>
        </tr>
    <?php
    foreach($ratings as $key => $rating){ //key=>$listing
    ?>
        <tr>
            <td><a href="<?=asset('rating')?>/<?=$rating->id?>"><i class="fa fa-edit"></i></a></td>
            <td><?=$rating->id?></a></td>
            <td><?=$rating->rating_category_id?></td>
            <td><?=$rating->value?></td>
            <td><?=$rating->user_id?></a></td>
            <td><?=$rating->review_id?></td>
            <td><?=$rating->listing_id?></td>
            <td data-ratings-rating_category_id="<?=$rating->rating_category_id ?>"><a class="delete" href="<?=asset('ratings/delete')?>/<?=$rating->id?>"><i class="fa fa-times"></i></a></td>
        </tr>
    <?php
    }
    ?>
    </table>
</div>

