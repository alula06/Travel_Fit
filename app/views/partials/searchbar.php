<form class="searchbar form-inline " method='GET' action="<?=asset('/topSearch')?>">
      <div class="form-group col-md-8">
         <input type="text" class="form-control input-lg" placeholder="" name="listingTerm" <?php if(isset($input['listingTerm'])){ echo 'value="'.e($input['listingTerm']).'"'; } ?>>
      </div>
         <div class="form-group">
         <input type="submit" value ="Search" class="btn btn-warning btn-lg"> 
      </div>
</form>