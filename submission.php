<?php 
 ini_set('mysqli.connect_timeout', 300);
 ini_set('default_socket_timeout', 300);

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "animal_info_db";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    extract($_POST);
    //print_r($_POST);
if (isset($_POST["animal_details_submit"]))
{
    if($captcha_sum!=$captcha)
    {
        echo "<pre style='color:red;font-size:30px;text-align:center'>Capcha is Incorrect !</pre>";
    }else{

        if($_FILES['img_id']['name']=='' || $_POST["animal_name"]=='' || $_POST["cat_id"]=='' || $_POST["ani_desc"]=='' || $_POST["ani_life_exp"]=='')
            {
                echo "<pre style='color:red;font-size:30px;text-align:center'>Please Fill All Details".$_FILES['img_id']['name']." !</pre>";

            }else{
                if (isset($_FILES['img_id'])){
                // echo "<pre>";
                // print_r($_FILES['img_id']);
                // echo "</pre>";
                $image_name= $_FILES['img_id']['name'];
                $image_size= $_FILES['img_id']['size'];
                $image_tmp_name= $_FILES['img_id']['tmp_name'];
                $error= $_FILES['img_id']['error'];
                if($error === 0){
                    $img_ex=pathinfo($image_name,PATHINFO_EXTENSION); //get image path
                    $img_ex_lc= strtolower($img_ex);
                    $new_img =uniqid("IMG-",true).'.'.$img_ex_lc;
                    $img_path = 'uploads/'.$new_img;                 
                    move_uploaded_file($image_tmp_name,$img_path);    //add image into folder

                    // Now Add Image Into Database

                    $insert_info = $conn->query("INSERT INTO `animals_info`(`animal_name`, `img_id`, `img_name`, `cat_id`, `ani_desc`, `ani_life_exp`) VALUES ('$animal_name', '$new_img', '$image_name', '$cat_id', '$ani_desc', '$ani_life_exp')");
                    header("location:animals.php?search=");

                }else{
                    echo "Something Went Wrong";
                    header("location:submission.php");
                }
            }
            }

        
    }
}
  

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
       
        <!-- Main css -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <style type="text/css">
        
    .form-group {
      overflow: hidden;
      margin-bottom: 20px; }

      .container {
      width: 660px;
      position: relative;
      margin: 0 auto; }

      .registration-content {
      background: #fff;
      opacity: 0.9;
      border-radius: 10px;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
      -o-border-radius: 10px;
      -ms-border-radius: 10px;
      padding: 50px 85px; }

      .form-input {
      width: 100%;
      border: 1px solid #ebebeb;
      border-radius: 5px;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      -o-border-radius: 5px;
      -ms-border-radius: 5px;
      padding: 17px 20px;
      box-sizing: border-box;
      font-size: 14px;
      font-weight: 500;
      color: #222; }

      .form-input::-webkit-input-placeholder {
        color: #999; }
      .form-input::-moz-placeholder {
        color: #999; }
      .form-input:-ms-input-placeholder {
        color: #999; }
      .form-input:-moz-placeholder {
        color: #999; }
      .form-input::-webkit-input-placeholder {
        font-weight: 500; }
      .form-input::-moz-placeholder {
        font-weight: 500; }
      .form-input:-ms-input-placeholder {
        font-weight: 500; }
      .form-input:-moz-placeholder {
        font-weight: 500; }

        input, select, textarea {
      outline: none;
      appearance: unset !important;
      -moz-appearance: unset !important;
      -webkit-appearance: unset !important;
      -o-appearance: unset !important;
      -ms-appearance: unset !important; }

        img {
      max-width: 100%;
      height: auto; }

      .registration-content {
      background: #fff;
      border-radius: 10px;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
      -o-border-radius: 10px;
      -ms-border-radius: 10px;
      padding: 50px 85px; }

      .container {
      width: 660px;
      position: relative;
      margin: 0 auto; }

      body {
      font-size: 14px;
      line-height: 1.8;
      color: #222;
      font-weight: 400;
      font-family: 'Montserrat';
      background-image: url("./bg_image.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      -moz-background-size: cover;
      -webkit-background-size: cover;
      -o-background-size: cover;
      -ms-background-size: cover;
      background-position: center center;
      padding: 115px 0; }

      .form-submit {
      width: 100%;
      border-radius: 5px;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      -o-border-radius: 5px;
      -ms-border-radius: 5px;
      padding: 17px 20px;
      box-sizing: border-box;
      font-size: 14px;
      font-weight: 700;
      color: #fff;
      text-transform: uppercase;
      border: none;
      background-image: -moz-linear-gradient(to left, #ebdc74, #e15817);
      background-image: -ms-linear-gradient(to left, #ebdc74, #e15817);
      background-image: -o-linear-gradient(to left, #ebdc74, #e15817);
      background-image: -webkit-linear-gradient(to left, #ebdc74, #e15817);
      background-image: linear-gradient(to left, #ebdc74, #e15817); }

    h2 {
      line-height: 1.66;
      margin: 0;
      padding: 0;
      font-weight: 900;
      color: #222;
      font-family: 'Montserrat';
      font-size: 24px;
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 40px; }


    </style>
    <body>

        <div class="main">

            <section class="registration">
                <!-- <img src="./bg_image.jpg" alt=""> -->
                <div class="container">
                    <div class="registration-content">

                        <!------------------- Registration Form Start Here------------------------------->

                            <form method="POST" id="registration-form" class="registration-form" enctype="multipart/form-data">
                                <h2 class="form-title">Add Details</h2>
                                <div class="form-group">
                                    <input type="text" class="form-input" name="animal_name" id="animal_name" placeholder="Name of Animal" value="<?php if(isset($_POST['animal_name'])){ echo $_POST['animal_name'];}?>" />
                                </div>
                                <div class="form-group">
                                    <select class="form-input" id="cat_id" name="cat_id">
                                        <option value="">All Category </option>

                                         <?php $posted_categry=($_POST['cat_id']); ?>

                                        <option value="Herbivores" <?php if($posted_categry=='Herbivores'){?> selected <?php }?>>Herbivores</option>


                                         <option value="Omnivores"<?php if($posted_categry=='Omnivores'){?> selected <?php }?>>Omnivores</option>
                                        
                                        <option value="Carnivores"<?php if($posted_categry=='Carnivores'){?> selected <?php }?>>Carnivores</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-input" name="img_id" accept=".jpg, .jpeg, .png" id="image" value="<?php echo $_POST['img_id']; ?>" />
                                </div>
                               
                                <div class="form-group">
                                    <textarea class="form-input" name="ani_desc" id="ani_desc" placeholder="Enter Description"><?php if(isset($_POST['ani_desc'])){ echo $_POST['ani_desc'];}?></textarea>
                                </div>
                                <div class="form-group">
                                    <select class="form-input" id="ani_life_exp" name="ani_life_exp">
                                        <option value="">Life expectancy</option>

                                        <?php $posted_life_exp=($_POST['ani_life_exp']); ?>

                                        <option value="0-1"  <?php if($posted_life_exp=='0-1'){?> selected <?php }?>>0-1 Year</option>
                                        <option value="1-5" <?php if($posted_life_exp=='1-5'){?> selected <?php }?>>1-5 Year</option>
                                        <option value="5-10" <?php if($posted_life_exp=='5-10'){?> selected <?php }?>>5-10 Year</option>
                                        <option value="10+"<?php if($posted_life_exp=='10+'){?> selected <?php }?>>10+ Year</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                	<?php 
	                                	$fist_no=rand(1,20);
	                                	$sec_no=rand(1,20);

	                                	?>
                                    Fill Capcha : <b><?php echo " ( ".$fist_no." + ".$sec_no." ) "; ?> </b>

                                    <input type="hidden" class="form-input" name="captcha_sum" id="captcha_sum" value="<?php echo $fist_no+$sec_no; ?>" />

                                    <input type="text" class="form-input" name="captcha" id="captcha"/>

                                </div>
                                <div class="form-group">
                                <input type="submit" name="animal_details_submit" id="animal_details_submit" class="form-submit" value="Sign up" />
                            </div>
                               
                            </form>  

                        <!------------------- Registration Form End Here------------------------------->                 
                    </div>
                </div>
            </section>

        </div>

        <!-- JS -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="js/main.js"></script>
        <script type="text/javascript">
        	function verify_capcha(){
        		var no_sum=document.getElementById("captcha_sum").value();
        		var entered_sum=document.getElementById("captcha").value();
        		if(no_sum!=entered_sum){
        			alert("Incorrect Captcha");
        			document.getElementById("animal_details_submit").disabled="true";
        		}else{
        			document.getElementById("animal_details_submit").disabled="false";
        		}
        	}
        </script>
    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
    </html>

<?php ?>