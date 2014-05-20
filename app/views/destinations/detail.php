<?php

?>

<div class="container">
    <div class="span12">
    <!--<a href="<?=asset('destinations')?>">&lt;&lt; back to Listings</a><br/>-->    
    
    <?php 
    // if Admin user, set flag
    $admin = FALSE;
    if($signedIn && !is_null($signedInUser) && $signedInUser->roles->contains(1)){
        $admin = TRUE;
        
        ?>
        <form enctype="multipart/form-data" accept-charset="UTF-8" action="<?=asset('destination/'.$destination->id)?>" method="POST">
    <?php        
    }
    ?>
            <center><h1><?php echo $destination->name ?></h1></center>
            
            <div class="col-md-6">
                <?php if($images && !is_null($images->first())) { 
                    $image = $images->first(); 
                    $imageSrc = 'images'. $image->image->filepath . $image->image->id.'.'.$image->image->filetype;
                ?>
                <a class="fancybox-thumb" rel="fancybox-thumb" href="<?=asset($imageSrc)?>" >
                    <img src="<?=asset($imageSrc)?>" style='max-width: 300px; max-height:300px; overflow: hidden;' alt=""/>
                </a>

                <div style="margin: auto; width: 100%; height:50px; overflow: auto; float:left; display:inline; "> 
                <?php foreach ($images as $image) { 
                    $imageSrc = 'images'. $image->image->filepath . $image->image->id.'.'.$image->image->filetype;
                    ?>    
                            <a class="fancybox-thumb" rel="fancybox-thumb" href="<?=asset($imageSrc)?>"  >
                                <img src="<?=asset($imageSrc)?>" alt="" style="width:50px; height:50px;" />
                            </a>

                   <?php } ?>
                    </div>
                <?php } else { ?>
                    <a class="fancybox-thumb" rel="fancybox-thumb" href="<?=asset('/images/thumb2.jpg')?>" >
                        <img src="<?=asset('/images/thumb2.jpg')?>" alt="" style="margin: auto; width: 300px; height: 260px;"/>
                    </a>
               <?php } ?>
            </div>

            <div class="col-md-6 ">    
                
                <?php

                    // if Admin user, show photo upload
                    if($admin){
                    ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Admin Edit Destination</h3>
                            </div>
                            <div class="panel-body">
                                <strong>Description</strong><br/>
                                
                            <?php    
                            if($errors->has('description')){
                                    echo $errors->first('description',"<span class='error'>:message</span><br/>");
                            }
                            echo Form::textarea('description',
                                    Input::old('description', ($destination ? $destination->description:NULL)),
                                    array('rows'=>4, 'cols'=>30)
                                 ); ?>
                                    <input type="file" id="photo" name="photo">
                                    <input type='submit' value='Save' />
                                </form>
                            </div>
                        </div>
                    <?php    
                    } else {
                    ?>  
                        
                        <!-- DESCRIPTION -->
                        <?php
                        if(strlen(e($destination->description))){ ?>
                        <div class="panel panel-default">
                          <div class="panel-body" style='font-size: 16px;'>
                            <strong>About <?=$destination->name?></strong><br/>
                            <?= e($destination->description) ?>
                          </div>
                          <!--<div class="panel-footer">Panel footer</div>-->
                        </div>            
                        <?php } ?>
                        
                    <?php
                    }

                    ?>
                    

            </div>
    </div>
    <?php
    if($admin){
    ?>
        </form>
    <?php } ?>

        <div style='clear:both'></div>
            
    <hr>
    
    <div class="panel panel-default">
    <div class="panel-heading"><h4>Top-rated Restaurants</h4></div>
    <div class="panel-body">
    
    <table style="border:#ddd" border="1" width ="100%" class="center">
        <tr width="30%" align="center">
    <?php 
        foreach($top_foods as $listing){
        ?>
<td width="30%" align="center">
                <table align="center" class="text-center">
                    <tr>
                        <td colspan="2" style="border-bottom: 1px #ddd solid">
                             <a href="<?=asset('/listing/'.$listing->id)?>"><?=e($listing->name)?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                $imageId = ListingsImages::where('listings_id', $listing->id)->pluck('images_id');
                                if(!is_null($imageId)){
                                $image = Images::where('id', $imageId)->get();
                                foreach($image as $item){      
                            ?>
                                <img class="thumbnail thumb" src="<?=asset('/images/listings/'. $item->id.'.'. $item->filetype)?>">
                                    <?php } ?>
                                    <?php } else {?>
                                <img class="thumbnail thumb" src="<?=asset('/images/thumbnail.jpg')?>">
                                <?php } ?>
                            <p>
                                <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><br/>
                                <span style='color:red'><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart-o'></i></span> <a rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Healthy Rating" style="text-decoration: none">?</a>
                            </p>
                        </td>
                        <td>
                        <p>
                            <b>Description:</b> <?=e($listing->description)?>
                        </p>
                        </td>
                </table>
            </td>        
        <?php
        }
        ?>
        </tr>
    </table>
    </div>
    </div>
    
    <hr>
    
    <div class="panel panel-default">
    <div class="panel-heading"><h4>Top-rated Gyms</h4></div>
    <div class="panel-body">
    
    
    <table style="border:#ddd" border="1" width ="100%" class="center">
        <tr>
    <?php 
        foreach($top_gyms as $listing){
        ?>
            <td width="30%" align="center">
                <table align="center" class="text-center">
                    <tr>
                        <td colspan="2" style="border-bottom: 1px #ddd solid">
                             <a href="<?=asset('/listing/'.$listing->id)?>"><?=e($listing->name)?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                $imageId = ListingsImages::where('listings_id', $listing->id)->pluck('images_id');
                                if(!is_null($imageId)){
                                $image = Images::where('id', $imageId)->get();
                                foreach($image as $item){      
                            ?>
                                <img class="thumbnail thumb" src="<?=asset('/images/listings/'. $item->id.'.'. $item->filetype)?>">
                                    <?php } ?>
                                    <?php } else {?>
                                <img class="thumbnail thumb" src="<?=asset('/images/thumbnail.jpg')?>">
                                <?php } ?>
                            <p>
                                <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><br/>
                                <span style='color:red'><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart-o'></i></span><a rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Healthy Rating" style="text-decoration: none">?</a>
                            </p>
                        </td>
                        <td>
                        <p>
                            <b>Description:</b> <?=e($listing->description)?>
                        </p>
                        </td>
                </table>
            </td>        
        <?php
        }
        ?>
        </tr>
    </table>
    </div>
    </div>
    
    <hr>
    
    <div class="panel panel-default">
    <div class="panel-heading"><h4>Top-rated Outdoors</h4></div>
    <div class="panel-body">
    
    <table style="border:#ddd" border="1" width ="100%" class="center">
        <tr>
    <?php 
        foreach($top_outdoors as $listing){
        ?>
<td width="30%" align="center">
                <table align="center" class="text-center">
                    <tr>
                        <td colspan="2" style="border-bottom: 1px #ddd solid">
                             <a href="<?=asset('/listing/'.$listing->id)?>"><?=e($listing->name)?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                $imageId = ListingsImages::where('listings_id', $listing->id)->pluck('images_id');
                                if(!is_null($imageId)){
                                $image = Images::where('id', $imageId)->get();
                                foreach($image as $item){      
                            ?>
                                <img class="thumbnail thumb" src="<?=asset('/images/listings/'. $item->id.'.'. $item->filetype)?>">
                                    <?php } ?>
                                    <?php } else {?>
                                <img class="thumbnail thumb" src="<?=asset('/images/thumbnail.jpg')?>">
                                <?php } ?>
                            <p>
                                <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><br/>
                                <span style='color:red'><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart-o'></i></span><a rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Healthy Rating" style="text-decoration: none">?</a>
                            </p>
                        </td>
                        <td>
                        <p>
                            <b>Description:</b> <?=e($listing->description)?>
                        </p>
                        </td>
                </table>
            </td>        
        <?php
        }
        ?>
        </tr>
    </table>
    </div>
    </div>
    
    <hr>
    
    <div class="panel panel-default">
    <div class="panel-heading"><h4>Top-rated Sports</h4></div>
    <div class="panel-body">
    
    <table border="1" style="border:#ddd" width ="100%" class="center">
        <tr>
    <?php 
        foreach($top_sports as $listing){
        ?>
<td width="30%" align="center">
                <table align="center" class="text-center">
                    <tr>
                        <td colspan="2" style="border-bottom: 1px #ddd solid">
                             <a href="<?=asset('/listing/'.$listing->id)?>"><?=e($listing->name)?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                $imageId = ListingsImages::where('listings_id', $listing->id)->pluck('images_id');
                                if(!is_null($imageId)){
                                $image = Images::where('id', $imageId)->get();
                                foreach($image as $item){      
                            ?>
                                <img class="thumbnail thumb" src="<?=asset('/images/listings/'. $item->id.'.'. $item->filetype)?>">
                                    <?php } ?>
                                    <?php } else {?>
                                <img class="thumbnail thumb" src="<?=asset('/images/thumbnail.jpg')?>">
                                <?php } ?>
                            <p>
                                <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><br/>
                                <span style='color:red'><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart'></i><i class='fa fa-heart-o'></i></span><a rel="tooltip" data-toggle="tooltip" data-placement="right" title="" data-original-title="Healthy Rating" style="text-decoration: none">?</a>
                            </p>
                        </td>
                        <td>
                            <p>
                            <b>Description:</b> <?=e($listing->description)?>
                        </td>
                </table>
            </td>        
        <?php
        }
        ?>
        </tr>
    </table>
    </div>
    </div>
</div>
