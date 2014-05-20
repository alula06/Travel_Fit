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

<div class="container directory">
    <div style="float:left"><h3>Review Directory</h3></div>
    <div style="float:right"><a href="<?=asset('/admin/review')?>"><button id="addNew"><i class="fa fa-plus"></i> Add New</button></a></div>
    <div style="clear:both"></div>
    <table>
        <tr>
            <td width="25">edit</td>
            <td width="25">id</td>
            <td>title</td>
            <td>review</td><!--change dimensions review box here! -->
            <td>rating</td>
            <td>photo</td>
            <td width="35">delete</td>
        </tr>
    <?php
    foreach($reviews as $key=>$review){
    ?>
        <tr>
            <td><a href="<?=asset('/admin/review')?>/<?=$review->id?>"><i class="fa fa-edit"></i></a></td>
            <td><?=$review->id?></a></td>
            <td><?=($review->title)?></td>
            <td><?=($review->review)?></td>
            <td><?=($review->rating)?></td>
            <td><?=($review->photo)?></td>
            <td data-reviews-title="<?=($review->title)?>"><a class="delete" href="<?=asset('/admin/reviews/delete')?>/<?=$review->id?>"><i class="fa fa-times"></i></a></td>
        </tr>
    <?php
    }
    ?>
    </table>
</div>

