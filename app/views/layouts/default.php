<!DOCTYPE html>
<html class="no-js ui-mobile-rendering">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, minimum-scale=1, maximum-scale=2">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title>TravelFit</title>
  
<?
$form_post = Input::all();

if(!is_null($user)){
    $relativePath = '/~'.$user.'/';
} else {
    $relativePath = '/';
}
?>
  <!-- /// CSS /// -->
  
  <!-- custom CSS & overrides -->
  <link rel="stylesheet" type="text/css" href="<?=asset('/css/bootstrap.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('/css/jquery.notifyBar.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('/css/jquery.notifyBar.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('/css/font-awesome.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('/css/main.css')?>">
  
  <!-- custom google fonts -->
  <link href='http://fonts.googleapis.com/css?family=Lustria' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  
  
  <!-- /// JS /// -->
  <script type="text/javascript" src="<?=asset('/js/jquery-2.0.3.min.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/jquery-ui.min.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/jquery.notifyBar.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/jquery.ui.core.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/jquery.ui.widget.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/jquery.ui.position.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/jquery.ui.autocomplete.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/bootstrap-rating-input.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/global.js')?>"></script>
  <script type="text/javascript" src="<?=asset('/js/bootstrap.min.js')?>"></script>

   <!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?=asset('/fancybox/lib/jquery.mousewheel-3.0.6.pack.js')?>"></script>

  <!-- Add fancyBox -->
  <link rel="stylesheet" href="<?=asset('/fancybox/source/jquery.fancybox.css?v=2.1.5')?>" type="text/css" media="screen" />
  <script type="text/javascript" src="<?=asset('/fancybox/source/jquery.fancybox.pack.js?v=2.1.5')?>"></script>

  <!-- Optionally add helpers - button, thumbnail and/or media -->
  <link rel="stylesheet" href="<?=asset('/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5')?>" type="text/css" media="screen" />
  <script type="text/javascript" src="<?=asset('/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5')?>"></script>
  <script type="text/javascript" src="<?=asset('/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6')?>"></script>

  <link rel="stylesheet" href="<?=asset('/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7')?>" type="text/css" media="screen" />
  <script type="text/javascript" src="<?=asset('/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7')?>"></script>
  
  <script type="text/javascript">
      $(document).ready(function(){
          <?php if(!is_null($flashMessage)){ ?>
              showSuccess('<?=$flashMessage?>');
          <?php } ?>
              
         // bind the autocomplete on search input
        $( "#destinationTerm" ).autocomplete({ 
            appendTo: "#destinationSuggest",
            source: function( request, response ) {
                $.ajax({
                  type: 'POST',
                  url: '<?=asset('/destination/search')?>',
                  data: {
                    destinationTerm: request.term
                  },
                  success: function( data ) {
                    var data = $.parseJSON(data);
                    console.log(data.results);
                    response( $.map( data.results, function( item ) {
                      console.log(item);
                      return {
                        value: item.name
                      }
                    }));
                  }
                });
            },
            messages:{
                noResults: '',
                results: function(){}
            },
            minLength: 1,
            select: function( event, ui ) {
                if(ui.item.value.length > 0){
                    $('#destinationId').val(ui.item.value);
                }
            },
            open: function() {
                $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                $(".dropdown-toggle").dropdown('destinationSuggest')
            },
            close: function() {
                $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            }
        });
        
        $('[rel=tooltip]').tooltip(); 
        
        $(".fancybox-thumb").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});
      });
     
  </script>
   <!-- asynchronous google analytics. change UA-XXXXX-X to your site's ID -->
    <script>
        var _gaq=[['_setAccount','UA-23865777-1'],['_trackPageview']];
        (function(d,t){
    		var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        	s.parentNode.insertBefore(g,s)
    	}(document,'script'));
    </script>
