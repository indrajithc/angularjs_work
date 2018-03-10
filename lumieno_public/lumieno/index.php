<?php
     include_once( '../path.php' );  

     session_start();

     
      include_once( '../root/connection.php' ); 
     auth_login();


      try { 
        global $a;
        $db = new Database();

      } catch (Exception $e) {

      }

      try {
        date_default_timezone_set("Asia/Kolkata");
      } catch (Exception $e) {

      }

      $profile_image = '../assets/images/user.png' ; 

      $cat_success = selectFromTable ('name, email, mobile, image ', 'lumieno', " id != 0 ORDER BY date LIMIT 1" , $db );
        if( $cat_success ) {
            $profile = $cat_success[0];

      if( !is_null($profile['image']) && $profile['image'] != "") 
        if (file_exists('media/images/' . $profile['image'] ))    
          $profile_image =  'media/images/' . $profile['image'];
        $profile['image'] =  $profile_image ;


      } 
 


 

       



      


?>
<!--  onerror="javascript:this.src='assets/images/default.png'"  -->
 
<html lang="eng" ng-app="lumieno">
<head>

<base href="<?php echo DIRECTORY_ADMIN ; ?>">

<title><?php  echo DISPLAY_NAME; ?></title>

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

  <link rel="apple-touch-icon" sizes="57x57" href="../assets/images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="../assets/images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="../assets/images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="../assets/images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="../assets/images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="../assets/images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="../assets/images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="../assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="a../ssets/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="../assets/images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="../assets/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">


<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>







<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"  type="text/css" media="all" / >
<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome-animation.min.css" type="text/css" media="all" />
          <!--   faa-wrench animated  faa-wrench animated-hover  faa-wrench  // fa-spin //-->

<link rel="stylesheet" href="../assets/css/animate.min.css"  type="text/css" media="all" / >


<!-- <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.min.css"  type="text/css" media="all" / > -->
 
 <link rel="stylesheet" href="../assets/css/datepicker.css" >


<link rel="stylesheet" href="../assets/lobibox/css/lobibox.min.css"  type="text/css" media="all" / >

<link rel="stylesheet" href="../assets/css/cropper.css"  type="text/css" media="all" / >

<link rel="stylesheet" href="../assets/css/ngprogress-lite.css"  type="text/css" media="all" / >
 

<link href="../assets/theme/a1/css/style.css?v={}" rel="stylesheet" type="text/css" media="all" />

<link href="../assets/theme/a1/css/custom.css?v={}" rel="stylesheet" type="text/css" media="all" />







