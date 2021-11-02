<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	public $adm_menu;
	public $langs;

	function __construct()
	{
		// $this->output->enable_profiler(TRUE);
		parent::__construct();
		$this->load->model('universal_model');
		$this->load->model('adm_model');
    if (!$this->session->userdata('tmp_user'))
      $this->session->set_userdata('tmp_user', strtotime(date('Y-m-d H:i:s')));
	}

	function counter()
	{
	 	$ip = $this->input->ip_address();

		$check = $this->universal_model->get_more_item_select('counter', 'id, views', array('ip_address' => $ip), 0, array('last_visite_date', 'desc'));

		if ($check && @$check[0]->id) {
			$today_check = $this->universal_model->get_more_item_select('counter', 'id, views', 'ip_address = "'.$ip.'" and last_visite_date > DATE_SUB(NOW() + INTERVAL 1 HOUR, INTERVAL 10 MINUTE)', 0, array('last_visite_date', 'desc'));
			if($today_check && @$today_check[0]->id) {
				$vars = array(
					'last_visite_date' => date('Y-m-d H:i:s'),
					'views' => ((int)($today_check[0]->views) + 1)
				);

				$this->universal_model->update_table('counter', array('id' => $today_check[0]->id), $vars);
			} else {
				$vars = array(
					'ip_address' => $ip,
					'last_visite_date' => date('Y-m-d H:i:s'),
					'views' => 1
				);

				$this->universal_model->add_item($vars, 'counter');
			}
		} else {
			$vars = array(
				'ip_address' => $ip,
				'last_visite_date' => date('Y-m-d H:i:s'),
				'views' => 1
			);

			$this->universal_model->add_item($vars, 'counter');
		}
	}

	function header_data()
	{
		// $check_mobile = $this->isMobile();
		// $data['check_mobile'] = $check_mobile;
		//
		// if(!$check_mobile) {
		// 	$data['last_24_hours'] = $this->universal_model->get_more_item_select_row('counter', 'count(distinct(ip_address)) as "count", sum(views) as "views"', 'last_visite_date > DATE_SUB(NOW() + INTERVAL 1 HOUR, INTERVAL 24 HOUR)');
		// 	$data['today'] = $this->universal_model->get_more_item_select_row('counter', 'count(distinct(ip_address)) as "count", sum(views) as "views"', 'DATE(last_visite_date) = "'.date('Y-m-d').'"');
		// 	$data['last_7_day'] = $this->universal_model->get_more_item_select_row('counter', 'count(distinct(ip_address)) as "count", sum(views) as "views"', 'last_visite_date > DATE_SUB(NOW() + INTERVAL 1 HOUR, INTERVAL 7 DAY)');
		// 	$data['last_31_day'] = $this->universal_model->get_more_item_select_row('counter', 'count(distinct(ip_address)) as "count", sum(views) as "views"', 'last_visite_date > DATE_SUB(NOW() + INTERVAL 1 HOUR, INTERVAL 31 DAY)');
		// 	$data['online'] = $this->universal_model->get_more_item_select_row('counter', 'count(distinct(ip_address)) as "count", sum(views) as "views"', 'last_visite_date > DATE_SUB(NOW() + INTERVAL 1 HOUR, INTERVAL 10 MINUTE)');
		// }

		$autosalon = 0;

		if ($this->session->userdata('uid')) {
			$res = $this->universal_model->get_item_where('user', array('id' => $this->session->userdata('uid')), 'autosalon');
			if ($res) {
				if ($res->autosalon)
					$autosalon = 1;
			}
		}

		$data['is_salon'] = $autosalon;
		$data['add_header'] = true;
		return $data;
	}

	function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}

	public function chat()
	{
		$this->load->model('PagesModel');
		$data['info'] = $this->PagesModel->get_chat_info();

		if($this->input->post())
			$filtered_post = $this->filter_data($this->input->post());

		$data['qid'] = (isset($filtered_post['qid']))?$filtered_post['qid']:'';

		return $this->load->view("/include/chat", $data, TRUE);
	}

	public function profilemenu()
	{
		$uinfo_arr = $this->universal_model->get_more_item('user', array('id' => $this->session->userdata('uid')), 1);
		$data['uinfo'] = $uinfo_arr[0];

		return $this->load->view("/include/profilemenu", $data, TRUE);
	}

	public function cat_carusel()
	{
		$data["info"] = $this->universal_model->get_more_item('elancats', array("active" => 1, "maincat" => 0, "subinfocat" => 0), 1, array('sira', 'asc'));

		return $this->load->view("/include/cat_carusel", $data, TRUE);
	}

	public function lucky()
	{
		$this->load->model('PagesModel');
		$data["info"] = $this->PagesModel->get_lucky_info();

		return $this->load->view("/include/lucky", $data, TRUE);
	}

	function check_role()
	{
		$link =  $this->uri->segment("1").$this->uri->segment("2");
		$result = $this->adm_model->check_role($link);
		if(!$result & !$this->input->post())
		{
			$this->home("errors/inaccessible", "", TRUE);
			$this->CI =& get_instance();
			$this->CI->output->_display();
			die();
		}else if(!$result & ($this->input->post("method")=="ajax"))
		{
			echo '{"msg":"You are not authorized to perform this operation!", "status":"error", "title":"Error!", "'.($this->security->get_csrf_token_name()).'":"'.($this->security->get_csrf_hash()).'"}';
			//$this->output->enable_profiler(TRUE);
			die();
		}
	}

	public function home($content="", $content_data=array(), $page_title="")
	{
		// $this->output->enable_profiler(true);
		$footer = array();
		$menus = array();
		if(!$page_title)
			@$content_data["page_title"] = @$this->adm_model->get_page_title()->name;

		$mylink = '/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/';
		$left_menu = $this->get_adm_menu($mylink);

		$menus['left_menu'] = $left_menu;
		$header["title"] = $content;
		$footer["title"] = $content;

		$data= array(
				"header"		=> $this->load->view('admin/header', $header, TRUE),
				"left_side"		=> $this->load->view('admin/left_side', $menus, TRUE),
				"content"		=> $this->load->view($content, $content_data, TRUE),
				"footer"		=> $this->load->view('admin/footer',$footer, TRUE)
		);

		$this->load->view('admin/index', $data);
	}

	public function menu_name()
	{
		$link =  $this->uri->segment("1").$this->uri->segment("2");
		$result = $this->adm_model->check_role($link);
		return $result->name;
	}

	function get_adm_menu($mylink)
	{
		$menus = $this->adm_model->admin_menu($this->session->userdata('role_id'));
		$opened_parent_arr = $this->adm_model->select_where_row('parent_id', array('link' => $mylink), 'ali_admin_menus_id');
		$opened_parent = $opened_parent_arr?$opened_parent_arr->parent_id:'';

		$count_array = [];

		$menus_id = array();
		$sub_category = array();
		$menu_name = array();
		$menu_url = array();
		$menu_icon = array();
		$parent_id = array();
		foreach($menus as $row)
		{
			$menu_name[(string)$row->menu_id] = $row->name;
			$sub_id =$row->parent_id;
			$parent_id[(string)$row->menu_id] = $row->parent_id;
			$menu_url[(string)$row->menu_id] = $row->link;
			$menu_icon[(string)$row->menu_id] = $row->icon;
			$sub_id = (string)$sub_id;
			if(!array_key_exists($sub_id, $sub_category))
			$sub_category[$sub_id] = array();
			$sub_category[$sub_id][] = (string)$row->menu_id;
		}
		$first_ul = 1;
		$this->tree_menu('0',$menu_name, $sub_category, $first_ul, $menu_url, $menu_icon, $parent_id, $count_array, $mylink, $opened_parent);
		return $this->adm_menu;
	}

	function tree_menu($parent = "0", $menu_name, $sub_category,  $first_ul, $menu_url, $menu_icon, $parent_id, $count_array = [], $mylink='', $opened_parent = '')
	{
		//m-menu__item--open
		$img = "";
	  if($parent != "0")
		{
			if($menu_icon[$parent])
				$img = '<i class="m-menu__link-icon fa '.$menu_icon[$parent].' "></i> ';
			$url = "#";
			if(!empty($menu_url[$parent]) && $menu_url[$parent]!="#")
				$url = $menu_url[$parent];

			$menu_count = '';
			foreach($count_array as $row):
				if($url == $row['url'])
					$menu_count = '<span class="m-count">'.$row['count'].'</span>';
			endforeach;

			$opened = ($parent==$opened_parent)?'m-menu__item--open':'';
			$activee = ($url == $mylink)?'m-menu__item--active':'';

			$this->adm_menu =  $this->adm_menu.'
			<li class="m-menu__item  m-menu__item--submenu '.$opened.' '.$activee.'" aria-haspopup="true"  m-menu-submenu-toggle="hover"><a href="'.$url.'" class="m-menu__link m-menu__toggle">'.$img.'<span class="m-menu__link-text">'.$menu_name[$parent].'</span>'.$menu_count.'</a>';
			$img = "";

		}
    $children = @$sub_category[$parent];
    if(@count($children) != "0")
		{
			if($first_ul==1)
				$this->adm_menu = $this->adm_menu;
			else
		   $this->adm_menu = $this->adm_menu.'<div class="m-menu__submenu ">
				 <span class="m-menu__arrow"></span>
				 <ul class="m-menu__subnav">';

			foreach($children as $child)
				$this->tree_menu($child, $menu_name, $sub_category, 0, $menu_url, $menu_icon, $parent_id, $count_array, $mylink, $opened_parent);

	    $this->adm_menu =  $this->adm_menu."</ul></div>";
    }
    if($parent != "0") $this->adm_menu =  $this->adm_menu."</li>";
	}

	function get_url($row)
  {
    $stitle = stripslashes($row['title']);

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
    $slug=str_replace('$','',$slug);
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
    $slug=str_replace('|','',$slug);
    $slug=str_replace('!','',$slug);
    $url=$slug."/".$row['eid'];
    return $url;
  }

	function is_logged_in()
	{
		$user_name = $this->session->userdata('role_id');
		if(!$user_name)
			redirect("/auth2");
	}

	function check_method_boolen($id)
	{
		$result = $this->adm_model->check_method($id);
		if($result)
			return TRUE;
		else
			return FALSE;
	}

	function pagination($from=0, $perPage=100, $baseUrl, $totalRow, $uriSegment=4, $numLinks = 5)
  {
    $this->load->library('pagination');
    if($this->uri->segment($uriSegment))
    $from = $this->uri->segment($uriSegment);
    $config['base_url'] =$baseUrl;

    $query_string = $_GET;
		if(isset($query_string['page']))
		{
			unset($query_string['page']);
		}
		if (count($query_string) > 0)
		{
			$config['suffix'] = '&' . http_build_query($query_string, '', "&");
			$config['first_url'] = $config['base_url'] . '?' . http_build_query($query_string, '', "&");
		}
    $config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
    $config['total_rows'] = $totalRow;
    $config['per_page'] =  $perPage;
    $config['num_links'] = $numLinks;
    $config['next_link'] = '&rsaquo;';
    $config['prev_link'] = '&lsaquo;';
    $config['first_link'] = "First";
    $config['last_link'] = "Last";
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item disabled"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['uri_segment'] = $uriSegment;
    $this->pagination->initialize($config);
    return $this->pagination->create_links();
  }

	function search($array, $key, $value)
	{
		$results = array();
		if (is_array($array))
		{
		    if (isset($array[$key]) && $array[$key] == $value)
		        $results[] = $array;
		    foreach ($array as $subarray)
		        $results = array_merge($results, $this->search($subarray, $key, $value));
		}
		return $results;
	}

  function do_upload($inputname, $upload_path, $file_size=20000, $img_name="", $types='txt|gif|jpg|png|TIF|TIFF|pdf|JPEG|jpeg|doc|docx|xls|xlsx|ppt|pptx')
  {
	 	$data = array();
		$config['upload_path'] = $upload_path;
		$config['overwrite'] = 1;
		$config['allowed_types'] = $types;
		$config["max_size"] = $file_size;
		$config['file_name'] = $img_name."_".strtotime(date("Y-m-d H:i:s"));
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($inputname))
			$data = array('error' => $this->upload->display_errors());
		else
			$data = $this->upload->data();

    return $data;
  }

	function resize_image($image_path=null, $resizeDirName="certificate", $width=null, $height=null, $maintain_ratio=FALSE,$if_width_max=FALSE, $attributes=null, $return_direct_link=false)
	{
		$CI =& get_instance();
		$path_parts = pathinfo($image_path);
		$image_name = $path_parts['filename'];
		@$image_thumb = $resizeDirName.'/'.$image_name.'.'.$path_parts['extension'];
		$config="";
		$img_width = "";
		$CI->load->library('image_lib');
		//$CI->image_lib->clear();
		if(!file_exists($image_thumb))
		{
			$config['image_library'] = 'GD2';
			$config['source_image'] = $image_path;
			$config['new_image'] = $image_thumb;
			$config['maintain_ratio'] = $maintain_ratio;

			if($if_width_max==TRUE)
			{
				list($img_width, $img_height) = getimagesize($image_path);
				if($img_width > $width)
				{
					$config['height'] = $height;
					$config['width'] = $width;
				}
			}else
			{
				$config['height'] = $height;
				$config['width'] = $width;
			}
			$CI->image_lib->initialize($config);
			if(!$CI->image_lib->resize())
			{
				return $CI->image_lib->display_errors();
			}
			$CI->image_lib->clear();
		}
	}

	function convert_str($str)
	{
	    $search_tr = array('ı', 'İ', 'Ğ', 'ğ', 'Ü', 'ü', 'Ş', 'ş', 'Ö', 'ö', 'Ç', 'ç', 'Ə','ə','*','!','`','~','@','"','#','$','%','^','&','?',',','|','\\','/','.',']','[','+','-',')','(',';',"'", ' ', '&nbsp;','“','”','№');
	    $replace_tr = array('i', 'I', 'G', 'g', 'U', 'u', 'S', 's', 'O', 'o', 'C', 'c','E','e','','','','','','','','','','','','','','','','','','','','','','','','',"", '-', '-','','','');
	    $str = str_replace($search_tr, $replace_tr, $str);
	    $str = strip_tags($str);
		return $str;
	}

	function filter_data($array)
	{
		$data = array();
		foreach ($array as $key => $value) {
			if(is_array($value))
				$data[$key]= $value;
			else
				$data[$key]= filter_var(str_replace(array("'", '"',"`", ')', '('), array("","","","",""), $this->security->xss_clean(strip_tags(rawurldecode($value)))), FILTER_SANITIZE_STRING);
		}
		return $data;
	}

  /***********GALLERY**************/
  private function resize_all_image($full_path, $img_name)
  {
      if(!file_exists($this->config->item('server_root').'/assets/img/car_photos/90x90/'.$img_name))
      {
          $this->load->library('resize');
          $this->resize->getFileInfo($full_path);
          $this->resize->resizeImage(90, 90, 'crop');
          $this->resize->saveImage($this->config->item('server_root').'/assets/img/car_photos/90x90/'.$img_name, 75);
					$this->resize->resizeImage(1000, 1000, 'landscape');
          $this->resize->saveImage($this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$img_name, 90);
      }
  }

  function getRealFile($file) {
      $uploadDir ="/img/products/";
      $realUploadDir = $this->config->item("server_root").'/img/products/';

      return str_replace($uploadDir, $realUploadDir, $file);
  }

	function generate_name()
	{
		$this->load->helper('string');
		$val = random_string('alnum', 25);
		$check = false;

		$array = $this->universal_model->select_result('carphoto', 'name');
		foreach ($array as $row)
		{
			if ($row->name == 'img_'.$val)
				$check = true;
		}

		if ($check)
			$this->generate_name();
		else
			return $val;
	}

	function ajax($pathh)
  {
      require($this->config->item("server_root").'/class.fileuploader.php');
      $_action = isset($_GET['type']) ? $_GET['type'] : '';

			$uploadDir = $this->config->item("server_root").$pathh.'/';
			$realUploadDir = $this->config->item("server_root").$pathh.'/';

			if($this->input->get())
				$filtered_get = $this->filter_data($this->input->get());

			$product_id = ($this->input->get('product_id'))?(int)$filtered_get['product_id']:0;

      // upload
      if ($_action == 'upload') {
          $id = false;
					$generated_name = $this->generate_name();
          $title = 'img_'.$generated_name;

					//$_FILES['files']['name']
          // initialize FileUploader
          $FileUploader = new FileUploader('files', array(
              'limit' => 1,
              'fileMaxSize' => 20,
              'extensions' => array('image/*'),
              'uploadDir' => $realUploadDir,
              'required' => true,
              'title' => $title,
              'replace' => $id,
              'editor' => array(
                  'maxWidth' => 1980,
                  'maxHeight' => 1980,
                  'crop' => false,
                  'quality' => 90
              )
          ));

          $upload = $FileUploader->upload();

          if (count($upload['files']) == 1) {
              $item = $upload['files'][0];
              $file = $uploadDir.'/'.$item['name'];
							$deg = $this->correctImageOrientation($file);

							$location_arr = $this->universal_model->get_item_where('carphoto', array('caradid' => $product_id), 'MAX(location) as "location"');
							$location = $location_arr?$location_arr->location:0;

							$query = $this->universal_model->add_item(array('name' => $item['name'], 'location' => ($location + 1), 'caradid' => $product_id, 'active' => 1, 'deleted' => 0, 'pincode' => ''), "carphoto");

              if ($query) {
                  $upload['files'][0] = array(
                      'title' => $item['title'],
                      'thumb'=> $pathh.'/'.$item['name'],
                      'name' => $item['name'],
                      'size' => $item['size'],
                      'size2' => $item['size2'],
                      'url' => $file,
                      'id' => $query
                  );
              } else {
                  unset($upload['files'][0]);
                  $upload['hasWarnings'] = true;
                  $upload['warnings'][] = 'An error occured.';
              }

							$this->load->library('resize');
	    				$this->resize->getFileInfo($this->config->item('server_root').$pathh.'/'.$item['name']);
	    				$this->resize->resizeImage(1000, 1000, 'landscape');
	    				$this->resize->saveImage($this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$item['name'], 90, $deg);

							$ext = $item['extension'];
							$upload_location = $this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$item['name'];
	            $watermark_image = imagecreatefrompng($this->config->item('server_root').'/assets/img/car_photos/logo/otomoto_logo_transparent_big.png');
	            if ($ext == 'jpg' || $ext == 'jpeg')
	              $image = imagecreatefromjpeg($upload_location);

	            if ($ext == 'png')
	              $image = imagecreatefrompng($upload_location);

	            $watermark_image_width = imagesx($watermark_image);
	            $watermark_image_height = imagesy($watermark_image);
	            imagecopy($image, $watermark_image, (imagesx($image) - $watermark_image_width)/2, (imagesy($image) - $watermark_image_height)/2, 0, 0, $watermark_image_width, $watermark_image_height);
	            imagepng($image, $upload_location);

							$array = explode('.', $item['name']);
							$jpg = $image;
							$w = imagesx($jpg);
							$h = imagesy($jpg);
							$webp = imagecreatetruecolor($w,$h);
							imagecopy($webp, $jpg, 0, 0, 0, 0, $w, $h);
							imagewebp($webp, $this->config->item('server_root').'/assets/img/car_photos/800xauto/'.$array[0].'.webp', 80);
							imagedestroy($jpg);
							imagedestroy($webp);

	    				$this->resize->resizeImage(360, 360, 'auto');
	    				$this->resize->saveImage($this->config->item('server_root').'/assets/img/car_photos/90x90/'.$item['name'], 90, $deg);

							$upload_location = $this->config->item('server_root').'/assets/img/car_photos/90x90/'.$item['name'];
	            $watermark_image = imagecreatefrompng($this->config->item('server_root').'/assets/img/car_photos/logo/otomoto_logo_transparent0.png');
	            if ($ext == 'jpg' || $ext == 'jpeg')
	              $image = imagecreatefromjpeg($upload_location);

	            if ($ext == 'png')
	              $image = imagecreatefrompng($upload_location);

	            $watermark_image_width = imagesx($watermark_image);
	            $watermark_image_height = imagesy($watermark_image);
							imagecopy($image, $watermark_image, (imagesx($image) - $watermark_image_width)/2, (imagesy($image) - $watermark_image_height)/2, 0, 0, $watermark_image_width, $watermark_image_height);
	            imagepng($image, $upload_location);

							$array = explode('.', $item['name']);
							$jpg = $image;
							$w = imagesx($jpg);
							$h = imagesy($jpg);
							$webp = imagecreatetruecolor($w,$h);
							imagecopy($webp, $jpg, 0, 0, 0, 0, $w, $h);
							imagewebp($webp, $this->config->item('server_root').'/assets/img/car_photos/90x90/'.$array[0].'.webp', 80);
							imagedestroy($jpg);
							imagedestroy($webp);

	    				unlink($this->config->item('server_root').$pathh.'/'.$item['name']);
          }

					$upload['otomoto'] = $this->security->get_csrf_hash();
          echo json_encode($upload);
          exit;
      }

      // preload
      if ($_action == 'preload') {
          $preloadedFiles = array();

          $query = $this->universal_model->get_more_item("carphoto", array('caradid' => $product_id, 'active' => 1, 'deleted' => 0), 0, array("location", "asc"));
          if ($query) {
              foreach($query as $row) {
                  $preloadedFiles[] = array(
                      'name' => $row->name,
                      'type' => getimagesize($this->config->item("server_root").$pathh."/90x90/".$row->name)['mime'],
                      'size' => filesize($this->config->item("server_root").$pathh."/90x90/".$row->name),
                      'file' => $pathh."/90x90/".$row->name,
                      'data' => array(
                          'readerForce' => true,
                          'url' => $pathh."/90x90/".$row->name,
                          'listProps' => array(
                              'id' => $row->id,
                          )
                      )
                  );
              }
              echo json_encode($preloadedFiles);
          }
					else
            echo "[]";

          exit;
      }

      // sort
      if ($_action == 'sort') {
          $id = 0;
          if (isset($_POST['list'])) {
            $list = json_decode($_POST['list'], true);

            for($i=0; $i<count($list); $i++) {
              if (!isset($list[$i]['id']) || !isset($list[$i]['index']))
                break;
              $id = (int)$list[$i]['id'];
              $result = $this->universal_model->item_edit_save_where(array("location"=>$list[$i]['index']), array("id" => $id), "carphoto");
            }
          }
          exit;
      }

      // asmain
      if ($_action == 'asmain') {
          /*if (isset($_POST['id']) && isset($_POST['name'])) {
              $id = $DB->real_escape_string($_POST['id']);

              $this->universal_model->item_edit_save_where(array("image"=>$estate->thumb), array("id"=>$estate->product_id), "estate");
              $query = $DB->query("UPDATE agro_gallery SET is_main = 0");
              $query = $DB->query("UPDATE agro_gallery SET is_main = 1 WHERE id = '$id'");
          }
          exit;*/
      }

      // remove
      if ($_action == 'remove') {
        if (isset($_POST['id']) && isset($_POST['name'])) {
          $id = $this->input->post('id');
          $img = $_POST['name'];

					$raw = $this->universal_model->get_item_where('carphoto', array('id' => $id), 'name');

					if($raw)
					{
						$del_arr = explode('.', $raw->name);
						if(file_exists($this->config->item('server_root').$pathh."/800xauto/".$raw->name))
							unlink($this->config->item("server_root").$pathh."/800xauto/".$raw->name);
						if(file_exists($this->config->item('server_root').$pathh."/90x90/".$raw->name))
							unlink($this->config->item("server_root").$pathh."/90x90/".$raw->name);
						if(file_exists($this->config->item('server_root').$pathh."/800xauto/".$del_arr[0].'.webp'))
							unlink($this->config->item("server_root").$pathh."/800xauto/".$del_arr[0].'.webp');
						if(file_exists($this->config->item('server_root').$pathh."/90x90/".$del_arr[0].'.webp'))
							unlink($this->config->item("server_root").$pathh."/90x90/".$del_arr[0].'.webp');
						$img_base_name = explode(".", $raw->name);
						$img_name = md5("or".@$img_base_name[0]).".".@$img_base_name[1];
						if(file_exists($this->config->item('server_root').$pathh.'/'.$img_name))
							unlink($this->config->item('server_root').$pathh.'/'.$img_name);

						$this->universal_model->delete_item_where(array("id" => $id), "carphoto");
					}
        }
        exit;
      }

  }

	function rent_ajax($pathh)
  {
      require($this->config->item("server_root").'/class.fileuploader.php');
      $_action = isset($_GET['type']) ? $_GET['type'] : '';

			$uploadDir = $this->config->item("server_root").$pathh.'/';
			$realUploadDir = $this->config->item("server_root").$pathh.'/';

			if($this->input->get())
				$filtered_get = $this->filter_data($this->input->get());

			$product_id = ($this->input->get('product_id'))?(int)$filtered_get['product_id']:0;

      // upload
      if ($_action == 'upload') {
          $id = false;
					$generated_name = $this->generate_name();
          $title = 'img_'.$generated_name;

					//$_FILES['files']['name']
          // initialize FileUploader
          $FileUploader = new FileUploader('files', array(
              'limit' => 1,
              'fileMaxSize' => 20,
              'extensions' => array('image/*'),
              'uploadDir' => $realUploadDir,
              'required' => true,
              'title' => $title,
              'replace' => $id,
              'editor' => array(
                  'maxWidth' => 19800,
                  'maxHeight' => 19800,
                  'crop' => false,
                  'quality' => 90
              )
          ));

          $upload = $FileUploader->upload();

          if (count($upload['files']) == 1) {
              $item = $upload['files'][0];
              $file = $uploadDir.'/'.$item['name'];
							$deg = $this->correctImageOrientation($file);

							$location_arr = $this->universal_model->get_item_where('rent_car_photo', array('rent_car_id' => $product_id), 'MAX(location) as "location"');
							$location = $location_arr?$location_arr->location:0;

							$query = $this->universal_model->add_item(array('name' => $item['name'], 'location' => ($location + 1), 'rent_car_id' => $product_id, 'active' => 1, 'deleted' => 0, 'pincode' => ''), "rent_car_photo");

              if ($query) {
                  $upload['files'][0] = array(
                      'title' => $item['title'],
                      'thumb'=> $pathh.'/'.$item['name'],
                      'name' => $item['name'],
                      'size' => $item['size'],
                      'size2' => $item['size2'],
                      'url' => $file,
                      'id' => $query
                  );
              } else {
                  unset($upload['files'][0]);
                  $upload['hasWarnings'] = true;
                  $upload['warnings'][] = 'An error occured.';
              }

							$this->load->library('resize');
	    				$this->resize->getFileInfo($this->config->item('server_root').$pathh.'/'.$item['name']);
	    				$this->resize->resizeImage(1000, 1000, 'landscape');
	    				$this->resize->saveImage($this->config->item('server_root').'/assets/img/rent_car_photos/800xauto/'.$item['name'], 90, $deg);

							$ext = $item['extension'];
							$upload_location = $this->config->item('server_root').'/assets/img/rent_car_photos/800xauto/'.$item['name'];
	            $watermark_image = imagecreatefrompng($this->config->item('server_root').'/assets/img/rent_car_photos/logo/otomoto_logo_transparent_big.png');
	            if ($ext == 'jpg' || $ext == 'jpeg')
	              $image = imagecreatefromjpeg($upload_location);

	            if ($ext == 'png')
	              $image = imagecreatefrompng($upload_location);

	            $watermark_image_width = imagesx($watermark_image);
	            $watermark_image_height = imagesy($watermark_image);
	            imagecopy($image, $watermark_image, (imagesx($image) - $watermark_image_width)/2, (imagesy($image) - $watermark_image_height)/2, 0, 0, $watermark_image_width, $watermark_image_height);
	            imagepng($image, $upload_location);

							$array = explode('.', $item['name']);
							$jpg = $image;
							$w = imagesx($jpg);
							$h = imagesy($jpg);
							$webp = imagecreatetruecolor($w,$h);
							imagecopy($webp, $jpg, 0, 0, 0, 0, $w, $h);
							imagewebp($webp, $this->config->item('server_root').'/assets/img/rent_car_photos/800xauto/'.$array[0].'.webp', 80);
							imagedestroy($jpg);
							imagedestroy($webp);

	    				$this->resize->resizeImage(360, 360, 'auto');
	    				$this->resize->saveImage($this->config->item('server_root').'/assets/img/rent_car_photos/90x90/'.$item['name'], 90, $deg);

							$upload_location = $this->config->item('server_root').'/assets/img/rent_car_photos/90x90/'.$item['name'];
	            $watermark_image = imagecreatefrompng($this->config->item('server_root').'/assets/img/rent_car_photos/logo/otomoto_logo_transparent0.png');
	            if ($ext == 'jpg' || $ext == 'jpeg')
	              $image = imagecreatefromjpeg($upload_location);

	            if ($ext == 'png')
	              $image = imagecreatefrompng($upload_location);

	            $watermark_image_width = imagesx($watermark_image);
	            $watermark_image_height = imagesy($watermark_image);
							imagecopy($image, $watermark_image, (imagesx($image) - $watermark_image_width)/2, (imagesy($image) - $watermark_image_height)/2, 0, 0, $watermark_image_width, $watermark_image_height);
	            imagepng($image, $upload_location);

							$array = explode('.', $item['name']);
							$jpg = $image;
							$w = imagesx($jpg);
							$h = imagesy($jpg);
							$webp = imagecreatetruecolor($w,$h);
							imagecopy($webp, $jpg, 0, 0, 0, 0, $w, $h);
							imagewebp($webp, $this->config->item('server_root').'/assets/img/rent_car_photos/90x90/'.$array[0].'.webp', 80);
							imagedestroy($jpg);
							imagedestroy($webp);

	    				unlink($this->config->item('server_root').$pathh.'/'.$item['name']);
          }

					$upload['otomoto'] = $this->security->get_csrf_hash();
          echo json_encode($upload);
          exit;
      }

      // preload
      if ($_action == 'preload') {
          $preloadedFiles = array();

          $query = $this->universal_model->get_more_item("rent_car_photo", array('rent_car_id' => $product_id, 'active' => 1), 0, array("location", "asc"));
          if ($query) {
              foreach($query as $row) {
                  $preloadedFiles[] = array(
                      'name' => $row->name,
                      'type' => getimagesize($this->config->item("server_root").$pathh."/90x90/".$row->name)['mime'],
                      'size' => filesize($this->config->item("server_root").$pathh."/90x90/".$row->name),
                      'file' => $pathh."/90x90/".$row->name,
                      'data' => array(
                          'readerForce' => true,
                          'url' => $pathh."/90x90/".$row->name,
                          'listProps' => array(
                              'id' => $row->id,
                          )
                      )
                  );
              }
              echo json_encode($preloadedFiles);
          }
					else
            echo "[]";

          exit;
      }

      // sort
      if ($_action == 'sort') {
          $id = 0;
          if (isset($_POST['list'])) {
            $list = json_decode($_POST['list'], true);

            for($i=0; $i<count($list); $i++) {
              if (!isset($list[$i]['id']) || !isset($list[$i]['index']))
                break;
              $id = (int)$list[$i]['id'];
              $result = $this->universal_model->item_edit_save_where(array("location"=>$list[$i]['index']), array("id" => $id), "rent_car_photo");
            }
          }
          exit;
      }

      // asmain
      if ($_action == 'asmain') {
          /*if (isset($_POST['id']) && isset($_POST['name'])) {
              $id = $DB->real_escape_string($_POST['id']);

              $this->universal_model->item_edit_save_where(array("image"=>$estate->thumb), array("id"=>$estate->product_id), "estate");
              $query = $DB->query("UPDATE agro_gallery SET is_main = 0");
              $query = $DB->query("UPDATE agro_gallery SET is_main = 1 WHERE id = '$id'");
          }
          exit;*/
      }

      // remove
      if ($_action == 'remove') {
        if (isset($_POST['id']) && isset($_POST['name'])) {
          $id = $this->input->post('id');
          $img = $_POST['name'];

					$raw = $this->universal_model->get_item_where('rent_car_photo', array('id' => $id), 'name');

					if($raw)
					{
						$del_arr = explode('.', $raw->name);
						if(file_exists($this->config->item('server_root').$pathh."/800xauto/".$raw->name))
							unlink($this->config->item("server_root").$pathh."/800xauto/".$raw->name);
						if(file_exists($this->config->item('server_root').$pathh."/90x90/".$raw->name))
							unlink($this->config->item("server_root").$pathh."/90x90/".$raw->name);
						if(file_exists($this->config->item('server_root').$pathh."/800xauto/".$del_arr[0].'.webp'))
							unlink($this->config->item("server_root").$pathh."/800xauto/".$del_arr[0].'.webp');
						if(file_exists($this->config->item('server_root').$pathh."/90x90/".$del_arr[0].'.webp'))
							unlink($this->config->item("server_root").$pathh."/90x90/".$del_arr[0].'.webp');
						$img_base_name = explode(".", $raw->name);
						$img_name = md5("or".@$img_base_name[0]).".".@$img_base_name[1];
						if(file_exists($this->config->item('server_root').$pathh.'/'.$img_name))
							unlink($this->config->item('server_root').$pathh.'/'.$img_name);

						$this->universal_model->delete_item_where(array("id" => $id), "rent_car_photo");
					}
        }
        exit;
      }

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

}