</head>
<body id="body-container"> 
    <nav class="navbar navbar-default" role="navigation">
        <div id="navbar-logo" class="navbar-header">
            <a class="navbar-brand" href="<?=asset('/')?>"><img src="<?=asset('/images/logo.png')?>"></a>
        </div>
        <?php 
        // open a Model Form (a form with model attached)
        // note that $user can be NULL
    
            $signedIn ? $formUrl = 'logout' : $formUrl = 'login';
        ?>
        <ul id="navbar-login-container" class="navbar-right pull-right">
            
        <?= Form::model($user,array('url' => $formUrl , 'class' => ''))?>
        <!-- checking if user is currently logged in -->
        <?php
                if($signedIn){ ?>
        <div style="text-align:right">
            <b><?= $signedInUser->email?></b>&nbsp;&nbsp;
            <input class="btn btn-sm pull-right" type="submit" value="Logout" />
            <a class="btn btn-primary btn-sm pull-right" style="margin-right:2px" href="<?=asset('/register')?>">Edit Profile</a>
        </div>
        <?php } else {
                ?>
            <table>
                <tr>
                    <td valign="top">
                        <?php 
                        echo Form::text('email', isset($form_post['email'])?$form_post['email']:'', array('placeholder' => 'Email', 'class'=>'text input-sm'));
                        if($errors->has('email')){
                            echo '<br/>'.$errors->first('email',"<span class='error'>invalid email</span>");
                        }
                        ?>
                    </td>
                    <td valign="top">
                        <?php
                        echo Form::password('password', array('placeholder' => 'Password', 'class'=>'text input-sm'));
                        if($errors->has('password')){
                            echo '<br/>'.$errors->first('password',"<span class='error'>invalid password</span>");
                        }
                        ?>
                    </td>
                    <td valign="top"><input class="btn btn-sm" type="submit" value="Login" /></td>
                    <td valign="top"><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reg">Register</a></td>
                </tr>
            </table>
            <? } ?>
            <?= Form::close()?>
       <!--</ul>-->
        </ul>
        <ul class="navbar-brand">
            <div id="disclaimer_header"><strong>SFSU CS640/848 Student Project Demo Site ~ Group 6</strong></div>
            
            <form class=" form-inline center-block " id="searchbar" method='GET' action="<?=asset('/topSearch')?>">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Keyword, Category" name="listingTerm" value="<?=$searchListing?>">
                </div>
                <div class="form-group"> 
                    <input type="text" class=" ui-widget form-control ui-autocomplete-input"  placeholder="City, State" id="destinationTerm"  name="destinationTerm" value="<?=$searchDestination?>">
                    <input type="hidden" name="destinationId" id="destinationId" />
                </div>        
                <div class="form-group">
                    <input type="submit" value ="Search" class="btn btn-warning"> 
                </div>  
              <ul class="ui-autocomplete text-left col-md-5" id="destinationSuggest"></ul>
            </form>
        </ul>
    </nav>
    <nav id="main-nav" class="navbar navbar-default" role="navigation">
        <div id="nav-write-a-review">
            <a class="btn btn-success" href="<?=asset('/review')?>">Write a Review</a>
        </div>
            <a class="btn btn-primary" href="<?=asset('/')?>">Home</a>
            <a class="btn btn-primary" href="<?=asset('/topSearch?listingType=gym')?>" name ="listingType">Gyms</a>           
            <a class="btn btn-primary" href="<?=asset('/topSearch?listingType=eatery')?>">Eateries</a>     
            <a class="btn btn-primary" href="<?=asset('/topSearch?listingType=outdoor')?>">Outdoors</a>
            <a class="btn btn-primary" href="<?=asset('/topSearch?listingType=sports')?>">Sports</a>
            
            <?php if ($signedIn && $signedInUser->roles->contains(1)) { ?>
            <a class="btn btn-danger" href="<?=asset('/admin/users')?>">Users</a>
            <!--<a class="btn btn-danger" href="<?=asset('/admin/destinations')?>">Destinations</a>-->
            <?php } ?> 
            
        <div class="modal fade" id="reg">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <center><h3>Registration Page</h3></center>
                    </div>
                    <div class="modal-body text-center">
                        <?= Form::model($user, array('url' => 'register')) ?>
                        <table border ='0' align="center" width="75%" style="margin-left: 10%">
                            <tr>
                                <!-- firstname field -->
                                <td><?php echo Form::label('firstname', 'First Name'); ?></td>
                                <td><?php
                                    echo Form::text('firstname');
                                    if ($errors->has('firstname')) {
                                        echo $errors->first('firstname', "<span class='error'>:message</span>");
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <!-- lastname field -->
                                <td><?php echo Form::label('lastname', 'Last Name'); ?></td>
                                <td><?php
                                    echo Form::text('lastname');
                                    if ($errors->has('lastname')) {
                                        echo $errors->first('lastname', "<span class='error'>:message</span>");
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <!-- email field -->
                                <td><?php echo Form::label('email', 'Email'); ?></td>
                                <td><?php
                                    echo Form::text('email');
                                    if ($errors->has('email')) {
                                        echo $errors->first('email', "<span class='error'>:message</span>");
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <!-- password field -->
                                <td><?php echo Form::label('password', 'Password'); ?></td>
                                <td><?php
                                    echo Form::password('password');
                                    if ($errors->has('password')) {
                                        echo $errors->first('password', "<span class='error'>:message</span>");
                                    }
                                    ?></td>
                            </tr>
                        </table>

                    </div>
          <div class="modal-footer">
            <?php echo Form::submit('Register', array('class' => 'btn btn-lg btn-primary center'));?>
          </div>
                    <?= Form::close()?>
        </div>
            </div>
        </div>
            
    </nav>
       
    <div class="container">
        <div class="row">
         
                <div class="col-md-2"></div>
                <div class="col-md-8"><?php echo $content; ?></div>
                <div class="col-md-2"></div>  
        </div>
        <div id="push"></div>

        </div>
</body>
</html>