<script src="../assets/lib/angular.min.js"></script>
<script src="../assets/lib/angular-route.min.js"></script>
<script src="../assets/lib/angular-animate.min.js"></script>
<script src="../assets/js/jquery-1.11.3.min.js"></script>
  
 
</head>
<body>
<div id="wrapper">

    <header ng-include="'pages/header.html'"></header>
      <nav class="top1 navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0">
                 <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="sr-only">Toggle navigation</span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                     </button>
                     <a class="navbar-brand" href="../"><?php echo DISPLAY_NAME; ?></a>
                 </div>
                 <!-- /.navbar-header -->
                 <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown">
                      <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-comments-o"></i><span class="badge">4</span></a>
                         <ul class="dropdown-menu">
                             <li class="dropdown-menu-header">
                                 <strong>Messages</strong>
                                 <div class="progress thin">
                                   <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                     <span class="sr-only">40% Complete (success)</span>
                                   </div>
                                 </div>
                             </li>
                             <li class="avatar">
                                 <a href="#">
                                     <img id="loged_in_image" src="" alt=""/>
                                     <div>New message</div>
                                     <small>1 minute ago</small>
                                     <span class="label label-info">NEW</span>
                                 </a>
                             </li>
                             <li class="avatar">
                                 <a href="#">
                                     <img src="images/2.png" alt=""/>
                                     <div>New message</div>
                                     <small>1 minute ago</small>
                                     <span class="label label-info">NEW</span>
                                 </a>
                             </li>
                             <li class="avatar">
                                 <a href="#">
                                     <img src="images/3.png" alt=""/>
                                     <div>New message</div>
                                     <small>1 minute ago</small>
                                 </a>
                             </li>
                             <li class="avatar">
                                 <a href="#">
                                     <img src="images/4.png" alt=""/>
                                     <div>New message</div>
                                     <small>1 minute ago</small>
                                 </a>
                             </li>
                             <li class="avatar">
                                 <a href="#">
                                     <img src="images/5.png" alt=""/>
                                     <div>New message</div>
                                     <small>1 minute ago</small>
                                 </a>
                             </li>
                             <li class="avatar">
                                 <a href="#">
                                     <img src="images/pic1.png" alt=""/>
                                     <div>New message</div>
                                     <small>1 minute ago</small>
                                 </a>
                             </li>
                             <li class="dropdown-menu-footer text-center">
                                 <a href="#">View all messages</a>
                             </li>   
                         </ul>
                     </li> -->
                     <li class="dropdown nvhead">
                         <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><img src="<?php echo $profile['image']; ?>" alt=""/><span class="badge">9</span></a>
                         <ul class="dropdown-menu">
                             <li class="dropdown-menu-header text-center">
                                 <strong>Account</strong>
                             </li>
                             <li class="m_2"><a href="#"><i class="fa fa-bell-o"></i> Updates <span class="label label-info">42</span></a></li>
                             <li class="m_2"><a href="#"><i class="fa fa-envelope-o"></i> Messages <span class="label label-success">42</span></a></li>
                             <li class="m_2"><a href="#"><i class="fa fa-tasks"></i> Tasks <span class="label label-danger">42</span></a></li>
                             <li><a href="#"><i class="fa fa-comments"></i> Comments <span class="label label-warning">42</span></a></li>
                             <li class="dropdown-menu-header text-center">
                                 <strong>Settings</strong>
                             </li>
                             <li class="m_2"><a href="profile"><i class="fa fa-user"></i> Profile</a></li>
                             <li class="m_2"><a href="basic"><i class="fa fa-wrench"></i> Settings</a></li>
                             <li class="m_2"><a href="#"><i class="fa fa-usd"></i> Payments <span class="label label-default">42</span></a></li>
                             <li class="m_2"><a href="#"><i class="fa fa-file"></i> Projects <span class="label label-primary">42</span></a></li>
                             <li class="divider"></li>
                             <li class="m_2"><a href="#"><i class="fa fa-shield"></i> Lock Profile</a></li>
                             <li class="m_2"><a href="../logout"><i class="fa fa-lock"></i> Logout</a></li>  
                         </ul>
                     </li>
                 </ul>
                 <!-- <form class="navbar-form navbar-right">
                   <input type="text" class="form-control" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
                 </form> -->
                 <div class="navbar-default sidebar" role="navigation">
                     <div class="sidebar-nav navbar-collapse">
                         <ul class="nav" id="side-menu">
                             <li>
                                 <a href="dashboard"><i class="fa fa-dashboard fa-fw nav_icon"></i>Dashboard</a>
                             </li>
 
                             <li>
                                 <a href="email"><i class="fa fa-envelope fa-fw nav_icon"></i>Emails</a>
                             </li>

                             <li>
                                 <a href="#"><i class="fa fa-product-hunt  fa-fw nav_icon"></i>Product<span class="fa arrow"></span></a>
                                 <ul class="nav nav-second-level">
                                     <li>
                                         <a href="category">Category</a>
                                     </li>
                                     <li>
                                         <a href="product">Product</a>
                                     </li>
                                 </ul>
                                 <!-- /.nav-second-level -->
                             </li>
                             


                            
                            <li>
                                <a href="#"><i class="fa fa-product-hunt  fa-fw nav_icon"></i>Cart<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                     <li>
                                         <a href="cart">complete cart</a>
                                     </li>
                                     <li>
                                         <a href="carthistory">Carts</a>
                                     </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            

                             <li>
                                 <a href="team"><i class="fa fa-users nav_icon"></i>Team</a>
                             </li>
                          
                             <li>
                                 <a href="links"><i class="fa fa-link nav_icon"></i>Links</a>
                             </li>
                          
                             <li>
                                 <a href="look"><i class="fa fa-street-view nav_icon"></i>Look</a>
                             </li>
                             <li>
                                 <a href="view"><i class="fa fa-eye nav_icon"></i>Look</a>
                             </li>
                           
                             <li>
                                 <a href="distributor"><i class="fa fa-th-list nav_icon"></i>Distributor</a>
                             </li>
                           



                             <li>
                                 <a href="#"><i class="fa  fa-ellipsis-h  fa-user-circle nav_icon text-capitalize"></i>customer<span class="fa arrow"></span></a>
                                 <ul class="nav nav-second-level">
                                     <li>
                                         <a href="customer">profiles</a>
                                     </li>
                                     
                                     
                                 </ul>
                                 <!-- /.nav-second-level -->
                             </li>
                             



                             <li>
                                 <a href="#"><i class="fa  fa-ellipsis-h  fa-fw nav_icon text-capitalize"></i>other<span class="fa arrow"></span></a>
                                 <ul class="nav nav-second-level">
                                     <li>
                                         <a href="instructions">instructions</a>
                                     </li>
                                     
                                     
                                 </ul>
                                 <!-- /.nav-second-level -->
                             </li>
                             









                         </ul>
                     </div>
                     <!-- /.sidebar-collapse -->
                 </div>
                 <!-- /.navbar-static-side -->
             </nav> 
        <div id="page-wrapper">
        <div class="graphs">

        <main ng-view></main> 
       


        <footer ng-include="'pages/footer.html'"></footer>       
           <div class="copy">

                <p>&copy; 2017  <?php  echo DISPLAY_NAME; ?>. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a> <span class="nowu">and copied and modified by </span><a href="<?php echo PATH; ?>"><?php  echo DISPLAY_NAME; ?></a>  </p>


           </div>
 
        </div>
       </div> 




       <form    method="post" class="hidden" action="../root/upladimage.php" enctype="multipart/form-data" id="select-upload-me-1-1">
           <input type="file" name="image[]"   class="hidden"  multiple="false" accept="image/x-png,image/gif,image/jpeg"  />
           <input type="submit" name="upload" value="Upload" class="hidden"/>
       </form>  




       <form    method="post" class="hidden" action="../root/upladimage.php" enctype="multipart/form-data" id="select-upload-me">
           <input type="file" name="image[]"   class="hidden"  multiple="multiple" accept="image/x-png,image/gif,image/jpeg"  />
           <input type="submit" name="upload" value="Upload" class="hidden"/>
       </form>  


        <div>
         <!-- Button trigger modal -->
         <button type="button" id="setImg" class="btn btn-primary hidden" data-target="#modal-1" data-toggle="modal"> </button>

         <!-- Modal -->
         <div class="modal fade dmodel" id="modal-1" role="dialog" aria-labelledby="modalLabel" tabindex="-1" to_this=""   >
          <div class="modal-dialog" role="document">
            <div class="modal-content" >
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop image</h5>
                <button type="button" class="close hidden" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body  ">
                <div class="img-container " style="max-height: 400px !important;">
                  <img id="image-1" src="../assets/images/loding.gif" alt="Picture" style="max-width: 570px; width: auto; height: auto; max-height: 400px;">
                </div>
              </div>
              <div class="modal-footer"> 

                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />

                <input type="hidden" id="r" name="r" />
                <input type="hidden" id="sx" name="sx" />
                <input type="hidden" id="sy" name="sy" />
                <button type="button" id="crop_btn" class="btn btn-default" data-dismiss="modal">save</button>
              </div>
            </div>
          </div>
        </div>
        </div>



        <div>
         <!-- Button trigger modal -->
         <button type="button" id="setBigImg" class="btn btn-primary hidden" data-target="#modal-2" data-toggle="modal"> </button>

         <!-- Modal -->
         <div class="modal fade dmodel" id="modal-2" role="dialog" aria-labelledby="modalLabel" tabindex="-1" to_this=""   >
          <div class="modal-dialog" role="document">
            <div class="modal-content" >
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop image</h5>
                <button type="button" class="close hidden" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body  ">



        <div id="show-edit-crop" style="display: none;">
        <div class="row cropper" >
            <h3 style="padding-top: 20px;">Edit:</h3>
          <div class="col-md-12" >
            <div class="img-container img-containers "  style="max-height: 516px !important; width: 700px !important;" >
              <img id="crop_img_id" src="../assets/images/default.png" alt="Picture">
            </div>
          </div>
          <div class="col-md-12">
            <!-- <h3>Preview:</h3> -->
            <div class=" docs-preview clearfix" >
              <div class="img-preview preview-lg"></div>
              <div class="img-preview preview-md"></div>
              <div class="img-preview preview-sm"></div>
              <div class="img-preview preview-xs"></div>
            </div>



            <!-- <h3>Data:</h3> -->
            <div class="docs-data hidden">
              <div class="input-group input-group-sm">
                <label class="input-group-addon" for="xname">name</label>
                <input type="text" class="form-control" id="xname" placeholder="name" disabled="disabled"> 
              </div>
              <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataX">X</label>
                <input type="text" class="form-control" id="dataX" placeholder="x" disabled="disabled">
                <span class="input-group-addon">px</span>
              </div>
              <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataY">Y</label>
                <input type="text" class="form-control" id="dataY" placeholder="y" disabled="disabled">
                <span class="input-group-addon">px</span>
              </div>
              <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataWidth">Width</label>
                <input type="text" class="form-control" id="dataWidth" placeholder="width" disabled="disabled">
                <span class="input-group-addon">px</span>
              </div>
              <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataHeight">Height</label>
                <input type="text" class="form-control" id="dataHeight" placeholder="height" disabled="disabled">
                <span class="input-group-addon">px</span>
              </div>
          <!--     <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataRotate">Rotate</label>
                <input type="text" class="form-control" id="dataRotate" placeholder="rotate" disabled="disabled">
                <span class="input-group-addon">deg</span>
              </div> -->
              <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataScaleX">ScaleX</label>
                <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX" disabled="disabled">
              </div>
              <div class="input-group input-group-sm">
                <label class="input-group-addon" for="dataScaleY">ScaleY</label>
                <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY" disabled="disabled">
              </div>
            </div>
          </div>
        </div>




   <div class="row" id="actions"  >
     <div class="col-md-12 docs-buttons my-actions">
       <h3>Toolbar:</h3>

       <div class="btn-group">
         <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;move&quot;)">
             <span class="fa fa-arrows"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;crop&quot;)">
             <span class="fa fa-crop"></span>
           </span>
         </button>
       </div>

       <div class="btn-group">
         <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
             <span class="fa fa-search-plus"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
             <span class="fa fa-search-minus"></span>
           </span>
         </button>
       </div>

       <div class="btn-group">
         <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
             <span class="fa fa-arrow-left"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
             <span class="fa fa-arrow-right"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
             <span class="fa fa-arrow-up"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
             <span class="fa fa-arrow-down"></span>
           </span>
         </button>
       </div>

  <!--      <div class="btn-group">
         <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
             <span class="fa fa-rotate-left"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
             <span class="fa fa-rotate-right"></span>
           </span>
         </button>
       </div>
   -->
 <!--       <div class="btn-group">
         <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleX(-1)">
             <span class="fa fa-arrows-h"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleY(-1)">
             <span class="fa fa-arrows-v"></span>
           </span>
         </button>
       </div> -->

       <div class="btn-group">
         <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.crop()">
             <span class="fa fa-check"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.clear()">
             <span class="fa fa-remove"></span>
           </span>
         </button>
       </div>

       <div class="btn-group">
         <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.disable()">
             <span class="fa fa-lock"></span>
           </span>
         </button>
         <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.enable()">
             <span class="fa fa-unlock"></span>
           </span>
         </button>
       </div>

       <div class="btn-group">
         <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
           <span class="docs-tooltip" data-toggle="tooltip" title="cropper.reset()">
             <span class="fa fa-refresh"></span>
           </span>
         </button> 
       </div>
   


   <div class="btn-group">
   <button type="button" class="btn btn-primary" data-method="moveTo" data-option="0">
     <span class="docs-tooltip" data-toggle="tooltip" title="cropper.moveTo(0)">
       0,0
     </span>
   </button>
   <button type="button" class="btn btn-primary" data-method="zoomTo" data-option="1">
     <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoomTo(1)">
       100%
     </span>
   </button>
   <button type="button" class="btn btn-primary" data-method="rotateTo" data-option="180">
     <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotateTo(180)">
       180°
     </span>
   </button>
   </div>
      
   <div class="btn-group">
   <button type="button" class="  btn btn-danger" id="clear-crop" > close
   </button>
    
   <button type="button" class=" btn  btn-primary" id="ok-crop" > save
   </button>
    
   </div>
      
         
       <!-- <h3>Toggles:</h3> -->
       <div class="btn-group docs-aspect-ratios" data-toggle="buttons">
         <label class="btn btn-primary active">
           <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.7777777777777777">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9">
             16:9
           </span>
         </label>
         <label class="btn btn-primary">
           <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1.3333333333333333">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3">
             4:3
           </span>
         </label>
         <label class="btn btn-primary">
           <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="1">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1">
             1:1
           </span>
         </label>
         <label class="btn btn-primary">
           <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="0.6666666666666666">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3">
             2:3
           </span>
         </label>

         <label class="btn btn-warning">
           <input type="radio" class="sr-only" id="aspectRatio6" name="aspectRatio" value="0.76666666666666666">
           <span class="docs-tooltip"  id="initalclickme" data-toggle="tooltip" title="aspectRatio: 342 / 450">
             type 0 images
           </span>
         </label>

         <label class="btn btn-warning">
           <input type="radio" class="sr-only" id="aspectRatio6" name="aspectRatio" value="1.48888888888888888">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 498 / 335">
             type 1 images
           </span>
         </label>


         <label class="btn btn-warning">
           <input type="radio" class="sr-only" id="aspectRatio6" name="aspectRatio" value="2.06666666666666666">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 433 / 241">
             type 2 images
           </span>
         </label>

         <label class="btn btn-warning">
           <input type="radio" class="sr-only" id="aspectRatio6" name="aspectRatio" value="0.66666666666666666">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 375 / 567">
             type 3 images
           </span>
         </label>
         <label class="btn btn-warning">
           <input type="radio" class="sr-only" id="aspectRatio6" name="aspectRatio" value="3.777777777777777777">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 922 / 245">
             type 4 images
           </span>
         </label>

         <label class="btn btn-primary">
           <input type="radio" class="sr-only" id="aspectRatio5" name="aspectRatio" value="NaN">
           <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN">
             Free
           </span>
         </label>
       </div>

    </div> 
      
     </div><!-- /.docs-toggles -->
   </div>

 

 
  
                  

              </div>
              <div class="modal-footer"> 
                <button type="button"  id="ok-crop"   class="btn btn-danger" data-dismiss="modal">save</button>
              </div>
            </div>
          </div>
        </div>
        </div>


   </div> 





    <script type="text/javascript"   src="../assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- <script type="text/javascript" src="../assets/js/ui-bootstrap-tpls-2.5.0.min.js"></script> -->



    <script type="text/javascript" src="../assets/theme/a1/js/metisMenu.min.js" ></script>
    <script type="text/javascript" src="../assets/theme/a1/js/custom.js" ></script>

 

    <script type="text/javascript" src="../assets/lobibox/js/lobibox.js"></script>

    <script type="text/javascript" src="../assets/js/bootstrap-datepicker.min.js"></script>



    <script type="text/javascript" src="../assets/js/select2.full.min.js"></script>

    <script type="text/javascript" src="../assets/js/cropper.min.js"></script>

    <script type="text/javascript" src="../assets/js/ngprogress-lite.min.js"></script>

    <script type="text/javascript" src="../assets/theme/a1/js/image_crop.js" ></script>


    <script type="text/javascript" src="../assets/theme/a1/js/imageBigCrop.js" ></script>
      
    <script type="text/javascript">
         
         $(document).ready( function() {

              $('.datepicker').datepicker({
                  format: 'dd-mm-yyyy',
                  endDate: '-20y'
              });




         });
          


    </script>

    <script type="text/javascript"   src="js/app.js"></script>
 
</body>
</html>
