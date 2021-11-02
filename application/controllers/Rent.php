<?php
    class Rent extends MY_Controller
    {
      public $webp;

      function __construct()
    	{
    		parent::__construct();
    		$this->load->model("rent_model");
        $this->load->model("universal_model");
        $this->webp = (preg_match("/image\/webp/i", $_SERVER['HTTP_ACCEPT']) == 1 || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/'))?1:0;
    	}

      function add_rent_car()
      {
        if (!$this->check_author()) {
          redirect('/rent/not_logged');
        }

        $authorid = $this->session->userdata('uid');
        $data['title'] = 'dashboard';

        $autosalon = $this->universal_model->get_more_item_select_row('user', 'autosalon', 'id = '.$authorid);

        if (@$autosalon->autosalon) {
          $currentBalans = $this->rent_model->currentBalans($authorid);
          $plus = $currentBalans->plus;
          $minus = $currentBalans->minus;
          $ads = $currentBalans->ads;

          $checkMonth = $this->rent_model->checkMonth($authorid);
            if (($plus - ($minus + $ads)) > 0) {
              $this->load->model('PagesModel');
              $this->load->model('dashboard_model');
              $data['popular_mark'] = $this->PagesModel->get_marks(' and popular = 1');
              $data['mark'] = $this->PagesModel->get_marks('');
              $data['carmodel'] = $this->dashboard_model->getCarModel();
              $data['carbody']  =  $this->dashboard_model->getCarBody();
              $data['carcolor']  =  $this->dashboard_model->getCarColor();
              $data['carcities']  =  $this->dashboard_model->getCarCities();
              $data['pincode'] = $this->generate_pin();
              $data['classes'] = $this->universal_model->get_more_item_select('rent_class', 'id, class', 'active = 1');

              $this->load->view('/site/tez_header', $data);
              $this->load->view('/rent/add_rent_car');
              $this->load->view('/Dashboard/footer');
            } else {
              $this->load->view('/site/tez_header', $data);
              $this->load->view('/rent/disallow');
              $this->load->view('/Dashboard/footer');
            }
        } else {
          $this->load->view('/site/tez_header', $data);
          $this->load->view('/rent/disallow');
          $this->load->view('/Dashboard/footer');
        }
      }

      function add_new_rent_car()
      {
        if ($this->input->post())
        {
          $authorid = @$this->session->userdata('uid');
          $filtered_post = $this->filter_data($this->input->post());

          if ($authorid)
          {
            $vars = array(
              'status' => 0,
              'reject_reason' => '',
              'car_status' => 0,
              'authorid' => $authorid,
              'class' => (int) $filtered_post['class'],
              'mark' => (int) $filtered_post['mark'],
              'model' => (int) $filtered_post['model'],
              'year' => (int) $filtered_post['year'],
              'city' => (int) $filtered_post['city'],
              'body' => (int) $filtered_post['body'],
              'fuel' => $filtered_post['fuel'],
              'transmission' => $filtered_post['transmission'],
              'color' => (int) $filtered_post['color'],
              'wheels' => (int) $filtered_post['wheels'],
              'leather' => (int) $filtered_post['leatherSalon'],
              'parkingsensor' => (int) $filtered_post['parkingSensor'],
              'sunproof' => (int) $filtered_post['sunproof'],
              'camera' => (int) $filtered_post['camera'],
              'heatedseats' => (int) $filtered_post['heatedseats'],
              'centrallocking' => (int) $filtered_post['centrallocking'],
              'abs' => (int) $filtered_post['abs'],
              'xenon' => (int) $filtered_post['xenon'],
              'aircondition' => (int) $filtered_post['aircondition'],
              'rainsensor' => (int) $filtered_post['sensor'],
              'sidecurtains' => (int) $filtered_post['sidecurtains'],
              'seatventilation' => (int) $filtered_post['seatventilation'],
              'esp' => (int) $filtered_post['esp'],
              'additionalinfo' => $filtered_post['additionalInfo'],
              'price' => (float) $filtered_post['price'],
              'currency' => (int) $filtered_post['currency'],
              'included_km' => (int) $filtered_post['included_km'],
              'surcharge' => (int) $filtered_post['surcharge'],
              'insurance' => (int) $filtered_post['insurance'],
              'deposit' => (int) $filtered_post['deposit'],
              'delivery' => (int) $filtered_post['delivery'],
              'returning' => (int) $filtered_post['returning'],
              'limitation' => (int) $filtered_post['limitation'],
              'baby_chair' => (int) $filtered_post['baby_chair'],
              'roof_rack' => (int) $filtered_post['roof_rack'],
              'casco' => (int) $filtered_post['casco'],
              'osago' => (int) $filtered_post['osago'],
              'pincode' => (int) $filtered_post['pincode'],
              'counter' => 0,
              'favourite' => 0,
              'createdate' => date('Y-m-d H:i:s')
            );

            $result = $this->universal_model->add_item($vars, 'rent_car');
            $this->universal_model->update_table('rent_car_photo', 'pincode = '.(int) $filtered_post['pincode'], array('active' => 1, 'rent_car_id' => $result));

            if ($result)
              redirect("/rent/edit_rent_car/".$result.'?response=1');
            // else
            //   redirect("/dashboard"); //Dopolnit v dalneyshem
          }
        }
      }

      function edit_rent_car($id)
      {
        if (!$this->check_author()) {
          redirect('/rent/not_logged');
        }

        $adid = (int) $id;
        $data['response'] = $this->input->get('response')?(int)$this->input->get('response'):'';

        $this->load->model('PagesModel');
        $this->load->model('dashboard_model');
        $data['popular_mark'] = $this->PagesModel->get_marks(' and popular = 1');
        $data['mark'] = $this->PagesModel->get_marks('');
        $data['classes'] = $this->universal_model->get_more_item_select('rent_class', 'id, class', 'active = 1');
        $data['carmark']  =  $this->dashboard_model->getCarMark();
        $data['carmodel'] = $this->dashboard_model->getCarModel();
        $data['carbody']  =  $this->dashboard_model->getCarBody();
        $data['carcolor']  =  $this->dashboard_model->getCarColor();
        $data['carcities']  =  $this->dashboard_model->getCarCities();
        $authorid = $this->session->userdata('uid');
        $data['editAd'] = $this->universal_model->get_more_item('rent_car', array('id' => $adid, 'authorid' => $authorid), 1);

        $data['title'] = 'dashboard';
        $this->load->view('/site/tez_header', $data);
        if ($data['editAd']) {
          $data['filter_mark_name'] = $this->universal_model->get_more_item_select_row('carmark', 'mark', array('id' => $data['editAd'][0]['mark']));
          $data['filter_model_name'] = $this->universal_model->get_more_item_select_row('carmodel', 'model', array('id' => $data['editAd'][0]['model']));
          $pincode = 0;
          $data['carphotos'] = $this->universal_model->get_more_item_select('rent_car_photo', '*', array('active' => 1, 'deleted' => 0, 'rent_car_id' => $adid), 1, array('location', 'asc'));

          $this->load->view('/rent/edit_rent_car', $data);
        }
        else
          $this->load->view('/Dashboard/noEditCar', array('id' => (int) $this->input->get('id')));

        $this->load->view('/Dashboard/footer');
      }

      function do_edit_rent_car()
      {
        if ($this->input->post())
        {
          $authorid = @$this->session->userdata('uid');
          $filtered_post = $this->filter_data($this->input->post());
          $id = (int) $filtered_post['adid'];

          if ($authorid)
          {
            $vars = array(
              'class' => (int) $filtered_post['class'],
              'mark' => (int) $filtered_post['mark'],
              'model' => (int) $filtered_post['model'],
              'year' => (int) $filtered_post['year'],
              'city' => (int) $filtered_post['city'],
              'body' => (int) $filtered_post['body'],
              'fuel' => $filtered_post['fuel'],
              'transmission' => $filtered_post['transmission'],
              'color' => (int) $filtered_post['color'],
              'wheels' => (int) $filtered_post['wheels'],
              'leather' => (int) $filtered_post['leatherSalon'],
              'parkingsensor' => (int) $filtered_post['parkingSensor'],
              'sunproof' => (int) $filtered_post['sunproof'],
              'camera' => (int) $filtered_post['camera'],
              'heatedseats' => (int) $filtered_post['heatedseats'],
              'centrallocking' => (int) $filtered_post['centrallocking'],
              'abs' => (int) $filtered_post['abs'],
              'xenon' => (int) $filtered_post['xenon'],
              'aircondition' => (int) $filtered_post['aircondition'],
              'rainsensor' => (int) $filtered_post['sensor'],
              'sidecurtains' => (int) $filtered_post['sidecurtains'],
              'seatventilation' => (int) $filtered_post['seatventilation'],
              'esp' => (int) $filtered_post['esp'],
              'additionalinfo' => $filtered_post['additionalInfo'],
              'price' => (float) $filtered_post['price'],
              'currency' => (int) $filtered_post['currency'],
              'included_km' => (int) $filtered_post['included_km'],
              'surcharge' => (int) $filtered_post['surcharge'],
              'insurance' => (int) $filtered_post['insurance'],
              'deposit' => (int) $filtered_post['deposit'],
              'delivery' => (int) $filtered_post['delivery'],
              'returning' => (int) $filtered_post['returning'],
              'limitation' => (int) $filtered_post['limitation'],
              'baby_chair' => (int) $filtered_post['baby_chair'],
              'roof_rack' => (int) $filtered_post['roof_rack'],
              'casco' => (int) $filtered_post['casco'],
              'osago' => (int) $filtered_post['osago']
            );

            $this->universal_model->update_table('rent_car', 'id = '.$id, $vars);
          }

          redirect("/rent/edit_rent_car/".$id);
        }
      }

      function img_upload_main()
    	{
        $this->load->library('FancyFileUploaderHelper');
        $this->load->library('resize');

        // $this->output->enable_profiler(true);
        $pincode = $this->input->get('pincode')?(int)$this->input->get('pincode'):0;
        $carid = $this->input->get('carid')?(int)$this->input->get('carid'):0;

        // Depending on your server, you might have to use $_POST instead of $_REQUEST.
        if (isset($_REQUEST["action"]) && $_REQUEST["action"] === "fileuploader")
        {
          header("Content-Type: application/json");

          $allowedexts = array(
            "jpg" => true,
            "png" => true,
            "JPEG" => true,
            "jpeg" => true
          );

          $files = FancyFileUploaderHelper::NormalizeFiles("files");
          if (!isset($files[0]))  $result = array("success" => false, "error" => "File data was submitted but is missing.", "errorcode" => "bad_input");
          else if (!$files[0]["success"]){ $result = $files[0]; }
          else if (!isset($allowedexts[strtolower($files[0]["ext"])]))
          {
            $result = array(
              "success" => false,
              "error" => "Invalid file extension.  Must be '.jpg' or '.png'.",
              "errorcode" => "invalid_file_ext"
            );
          }
          else
          {
            $success = $files[0]['success'];
            $file = $files[0]['file'];
            $name = strtotime('now').$files[0]['name'];
            $ext = $files[0]['ext'];
            $type = $files[0]['type'];
            $size = $files[0]['size'];

            $path = "/assets/img/rent_car_photos/";
            $authorid = $this->session->userdata('uid');

              if($this->upload($files, $name)){
                $result = array(
                  "success" => true
                );
                $location = $this->rent_model->photoLocation($pincode)['location'];
                $location = ($location == 0)?1:$location+1;

                $vars = array(
                  'name' => $name,
                  'location' => $location,
                  'rent_car_id' => $carid,
                  'active' => $this->input->get('set_active')?1:0,
                  'deleted' => 0,
                  'pincode' => $pincode
                );

                $this->universal_model->add_item($vars, 'rent_car_photo');

                $deg = $this->correctImageOrientation($this->config->item('server_root').'/assets/img/rent_car_photos/'.$name);

                $this->load->library('resize');
        				$this->resize->getFileInfo($this->config->item('server_root').$path.$name);


                $this->resize->resizeImage(1000, 1000, 'landscape');
        				$this->resize->saveImage($this->config->item('server_root').'/assets/img/rent_car_photos/800xauto/'.$name, 90, $deg);


                $upload_location = $this->config->item('server_root').'/assets/img/rent_car_photos/800xauto/'.$name;
                $watermark_image = imagecreatefrompng($this->config->item('server_root').'/assets/img/car_photos/logo/otomoto_logo_transparent.png');

                if ($ext == 'jpg' || $ext == 'jpeg')
                  $image = imagecreatefromjpeg($upload_location);

                if ($ext == 'png')
                  $image = imagecreatefrompng($upload_location);

                $watermark_image_width = imagesx($watermark_image);
                $watermark_image_height = imagesy($watermark_image);
                imagecopy($image, $watermark_image, (imagesx($image) - $watermark_image_width)/2, (imagesy($image) - $watermark_image_height)/2, 0, 0, $watermark_image_width, $watermark_image_height);
                imagepng($image, $upload_location);

                $array = explode('.', $name);
                $jpg = $image;
                $w = imagesx($jpg);
                $h = imagesy($jpg);
                $webp = imagecreatetruecolor($w,$h);
                imagecopy($webp, $jpg, 0, 0, 0, 0, $w, $h);
                imagewebp($webp, $this->config->item('server_root').'/assets/img/rent_car_photos/800xauto/'.$array[0].'.webp', 80);
                imagedestroy($jpg);
                imagedestroy($webp);


        				$this->resize->resizeImage(360, 360, 'auto');
        				$this->resize->saveImage($this->config->item('server_root').'/assets/img/rent_car_photos/90x90/'.$name, 90, $deg);

                $upload_location = $this->config->item('server_root').'/assets/img/rent_car_photos/90x90/'.$name;
                $watermark_image = imagecreatefrompng($this->config->item('server_root').'/assets/img/car_photos/logo/otomoto_logo_transparent0.png');

                if ($ext == 'jpg' || $ext == 'jpeg')
                  $image = imagecreatefromjpeg($upload_location);

                if ($ext == 'png')
                  $image = imagecreatefrompng($upload_location);

                $watermark_image_width = imagesx($watermark_image);
                $watermark_image_height = imagesy($watermark_image);
                imagecopy($image, $watermark_image, (imagesx($image) - $watermark_image_width)/2, (imagesy($image) - $watermark_image_height)/2, 0, 0, $watermark_image_width, $watermark_image_height);
                imagepng($image, $upload_location);

                $array = explode('.', $name);
                $jpg = $image;
                $w = imagesx($jpg);
                $h = imagesy($jpg);
                $webp = imagecreatetruecolor($w,$h);
                imagecopy($webp, $jpg, 0, 0, 0, 0, $w, $h);
                imagewebp($webp, $this->config->item('server_root').'/assets/img/rent_car_photos/90x90/'.$array[0].'.webp', 80);
                imagedestroy($jpg);
                imagedestroy($webp);

        				unlink($this->config->item('server_root').$path.$name);

              }
              else {
                $result = array(
                  "error" => true
                );
              }

          }
          $result['imagePath800'] = $this->config->item('server_root').'/assets/img/rent_car_photos/800xauto/'.$name;
          $result['imagePath90'] = $this->config->item('server_root').'/assets/img/rent_car_photos/90x90/'.$name;
          $result['otomoto'] = $this->security->get_csrf_hash();
          echo json_encode($result, JSON_UNESCAPED_SLASHES);
          exit();
        }
    	}

      function unlinkimage()
      {
        $arr['csrf_name'] = $this->security->get_csrf_token_name();
        $arr['csrf_hash'] = $this->security->get_csrf_hash();

        @unlink($this->input->post('size90'));
        @unlink($this->input->post('size800'));
        $repl = ["jpg", "png", "jpeg"];
        $new = str_replace($repl,'webp', $this->input->post('size90'));
        $new2 = str_replace($repl,'webp', $this->input->post('size800'));
        @unlink($new);
        @unlink($new2);
        $arr = explode('/', $this->input->post('size90'));
        $name = $arr?$arr[count($arr) - 1]:'';

        if ($name)
          $this->universal_model->delete_item(array('name' => $name), 'rent_car_photo');
      }

      function correctImageOrientation($filename)
      {
        $deg = 0;
        $exif = @exif_read_data($filename);
        if($exif && isset($exif['Orientation'])) {
          $orientation = $exif['Orientation'];
          if($orientation != 1){
            switch ($orientation) {
              case 3:
                $deg = 180;
                break;
              case 6:
                $deg = 270;
                break;
              case 8:
                $deg = 90;
                break;
            }
          }
        }
        return $deg;
      }

      function generate_pin()
      {
        $val = rand(0, 99999);
        $check = false;
        $array = $this->rent_model->select_result('carad', 'pincode');
        foreach ($array as $row)
        {
          if ($row->pincode == $val)
            $check = true;
        }

        if ($check)
          $this->generate_pin();
        else
          return $val;
      }

      function check_author()
      {
        if (!$this->session->userdata('uid'))
          return false;
        else
          return true;
      }

      function not_logged()
      {
        $this->load->view('site/tez_header', array('title' => 'dashboard'));
        $this->load->view('/Dashboard/index2');
        $this->load->view('/Dashboard/footer');
      }

      public function upload($file, $name)
      {
        if ($file)
        {
          $config['upload_path'] = $this->config->item('server_root').'/assets/img/rent_car_photos/';
          $config['file_name'] = $name;
          $config['overwrite'] = TRUE;
          $config["allowed_types"] = 'jpg|png|JPEG|jpeg';
          $config["max_size"] = 20048;
          $config["max_width"] = 20000;
          $config["max_height"] = 20000;
          $this->load->library('upload', $config);

          if (!$this->upload->do_upload('files')) {
              $data['error'] = $this->upload->display_errors();
              print_r($data['error']);
          } else {
            return "1";
          }
        }
      }

      function remove_image()
      {
        $id = (int) $this->input->get('id');
        $this->universal_model->update_table('rent_car_photo', 'id = '.$id, array('deleted' => 1));
        echo "success";
      }

      function change_img_order()
      {
        $posts = $this->filter_data($this->input->post());
        $this->universal_model->update_table('rent_car_photo', 'id = '.(int) $posts['id'], array('location' => (float) $posts['pos']));
      }
    }
