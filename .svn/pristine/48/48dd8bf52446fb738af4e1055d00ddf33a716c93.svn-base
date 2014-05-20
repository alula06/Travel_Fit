<?php

?>
<script type="text/javascript">
    $(document).ready(function(){
       
        $('#type').on('change', function(e){
            $('#ratingTypes').find('div.custom').hide().find('input').attr('disabled','disabled');
            $('#ratingTypes').find('div.'+$(this).val()).show().find('input').removeAttr('disabled');
        });
    });
</script>
<style>
    .gray{
        background-color: #EEE; 
    }
    table#edit-address td{padding: 10px;}
</style>
<div class="page">
    
    <?php 
        // open a Model Form (a form with model attached)
        // note that $listing can be NULL
    
        $formUrl = asset('/listing/new');
    ?>
    
    <?php if(isset($backToSearch)){ ?>
        <a role="button" class="btn btn-info" href="<?=e($backToSearch)?>"> < Back to Search Results</a>
    <?php } ?>
    
    <?= Form::model($listing,array('url' => $formUrl, 'files' => true))?>
    <h3>Add Venue</h3>
    <table id="edit-address">
        <tr>
            <!-- type -->
            <td width="150" class="right-align">Type:</td>
            <td>
                <select name="type" id="type">
                    <option value="">Select One</option>
                    <option value="gym">Gym</option>
                    <option value="eatery">Eatery</option>
                    <option value="outdoors">Outdoors</option>
                    <option value="sports">Sports</option>
                </select>
                <?php 
                    if($errors->has('type')){
                        echo $errors->first('type',"<span class='error'>:message</span>");
                    }
                    ?>
            </td>
        </tr>
        <tr>
            <!-- title field -->
            <td class="right-align">Name:</td>
            <td><?php 
                    echo Form::text('name',  Input::old('name', ($listing ? $listing->name:NULL)));
                    if($errors->has('name')){
                        echo $errors->first('name',"<span class='error'>:message</span>");
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <!-- desc -->
            <td valign="top" class="right-align">Description:</td>
            <td><?php 
                if($errors->has('description')){
                        echo $errors->first('description',"<span class='error'>:message</span><br/>");
                }
                echo Form::textarea('description',
                        Input::old('description', ($listing ? $listing->description:NULL)),
                        array('rows'=>4)
                     ); 
            ?></td>
        </tr>
        <tr class="gray">
            <td class="right-align">Street Address:</td>
            <td>
                <?php 
                    echo Form::text('address1',  Input::old('address1', ($listing ? $listing->address1:NULL)));
                    if($errors->has('address1')){
                        echo $errors->first('address1',"<span class='error'>:message</span>");
                    } 
                ?>
                </div>
            </td>
        </tr>
        <tr class="gray">
            <td></td>
            <td><?php 
                    echo Form::text('address2',  Input::old('address2', ($listing ? $listing->address2:NULL)));
                    if($errors->has('address2')){
                        echo $errors->first('address2',"<span class='error'>:message</span>");
                    } 
                ?>
            </td>
        </tr>
        <tr class="gray">
            <td class="right-align">City:</td>
            <td>
                <?php 
                    echo Form::text('city',  Input::old('city', ($listing ? $listing->city:NULL)));
                    if($errors->has('city')){
                        echo $errors->first('city',"<span class='error'>:message</span>");
                    } 
                ?> 
                
                </div>
            </td>
        </tr>
        <tr class="gray">
            <td class="right-align">State:</td>
            <td>
                <?php echo Form::select('state', $allStates); 
                    if($errors->has('state')){
                        echo $errors->first('state',"<span class='error'>:message</span>");
                    }
            ?>
                </div>
            </td>
        </tr>
        <tr class="gray">
            <td class="right-align">Zip:</td>
            <td>
                <?php 
                    echo Form::text('zip',  Input::old('zip', ($listing ? $listing->zip:NULL)));
                    if($errors->has('zip')){
                        echo $errors->first('zip',"<span class='error'>:message</span>");
                    } 
                ?> 
                
                </div>
            </td>
        </tr>
        <tr class="gray">
            <!--  -->
            <td valign="top" class="right-align"><label>Phone</label></td>
            <td  class="address-edit-container">
                <?php 
                    echo Form::text('phone',  Input::old('phone', ($listing ? $listing->phone:NULL)));
                    if($errors->has('phone')){
                        echo $errors->first('phone',"<span class='error'>:message</span>");
                    } 
                ?>
            </td>
        </tr>
        <tr>
            <!-- photo field -->
            <td><?php echo Form::label('photo', 'Photo');?></td>
            <td><?php echo Form::file('photo');?></td>
        </tr>
        <tr class="gray">
            <td colspan="2">
                <div id="ratingTypes" class="gray page">
                    <strong>What ratings are appropriate for this venue?</strong>
                    <?php
                        foreach($allRatingCategories as $ratingCategory){
                            if($ratingCategory->id > 2){
                                if(in_array($ratingCategory->name, array("Ambience","Value"))){
                                ?>
                            <div>
                                <input disabled="disabled" checked="checked" type="checkbox" name="ratingCategories[]" value="<?=$ratingCategory->id?>" /> <?=$ratingCategory->name?>
                            </div>
                                <?php
                                }
                            ?>
                            <div class="custom <?=$ratingCategory->type?>" style="display:none">
                                <input type="checkbox" checked="checked" name="ratingCategories[]" value="<?=$ratingCategory->id?>" /> <?=$ratingCategory->name?>
                            </div>
                            <?php
                            }
                        }
                    ?>
                </div>
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
