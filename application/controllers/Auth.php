<?php
    class Auth extends CI_Controller
    {
      function __construct()
    	{
    		parent::__construct();
    		$this->load->model("auth_model");
        $this->load->model("universal_model");
    	}

      function logout()
      {
        unset($_SESSION);
        session_destroy();
        redirect("/");
      }

      public function login()
      {
        if($this->session->userdata('login_attempt') && $this->session->userdata('login_attempt') > 2)
        {
          $form_response = $this->input->post('g-recaptcha-response');
          $url = 'https://www.google.com/recaptcha/api/siteverify';
          $secret = 'xxxx';
          $response = file_get_contents($url."?secret=".$secret."&response=".$form_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
          $data = json_decode($response);

          $res = (isset($data->success) && $data->success=="true")?true:false;
        } else {
          $res = true;
        }

        $user = [];

        if($res)
        {
          $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
          $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
          if($this->form_validation->run() == TRUE)
          {
            $filteredPostData = $this->filter_data($this->input->post());

            $user = $this->auth_model->login_check($filteredPostData['email'], md5($filteredPostData['password']));

            if($user)
            {
              if($user->status == 1)
              {
                $this->session->set_flashdata("success", "Hesaba uğurla daxil olundu");

                $_SESSION['uid'] = $user->id;
                $_SESSION['ad'] = $user->first_name;
                $_SESSION['soyad'] = $user->last_name;
                $_SESSION['email'] = $user->email;
                $_SESSION['mobile'] = $user->mobile;
                $_SESSION['autosalon'] = $user->autosalon;
              } else if ($user->status == 0) {
                $_SESSION['login_attempt'] = ($this->session->userdata('login_attempt'))?((int)$_SESSION['login_attempt'] + 1):1;
                $this->session->set_flashdata("error", "Sizin hesabınız təsdiq gözləyir");
              } else {
                $_SESSION['login_attempt'] = ($this->session->userdata('login_attempt'))?((int)$_SESSION['login_attempt'] + 1):1;
                $this->session->set_flashdata("error", "Sizin hesabınız admin tərəfindən silinib");
              }
            }
            else{
              $_SESSION['login_attempt'] = ($this->session->userdata('login_attempt'))?((int)$_SESSION['login_attempt'] + 1):1;
              $this->session->set_flashdata("error", "Belə hesab mövcud deyil");
            }
          }
          else {
            $_SESSION['login_attempt'] = ($this->session->userdata('login_attempt'))?((int)$_SESSION['login_attempt'] + 1):1;
            $this->session->set_flashdata("error", validation_errors());
          }
        }
        else
          $this->session->set_flashdata("error", "Check a captcha");

        redirect("/");
      }

      public function registration()
      {
        // $form_response = $this->input->post('g-recaptcha-response');
        // $url = 'https://www.google.com/recaptcha/api/siteverify';
        // $secret = 'xxx';
        // $response = file_get_contents($url."?secret=".$secret."&response=".$form_response."&remoteip=".$_SERVER['REMOTE_ADDR']);
        // $data = json_decode($response);
        // if(isset($data->success) && $data->success=="true")
        // {
          $this->form_validation->set_rules('mail', 'Email', 'required|valid_email|is_unique[user.email]');

          if($this->form_validation->run() == TRUE)
          {
            $filteredPostData = $this->filter_data($this->input->post());

            $array = array(
              'first_name' => $filteredPostData['full_name'],
              'email' => $filteredPostData['mail'],
              'mobile' => $filteredPostData['phone'],
              'password' => md5($filteredPostData['password2']),
              'status' => 1,
              'tarix' => date("Y-m-d H:i:s"),
              'reg_type' => 'new.otomoto.az'
            );
            $result = $this->universal_model->add_item($array, 'user');

            if($result)
              $this->session->set_flashdata("success", "Qeydiyyatdan uğurla keçildi");
            else
              $this->session->set_flashdata("error", 'Xəta baş verdi');
          }
          else
            $this->session->set_flashdata("error", validation_errors());
        // }
        // else
        //   $this->session->set_flashdata("error", "Check a captcha!");

        redirect("/");
      }

      function filter_data($array)
    	{
    		$data = array();
    		foreach ($array as $key => $value) {
    			if(is_array($value))
    				$data[$key] = $value;
    			else
    				$data[$key] = filter_var(str_replace(array("'", '"',"`", ')', '('), array("","","","",""), $this->security->xss_clean(strip_tags(rawurldecode($value)))), FILTER_SANITIZE_STRING);
    		}
    		return $data;
    	}

      function generate_pin()
      {
        $this->load->helper('string');
        $val = random_string('alnum', 7);
        $check = false;

        $array = $this->universal_model->select_result('user', 'pin_code');
        foreach ($array as $row)
        {
          if ($row->pin_code == $val)
            $check = true;
        }

        if ($check)
          $this->generate_pin();
        else
          return $val;
      }
    }
