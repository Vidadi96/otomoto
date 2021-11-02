<?php
    class Car_showroom extends MY_Controller
    {
        public $webp;

        function __construct()
      	{
      		parent::__construct();
      		$this->load->model("car_showroom_model");
          $this->load->model("universal_model");
          $this->webp = (preg_match("/image\/webp/i", $_SERVER['HTTP_ACCEPT']) == 1 || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/'))?1:0;
      	}

        public function index()
        {
          $this->counter();

          $data['title'] = 'car_showroom_list';

          $type = 1;

          if ($this->input->get()) {
            $type = $this->input->get('autosalon_type')?(int)$this->input->get('autosalon_type'):1;
          }

          $data['car_showroom_list'] = $this->car_showroom_model->get_car_showroom_list($type);
          $data['type'] = $type;

          $header = $this->header_data();
          $content = array_merge($data, $header);

          $this->load->view('site/tez_header', $content);
          $this->load->view('car_showroom/car_showroom_list');
          $this->load->view('site/footer');
        }

        public function car_showroom($id)
        {
          $this->counter();

          $id = (int) $id;

          if ($id) {
            $data['webp'] = $this->webp;
            $data['title'] = 'car_showroom';

            $data['showroom'] = $this->car_showroom_model->get_showroom_data($id);
            $top_plus_arr = $this->car_showroom_model->get_showroom_ads('car.authorid = '.$id.' and car.premium = 1', 'car.premium_update_date desc');
            $top_arr = $this->car_showroom_model->get_showroom_ads('car.authorid = '.$id.' and car.vip = 1 and car.premium = 0', 'car.vip_update_date desc');
            $simple_arr = $this->car_showroom_model->get_showroom_ads('car.authorid = '.$id.' and car.premium = 0 and car.vip = 0', 'car.createdate desc');
            $data['cars'] = array_merge($top_plus_arr, $top_arr, $simple_arr);

            $header = $this->header_data();
            $content = array_merge($data, $header);

            $this->load->view('site/tez_header', $content);
            $this->load->view('car_showroom/car_showroom');
            $this->load->view('site/footer');
          }
        }

        public function rent_car_showroom($id)
        {
          $id = (int) $id;

          if ($id) {
            $data['webp'] = $this->webp;
            $data['title'] = 'car_showroom';

            $data['showroom'] = $this->car_showroom_model->get_showroom_data($id);
            // $top_plus_arr = $this->car_showroom_model->get_showroom_ads('car.authorid = '.$id.' and car.premium = 1', 'car.premium_update_date desc');
            // $top_arr = $this->car_showroom_model->get_showroom_ads('car.authorid = '.$id.' and car.vip = 1 and car.premium = 0', 'car.vip_update_date desc');
            $simple_arr = $this->car_showroom_model->get_rent_showroom_ads('car.authorid = '.$id, 'car.createdate desc');
            $data['cars'] = $simple_arr; //array_merge($top_plus_arr, $top_arr, $simple_arr);

            $header = $this->header_data();
            $content = array_merge($data, $header);

            $this->load->view('site/tez_header', $content);
            $this->load->view('car_showroom/rent_car_showroom');
            $this->load->view('site/footer');
          }
        }

        public function showroom_counter()
        {
          if($this->input->post())
          {
            $id = (int) $this->input->post('id');
            $count_arr = $this->universal_model->get_more_item_select_row('user', 'counter', array('id' => $id));
            if ($count_arr) {
              $result = $this->universal_model->item_edit_save('user', array('id' => $id), array('counter' => ($count_arr->counter + 1)));

              echo $result?'true':'false';
            }
          }
        }
    }
