<?php 

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "animal_info_db";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    $search_this=$_GET['search'];
    if($search_this!=''){

        $get_all_info = $conn->query("SELECT * FROM `animals_info` WHERE (`cat_id` LIKE '%$search_this%' OR `ani_life_exp` LIKE '%$search_this%') ORDER BY `animal_details_cdate` AND `animal_name`");
        $data=$get_all_info->fetch_all(MYSQLI_ASSOC);
   
    }else{
        $get_all_info = $conn->query("SELECT * FROM `animals_info` ORDER BY `animal_details_cdate` AND `animal_name`");
         $data=$get_all_info->fetch_all(MYSQLI_ASSOC);
   
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
      width: 100%;
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
      width: 30%;
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
      max-width: 60%;
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
      width: 80%;
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
      padding: 115px 0;  }

      .form-submit {
      width: 10%;
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

      .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            border-top: 1px solid #f4f4f4;
            text-align: center;
            padding: 4px;
        }
        .table>thead>tr>th {
            border-bottom: 2px solid #f4f4f4;
        }
        .table tr td .progress {
            margin-top: 5px;

        }
       
        .table-responsive {
            overflow: auto;
        }
        .table-responsive>.table tr td, .table-responsive>.table tr th {
            white-space: normal!important;
        }
        thead tr th{    
            background-color: #c7804a !important;
            color: aliceblue !important;
            font-size: 17px !important;
        }
        table{
            width: 100%;
        }


    </style>
    <body>

        <div class="main">

            <section class="registration">
                <!-- <img src="./bg_image.jpg" alt=""> -->
                <div class="container">
                    <div class="registration-content">

                        <h2 class="form-title">All Animals Details</h2>

                        <form action="" method="GET">
                            <input type="text" class="form-input" name="search" id="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search'];}?>" placeholder="Search Here..." />
                            <input type="submit" class="form-submit" value="Search">
                            <span style="font-size: 15px;float: right;"><b>Total Visitors : <?php echo count($data); ?></b></span>
                        </form>

                         <!------------------- Table Data Show Start Here------------------------------->

                                <table class="table table-striped table-bordered table-hover dataTables-example table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Image</th>
                                            <th>Animal Name</th>
                                            <th>Animal Category</th>
                                            <th>Animal Desc.</th>
                                            <th>Animal Life Exp.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i=0; $i < count($data) ; $i++) {  ?>
                                        <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td style="width: 18%;"><img src="uploads/<?php echo $data[$i]['img_id'];?>"></td>
                                            <td style="width: 18%;"><?php echo $data[$i]['animal_name']; ?></td>
                                            <td style="width: 18%;">
                                                <?php 
                                                    $category=$data[$i]['cat_id'];
                                                    if($category){
                                                        echo $category;

                                                    }else{
                                                        echo "-";
                                                    }
                                                 ?>
                                            </td>
                                            <td style="width: 18%;"><?php echo $data[$i]['ani_desc']; ?></td>
                                            <td style="width: 18%;">                                                
                                                <?php 
                                                    $life_exp=$data[$i]['ani_life_exp'];
                                                    if($category){
                                                        echo $life_exp." Years";

                                                    }else{
                                                        echo "-";
                                                    }
                                                 ?>
                                            </td>
                                        </tr>

                                        <?php } 
                                            if(count($data)=='0'|| count($data)==''){ ?>
                                                <tr>
                                                    <td colspan="6"> No Records Found..</td>
                                                </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            

                        <!------------------- Table Data Show End Here------------------------------->                 
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