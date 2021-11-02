<?php
    class Include2 extends MY_Controller
    {
      function __construct()
    	{
    		parent::__construct();
        $this->load->model("universal_model");
    	}

      function ajaxsuggest()
      {
        include "db.php";

        if($_SESSION['token']==$_POST['tkn'])
        {
        if(isset($_POST['eid']))
        {

                $message = '';

                if(isset($_POST["email"]))
        		{
        		    if(empty($_POST["email"]))
        		    {/*$error = 1; $message="Email daxil etmədiniz";*/ $email='';}
        		    else
        		    {
                        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                        {$error = 1; $message="Yanlış email formatı!";}
                        else
                        {$email = trim($_POST["email"]); $email = strip_tags($email);}
        		    }
        		}

        		if(isset($_POST["mobile"]))
        		{
        		     function validate_phone_number($phone)
                    {
                        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
                        $phone_to_check = str_replace("-", "", $filtered_phone_number);
                        if(strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14)
                        {return false;}
                        else
                        {return true;}
                    }

                    if(empty($_POST["mobile"]))
        		    {$error = 1; $message="Nömrə daxil etmədiniz";}
        		    else
        		    {
        	            if(validate_phone_number($_POST["mobile"]) == true)
        		        {$mobile = trim($_POST["mobile"]); $mobile = strip_tags($mobile);}
        		        else
        		        {$error=1; $message="Yanlış mobil nömrə formatı!";}
        		    }

        		}




        		if(isset($_POST["firstname"]))
        		{
        		    if(empty($_POST["firstname"]))
        		    {$error = 1; $message="Ad daxil etmədiniz";}
        		    else
        		    {
        		        $firstname = $_POST["firstname"];
                        if (!preg_match("/^[a-zA-Z ]*$/",$firstname) or strlen($firstname)<3)
                        {$error = 1; $message="Ad minimum 3 hərfdən ibarət olmalıdır. Adın tərkibində rəqəm və ya simvol iştirak etməməlidir!";}
                        else
                        {$firstname = trim($firstname); $firstname = strip_tags($firstname);}
        		    }
        		}


        		if(isset($_POST["text"]))
        		{
        		    if(empty($_POST["text"]))
        		    {$error = 1; $message="Məzmun daxil etmədiniz";}
        		    else
        		    {
        		        $text = $_POST["text"];
                        if (strlen($text)<20)
                        {$error = 1; $message="Məzmun minimum 20 simvoldan ibarət olmalıdır.";}
                        else
                        {$text = trim($text); $text = strip_tags($text);}
        		    }
        		}



        if(!empty($_FILES["files"]["name"][0]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][0]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file1 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][0]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][0] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][0], $target_file1))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file1="";}



        if(!empty($_FILES["files"]["name"][1]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][1]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file2 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][1]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][1] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][1], $target_file2))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file2="";}




        if(!empty($_FILES["files"]["name"][2]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][2]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file3 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][2]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][2] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][2], $target_file3))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file3="";}


        if(!empty($_FILES["files"]["name"][3]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][3]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file4 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file4,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][3]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][3] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][3], $target_file1))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file4="";}





        if(!empty($_FILES["files"]["name"][4]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][4]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file5 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file5,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][4]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][4] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][4], $target_file5))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file5="";}





        if(!empty($_FILES["files"]["name"][5]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][5]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file6 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file6,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][5]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][5] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][5], $target_file1))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file6="";}

        if(empty($target_file1) && empty($target_file2) && empty($target_file3) && empty($target_file4) && empty($target_file5) && empty($target_file6))
        {$error=1; $message="Təklif üçün ən azından bir şəkil yükləməlisiniz.";}

        		if(!isset($error))
        		{

        $bsec=mysqli_query($con,"SELECT a.id, a.token, a.title, b.target FROM elanlar a, elanimages b
        WHERE a.token=b.token AND a.id='".$_POST['aid']."' GROUP BY b.token");
        $binfo=mysqli_fetch_array($bsec);
        $bsec1=mysqli_query($con,"SELECT a.id, a.token, a.title, b.target FROM elanlar a, elanimages b
        WHERE a.token=b.token AND a.id='".$_POST['selected']."' GROUP BY b.token");
        $binfo1=mysqli_fetch_array($bsec1);
        $u=mysqli_query($con,"SELECT first_name AS ad, last_name AS soyad FROM user WHERE id='".$_POST['qid']."'");
        $uinfo=mysqli_fetch_array($u);

        $stitle=stripslashes($binfo['title']);
        if(preg_match( '/[\p{Cyrillic}]/u', $stitle))
        {
                $cyr  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у',
                    'ф','х','ц','ч','ш','щ','ъ', 'ы','ь', 'э', 'ю','я',
                    'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
                    'Ф','Х','Ц','Ч','Ш','Щ','Ъ', 'Ы','Ь', 'Э', 'Ю','Я' );
                $lat = array( 'a','b','v','g','d','e','e','zh','z','i','y','k','l','m','n','o','p','r','s','t','u',
                    'f' ,'h' ,'ts' ,'ch','sh' ,'sht' ,'i', 'y', 'y', 'e' ,'yu' ,'ya','A','B','V','G','D','E','E','Zh',
                    'Z','I','Y','K','L','M','N','O','P','R','S','T','U',
                    'F' ,'H' ,'Ts' ,'Ch','Sh' ,'Sht' ,'I' ,'Y' ,'Y', 'E', 'Yu' ,'Ya' );

                    $stitle = str_replace($cyr, $lat, $stitle);

        }


        $stitle=htmlspecialchars($stitle);
        $stitle=strtolower($stitle);
        $slug=str_replace('quot;','',$stitle);
        $slug=str_replace('"','',$slug);
        $slug=str_replace('(','',$slug);
        $slug=str_replace(')','',$slug);
        $slug=str_replace('+','',$slug);
        $slug=str_replace('-','',$slug);
        $slug=str_replace("'","",$slug);
        $slug=str_replace(';','',$slug);
        $slug=str_replace(':','',$slug);
        $slug=str_replace(',','',$slug);
        $slug=str_replace('.','',$slug);
        $slug=str_replace(' ','-',$slug);
        $slug=str_replace('ə','e',$slug);
        $slug=str_replace('Ə','e',$slug);
        $slug=str_replace('ü','u',$slug);
        $slug=str_replace('Ü','u',$slug);
        $slug=str_replace('ı','i',$slug);
        $slug=str_replace('İ','i',$slug);
        $slug=str_replace('ö','o',$slug);
        $slug=str_replace('Ö','o',$slug);
        $slug=str_replace('ğ','q',$slug);
        $slug=str_replace('ç','c',$slug);
        $slug=str_replace('Ç','c',$slug);
        $slug=str_replace('ş','s',$slug);
        $slug=str_replace('Ş','s',$slug);
        $slug=str_replace('&','',$slug);
        $url=$slug."/".$binfo['id'];





                                            $toBartiChat='<div class="barter3-receive">
                                            <div class="message-receive d-flex">
                                                <div class="profile-image">
                                                    <img src="Images/user photo.svg">
                                                </div>
                                                <p class="message-text">
                                                    '.$firstname.' sizin <a href="https://new.otomoto.az/elan/'.$url.'">'.$binfo['title'].'</a> elanınıza barter təklif etdi.
                                                </p>
                                            </div>
                                            <div class="barter-message bm'.time().'">';

        $toBartiChat.="
        <script>
        $('.bm".time()."').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href=\"%url%\">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                    }
                }
            });
        </script>";

                                                 if(!empty($target_file1))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file1.'" title="">
                                                    <img src="'.$target_file1.'" alt="">
                                                </a>';}
                                             if(!empty($target_file2))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file2.'" title="">
                                                    <img src="'.$target_file2.'" alt="">
                                                </a>';}
                                             if(!empty($target_file3))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file3.'" title="">
                                                    <img src="'.$target_file3.'" alt="">
                                                </a>';}
                                             if(!empty($target_file4))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file4.'" title="">
                                                    <img src="'.$target_file4.'" alt="">
                                                </a>';}
                                             if(!empty($target_file5))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file5.'" title="">
                                                    <img src="'.$target_file5.'" alt="">
                                                </a>';}
                                             if(!empty($target_file6))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file6.'" title="">
                                                    <img src="'.$target_file6.'" alt="">
                                                </a>';}

                                                $toBartiChat.='</div>
                                            </div>
                                            <div class="message-receive ml-auto d-flex">
                                                <div class="profile-image">
                                                    <img src="Images/user photo.svg">
                                                </div>
                                                <p class="message-text">
                                                    <span>
                                                        <b>Ad: </b>
                                                    </span>
                                                    <span>'.$firstname.'</span>
                                                    <br>
                                                    <span>
                                                        <b>Telefon: </b>
                                                    </span>
                                                    <span>'.$mobile.'</span>
                                                    <br>
                                                    <span>
                                                        <b>Email: </b>
                                                    </span>
                                                    <span>'.$email.'</span>
                                                    <br>
                                                    <span>
                                                        <b>Mezmun: </b>
                                                    </span>
                                                    <span>'.$firstname.'</span>
                                                    <span class="message-date">1:47 PM</span>
                                                </p>
                                            </div>
                                        </div>';


                                        $toBartiChat=str_replace(array('\r', '\n'), '', $toBartiChat);





        		    $insertQuery = "INSERT INTO bartichat(gid,qid,msg,teklif)
        		    VALUES ('12', '".$_POST['uid']."', '".mysqli_real_escape_string($con,$toBartiChat)."', '".$_POST['aid']."')";
        			$userSaved = mysqli_query($con, $insertQuery);
        			if($userSaved==true)
        			{$success = 'Barter təklifiniz uğurla göndərildi.';}
        			else
        			{$message = "Barter üçün təklifi göndərmək mümkün olmadı! Lütfən, təkrar cəhd edin.";}

        		}
        }






























        if(isset($_POST['qid']))
        {

                $message = '';

               //print_r($_FILES["files"]);

        		if(isset($_POST["text"]))
        		{
        		    if(empty($_POST["text"]))
        		    {/*$error = 1; $message="Məzmun daxil etmədiniz";*/}

        		    if(!empty($_POST["text"]))
        		    {
        		        $text = $_POST["text"];
                        if (strlen($text)<20)
                        {$error = 1; $message="Məzmun minimum 20 simvoldan ibarət olmalıdır.";}
                        else
                        {$text = trim($text); $text = strip_tags($text);}
        		    }
        		}



        if(!empty($_FILES["files"]["name"][0]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][0]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file1 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][0]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][0] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][0], $target_file1))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file1="";}



        if(!empty($_FILES["files"]["name"][1]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][1]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file2 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][1]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][1] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][1], $target_file2))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file2="";}




        if(!empty($_FILES["files"]["name"][2]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][2]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file3 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][2]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][2] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][2], $target_file3))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file3="";}


        if(!empty($_FILES["files"]["name"][3]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][3]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file4 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file4,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][3]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][3] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][3], $target_file4))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file4="";}





        if(!empty($_FILES["files"]["name"][4]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][4]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file5 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file5,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][4]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][4] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][4], $target_file5))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file5="";}





        if(!empty($_FILES["files"]["name"][5]))
        {
        	$target_dir = "suggestions/";
            $temp = explode(".", $_FILES["files"]["name"][5]);
        	$newfilename = md5(microtime(true)) . '.' . end($temp);
            $target_file6 = $target_dir . $newfilename;
            $imageFileType = strtolower(pathinfo($target_file6,PATHINFO_EXTENSION));



            if(isset($_POST["submit"]))
            {$check = getimagesize($_FILES["files"]["tmp_name"][5]);}

            if($check === false)
            {$error = 1; $message="Yüklədiyiniz fayl şəkil deyildir";}

            if($_FILES["files"]["size"][5] > 5000000)
            {$error = 1; $message="Yüklədiyiniz faylın həcmi çox böyükdür.";}

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
            {$error = 1; $message="Yalnız JPG, JPEG, PNG & GIF fayl tiplərinə icazə verilir.";}

            if(!isset($error))
            {
                if(move_uploaded_file($_FILES["files"]["tmp_name"][5], $target_file6))
                {$upoadok= 1;}
                else
                {$error = 1; $message="Faylı yükləmək mümkün olmadı.";}
            }
        }
        else
        {$target_file6="";}

        if(empty($_POST['selected']) && empty($target_file1) && empty($target_file2) && empty($target_file3) && empty($target_file4) && empty($target_file5) && empty($target_file6))
        {$error=1; $message="Təklif üçün ən azından bir şəkil yükləməlisiniz.";}

        		if(!isset($error))
        		{


        		    if(isset($_POST['selected']) && empty($target_file1))
        		    {


        $bsec=mysqli_query($con,"SELECT a.id, a.token, a.title, b.target FROM elanlar a, elanimages b
        WHERE a.token=b.token AND a.id='".$_POST['aid']."' GROUP BY b.token");
        $binfo=mysqli_fetch_array($bsec);
        $bsec1=mysqli_query($con,"SELECT a.id, a.token, a.title, b.target FROM elanlar a, elanimages b
        WHERE a.token=b.token AND a.id='".$_POST['selected']."' GROUP BY b.token");
        $binfo1=mysqli_fetch_array($bsec1);
        $u=mysqli_query($con,"SELECT first_name AS ad, last_name AS soyad FROM user WHERE id='".$_POST['qid']."'");
        $uinfo=mysqli_fetch_array($u);

        $stitle=stripslashes($binfo['title']);
        if(preg_match( '/[\p{Cyrillic}]/u', $stitle))
        {
                $cyr  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у',
                    'ф','х','ц','ч','ш','щ','ъ', 'ы','ь', 'э', 'ю','я',
                    'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
                    'Ф','Х','Ц','Ч','Ш','Щ','Ъ', 'Ы','Ь', 'Э', 'Ю','Я' );
                $lat = array( 'a','b','v','g','d','e','e','zh','z','i','y','k','l','m','n','o','p','r','s','t','u',
                    'f' ,'h' ,'ts' ,'ch','sh' ,'sht' ,'i', 'y', 'y', 'e' ,'yu' ,'ya','A','B','V','G','D','E','E','Zh',
                    'Z','I','Y','K','L','M','N','O','P','R','S','T','U',
                    'F' ,'H' ,'Ts' ,'Ch','Sh' ,'Sht' ,'I' ,'Y' ,'Y', 'E', 'Yu' ,'Ya' );

                    $stitle = str_replace($cyr, $lat, $stitle);

        }


        $stitle=htmlspecialchars($stitle);
        $stitle=strtolower($stitle);
        $slug=str_replace('quot;','',$stitle);
        $slug=str_replace('"','',$slug);
        $slug=str_replace('(','',$slug);
        $slug=str_replace(')','',$slug);
        $slug=str_replace('+','',$slug);
        $slug=str_replace('-','',$slug);
        $slug=str_replace("'","",$slug);
        $slug=str_replace(';','',$slug);
        $slug=str_replace(':','',$slug);
        $slug=str_replace(',','',$slug);
        $slug=str_replace('.','',$slug);
        $slug=str_replace(' ','-',$slug);
        $slug=str_replace('ə','e',$slug);
        $slug=str_replace('Ə','e',$slug);
        $slug=str_replace('ü','u',$slug);
        $slug=str_replace('Ü','u',$slug);
        $slug=str_replace('ı','i',$slug);
        $slug=str_replace('İ','i',$slug);
        $slug=str_replace('ö','o',$slug);
        $slug=str_replace('Ö','o',$slug);
        $slug=str_replace('ğ','q',$slug);
        $slug=str_replace('ç','c',$slug);
        $slug=str_replace('Ç','c',$slug);
        $slug=str_replace('ş','s',$slug);
        $slug=str_replace('Ş','s',$slug);
        $slug=str_replace('&','',$slug);
        $url1=$slug."/".$binfo['id'];

        $stitle=stripslashes($binfo1['title']);
        if(preg_match( '/[\p{Cyrillic}]/u', $stitle))
        {
                $cyr  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у',
                    'ф','х','ц','ч','ш','щ','ъ', 'ы','ь', 'э', 'ю','я',
                    'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
                    'Ф','Х','Ц','Ч','Ш','Щ','Ъ', 'Ы','Ь', 'Э', 'Ю','Я' );
                $lat = array( 'a','b','v','g','d','e','e','zh','z','i','y','k','l','m','n','o','p','r','s','t','u',
                    'f' ,'h' ,'ts' ,'ch','sh' ,'sht' ,'i', 'y', 'y', 'e' ,'yu' ,'ya','A','B','V','G','D','E','E','Zh',
                    'Z','I','Y','K','L','M','N','O','P','R','S','T','U',
                    'F' ,'H' ,'Ts' ,'Ch','Sh' ,'Sht' ,'I' ,'Y' ,'Y', 'E', 'Yu' ,'Ya' );

                    $stitle = str_replace($cyr, $lat, $stitle);

        }


        $stitle=htmlspecialchars($stitle);
        $stitle=strtolower($stitle);
        $slug=str_replace('quot;','',$stitle);
        $slug=str_replace('"','',$slug);
        $slug=str_replace('(','',$slug);
        $slug=str_replace(')','',$slug);
        $slug=str_replace('+','',$slug);
        $slug=str_replace('-','',$slug);
        $slug=str_replace("'","",$slug);
        $slug=str_replace(';','',$slug);
        $slug=str_replace(':','',$slug);
        $slug=str_replace(',','',$slug);
        $slug=str_replace('.','',$slug);
        $slug=str_replace(' ','-',$slug);
        $slug=str_replace('ə','e',$slug);
        $slug=str_replace('Ə','e',$slug);
        $slug=str_replace('ü','u',$slug);
        $slug=str_replace('Ü','u',$slug);
        $slug=str_replace('ı','i',$slug);
        $slug=str_replace('İ','i',$slug);
        $slug=str_replace('ö','o',$slug);
        $slug=str_replace('Ö','o',$slug);
        $slug=str_replace('ğ','q',$slug);
        $slug=str_replace('ç','c',$slug);
        $slug=str_replace('Ç','c',$slug);
        $slug=str_replace('ş','s',$slug);
        $slug=str_replace('Ş','s',$slug);
        $slug=str_replace('&','',$slug);
        $url2=$slug."/".$binfo1['id'];


        		                            $toBartiChat='   <div class="barter1-send">
                                            <div class="message-send ml-auto d-flex">
                                                <p>
                                                    Siz <a href="https://new.otomoto.az/userads.php?user_id='.$_POST['qid'].'" target="_blank">'.$uinfo['ad'].' '.$uinfo['soyad'].'</a> adlı istifadəçiyə barter təklif etdiniz.
                                                </p>
                                            </div>
                                            <div class="barter-message">
                                                <div class="image-barter">
                                                    <a href="https://new.otomoto.az/elan/'.$url1.'" target="_blank"><img src="https://new.otomoto.az/barthaus/users/admin/elan/uploadengine/'.$binfo['target'].'" alt=""></a>
                                                </div>
                                                <div class="barter-icon">
                                                    <img src="Images/change.svg" alt="">
                                                </div>
                                                <div class="image-barter">
                                                    <a href="https://new.otomoto.az/elan/'.$url2.'" target="_blank"><img src="https://new.otomoto.az/barthaus/users/admin/elan/uploadengine/'.$binfo1['target'].'" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="message-send ml-auto d-flex">
                                                <p>'.$text.'</p>
                                                <span class="message-date">1:47 PM</span>
                                            </div>
                                        </div>
                                        myteklif
                                        <div class="barter1-receive">
                                            <div class="message-receive d-flex">
                                                <div class="profile-image">
                                                    <img src="Images/user photo.svg">
                                                </div>
                                                <p class="message-text">
                                                    <a href="https://new.otomoto.az/userads.php?user_id='.$_SESSION['uid'].'">'.$_SESSION['ad'].' '.$_SESSION['soyad'].'</a> sizə barter təklif edir.
                                                </p>
                                            </div>
                                            <div class="barter-message">
                                                 <div class="image-barter">
                                                    <a href="https://new.otomoto.az/userads.php?user_id='.$_SESSION['uid'].'" target="_blank"><img src="https://new.otomoto.az/barthaus/users/admin/elan/uploadengine/'.$binfo['target'].'" alt=""></a>
                                                </div>
                                                <div class="barter-icon">
                                                    <img src="Images/change.svg" alt="">
                                                </div>
                                                <div class="image-barter">
                                                    <a href="https://new.otomoto.az/userads.php?user_id='.$_SESSION['uid'].'" target="_blank"><img src="https://new.otomoto.az/barthaus/users/admin/elan/uploadengine/'.$binfo1['target'].'" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="message-receive d-flex">
                                                <div class="profile-image">
                                                    <img src="Images/user photo.svg">
                                                </div>
                                                <p class="message-text">'.$text.'<span class="message-date">1:47 PM</span></p>
                                            </div>
                                        </div>';
        		    }


                    if(!empty($target_file1))
        		    {
        		                          $toBartiChat='<div class="barter2-send">
                                            <div class="message-send ml-auto d-flex">
                                                <p>
                                                    Siz <a href="https://new.otomoto.az/userads.php?user_id='.$_POST['qid'].'">'.$_POST['ad'].' '.$_POST['soyad'].'</a> adlı istifadəçiyə Barter təklif etdiniz.
                                                </p>
                                            </div>
                                            <div class="barter-message bs'.time().'">';

        $toBartiChat.="
        <script>
        $('.bs".time()."').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href=\"%url%\">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                    }
                }
            });
        </script>";

                                             if(!empty($target_file1))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file1.'" title="">
                                                    <img src="'.$target_file1.'" alt="">
                                                </a>';}
                                             if(!empty($target_file2))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file2.'" title="">
                                                    <img src="'.$target_file2.'" alt="">
                                                </a>';}
                                             if(!empty($target_file3))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file3.'" title="">
                                                    <img src="'.$target_file3.'" alt="">
                                                </a>';}
                                             if(!empty($target_file4))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file4.'" title="">
                                                    <img src="'.$target_file4.'" alt="">
                                                </a>';}
                                             if(!empty($target_file5))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file5.'" title="">
                                                    <img src="'.$target_file5.'" alt="">
                                                </a>';}
                                             if(!empty($target_file6))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file6.'" title="">
                                                    <img src="'.$target_file6.'" alt="">
                                                </a>';}

                                            $toBartiChat.='</div>
                                            <div class="message-send ml-auto d-flex">
                                                <p>'.$text.'</p>
                                                <span class="message-date">1:47 PM</span>
                                            </div>
                                        </div>
                                        myteklif
                                        <div class="barter2-receive">
                                            <div class="message-receive d-flex">
                                                <div class="profile-image">
                                                    <img src="Images/user photo.svg">
                                                </div>
                                                <p class="message-text">
                                                   <a href="https://new.otomoto.az/userads.php?user_id='.$_SESSION['uid'].'">'.$_SESSION['ad'].' '.$_SESSION['soyad'].'</a> sizə barter təklif edir.
                                                </p>
                                            </div>
                                            <div class="barter-message bm'.time().'">';


        $toBartiChat.="
        <script>
        $('.bm".time()."').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href=\"%url%\">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                    }
                }
            });
        </script>";

                                                if(!empty($target_file1))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file1.'" title="">
                                                    <img src="'.$target_file1.'" alt="">
                                                </a>';}
                                             if(!empty($target_file2))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file2.'" title="">
                                                    <img src="'.$target_file2.'" alt="">
                                                </a>';}
                                             if(!empty($target_file3))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file3.'" title="">
                                                    <img src="'.$target_file3.'" alt="">
                                                </a>';}
                                             if(!empty($target_file4))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file4.'" title="">
                                                    <img src="'.$target_file4.'" alt="">
                                                </a>';}
                                             if(!empty($target_file5))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file5.'" title="">
                                                    <img src="'.$target_file5.'" alt="">
                                                </a>';}
                                             if(!empty($target_file6))
                                                {$toBartiChat.='<a class="image-barter" href="'.$target_file6.'" title="">
                                                    <img src="'.$target_file6.'" alt="">
                                                </a>';}

                                            $toBartiChat.='</div>
                                            <div class="message-receive d-flex">
                                                <div class="profile-image">
                                                    <img src="Images/user photo.svg">
                                                </div>
                                                <p class="message-text">'.$text.'<span class="message-date">1:47 PM</span></p>
                                            </div>
                                        </div>
                                        ';
        		    }





        		    $insertQuery = "INSERT INTO bartichat(gid,qid,msg,teklif)
        		    VALUES ('".$_SESSION['uid']."', '".$_POST['qid']."', '".mysqli_real_escape_string($con,$toBartiChat)."', '".$_POST['aid']."')";
        			$userSaved = mysqli_query($con, $insertQuery);
        			if($userSaved==true)
        			{$success = 'Barter təklifiniz uğurla göndərildi.';}
        			else
        			{$message = "Barter üçün təklifi göndərmək mümkün olmadı! Lütfən, təkrar cəhd edin.";}

        		}
        }
        }
        echo $message;
      }

      function payment()
      {
          if($_SERVER["REQUEST_METHOD"] == "POST"){
              $data = [
                  'secret' => '0fe951519324426',
                  'productPrice' => $_POST['amount'],
                  'productName' => 'Payment',
                  'firstName' => $_POST['fname'],
                  'lastName' => $_POST['lname'],
                  'email' => $_POST['email'],
                  'currency' => 'AZN',
              ];
              $ch = curl_init('https://azweb.paym.es/api/authorize');
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
              curl_setopt($ch, CURLOPT_SSLVERSION, 6);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
              $result = curl_exec ($ch);
              curl_close ($ch);
              $json = json_decode($result);
              $_SESSION["paymentAmount"] = $_POST['amount'];
              $_SESSION["paymentpid"] = $_POST['pid'];
              $_SESSION["paymentType"] = $_POST['type'];

      	    header('Location: '.$json->url);
          }
      }

    }
