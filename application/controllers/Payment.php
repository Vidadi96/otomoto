<?php

class Payment extends CI_Controller
{
  private $urlGetPaymentKey    = "https://rest.goldenpay.az/web/service/merchant/getPaymentKey";
  private $urlGetPaymentResult = "https://rest.goldenpay.az/web/service/merchant/getPaymentResult";
  private $urlRedirect         = "https://rest.goldenpay.az/web/paypage?payment_key=";

  function __construct()
  {
    parent::__construct();
    $this->load->model("universal_model");
    $this->load->model('payment_model');
  }

  function getFilteredParam(){
    $param = $this->filter_data($this->input->post());
      $filterList = array(
          'cardType'    => "/^[v|m]$/",
          'amount'      => '/^[0-9.]*$/',
          'item'        => '/^[a-zA-Z0-9]*$/',
          'lang'        => '/^(lv|en|ru)$/',
          'payment_key' => '/^[a-zA-Z0-9\-]*$/'
      );

      if (preg_match('/^[0-9.]*$/',$param['amount']) && preg_match('/^(lv|en|ru)$/',$param['lang']) ){ //preg_match("/^[v|m]$/",$param['cardType']) &&
        return true;
      } else {
        return false;
      }
  }

  public function do_top()
  {
    if ($this->input->post())
    {
      $filtered_post = $this->filter_data($this->input->post());
      if ($this->input->post('payment_type') == 1)
      {
        $carad_id = (int) $filtered_post['carad_id'];
        $action = (int) $filtered_post['action_id'];
        $cardType = 'v';

        if ($action == 1)
          $amount = 1;
        else if ($action == 2)
          $amount = 2;
        else if ($action == 6)
          $amount = 5;
        else if ($action == 7)
          $amount = 10;
        else if ($action == 8)
          $amount = 9;
        else if ($action == 9)
          $amount = 18;
        else if ($action == 10)
          $amount = 15;
        else if ($action == 11)
          $amount = 30;

        $this->do_payment_for_top($amount, $cardType, $action, $carad_id);
      }
      else
      {
        if ($this->session->userdata('uid'))
        {
          $this->load->model('dashboard_model');
          $carad_id = (int) $filtered_post['carad_id'];
          $action = (int) $filtered_post['action_id'];

          if ($action == 1) {
            $action2 = 12;
            $amount = 1;
            $type = 1;
          } else if ($action == 2) {
            $action2 = 13;
            $amount = 2;
            $type = 1;
          } else if ($action == 6) {
            $action2 = 14;
            $amount = 5;
            $type = 5;
          } else if ($action == 7) {
            $action2 = 15;
            $amount = 10;
            $type = 5;
          } else if ($action == 8) {
            $action2 = 16;
            $amount = 9;
            $type = 15;
          } else if ($action == 9) {
            $action2 = 17;
            $amount = 18;
            $type = 15;
          } else if ($action == 10) {
            $action2 = 18;
            $amount = 15;
            $type = 30;
          } else if ($action == 11) {
            $action2 = 19;
            $amount = 30;
            $type = 30;
          }

          $res = $this->payment_model->checkAuthorBalans((int)$this->session->userdata('uid'));
          $plus = (@$res[0]['plus'])?@$res[0]['plus']:0;
          $minus = (@$res[0]['minus'])?@$res[0]['minus']:0;
          $ads = (@$res[0]['ads'])?@$res[0]['ads']:0;

          if(($plus - ($minus + $ads)) > 9)
          {
            $array = array(
              'amount' => $amount,
              'authorid' => $this->session->userdata('uid'),
              'createdate' => date('Y-m-d H:i:s'),
              'action' => $action2,
              'caradid' => $carad_id,
              'active' => 1
            );

            $result = $this->universal_model->add_item($array, 'car_orders');

            if ($action == 1 || $action == 6 || $action == 8 || $action == 10)
            {
              $array2 = array(
                'vip' => 1,
                'vip_type' => $type,
                'vipdate' => date('Y-m-d H:i:s'),
                'vip_update_date' => date('Y-m-d H:i:s')
              );
              $this->universal_model->item_edit_save('carad', array('id' => $carad_id), $array2);
            }
            else
            {
              $array2 = array(
                'premium' => 1,
                'premium_type' => $type,
                'premium_date' => date('Y-m-d H:i:s'),
                'premium_update_date' => date('Y-m-d H:i:s')
              );
              $this->universal_model->item_edit_save('carad', array('id' => $carad_id), $array2);
            }

            if ($result) {
              $this->load->view('/site/tez_header');
              echo "Uğurla əlavə edildi";
              $this->load->view('/site/footer');
            } else {
              $this->load->view('/site/tez_header');
              echo "Xəta baş verdi. Yenidən cəhd edin";
              $this->load->view('/site/footer');
            }
          }
          else
          {
            $this->load->view('/site/tez_header');
            echo "Balansda kifayət qədər vəsait yoxdur. Xaiş olunur balansınızı artırasınız";
            $this->load->view('/site/footer');
          }
        }
        else
          echo 'Əvvəlcə giriş edin';
      }
    }
  }

  public function rent_do_top()
  {
    if ($this->input->post())
    {
      $filtered_post = $this->filter_data($this->input->post());
      if ($this->input->post('payment_type') == 1)
      {
        $carad_id = (int) $filtered_post['carad_id'];
        $action = (int) $filtered_post['action_id'];
        $cardType = 'v';

        if ($action == 1)
          $amount = 1;
        else if ($action == 2)
          $amount = 2;
        else if ($action == 6)
          $amount = 5;
        else if ($action == 7)
          $amount = 10;
        else if ($action == 8)
          $amount = 9;
        else if ($action == 9)
          $amount = 18;
        else if ($action == 10)
          $amount = 15;
        else if ($action == 11)
          $amount = 30;

        $this->do_payment_for_top($amount, $cardType, $action, $carad_id);
      }
      else
      {
        if ($this->session->userdata('uid'))
        {
          $this->load->model('dashboard_model');
          $carad_id = (int) $filtered_post['carad_id'];
          $action = (int) $filtered_post['action_id'];

          if ($action == 1) {
            $action2 = 12;
            $amount = 1;
            $type = 1;
          } else if ($action == 2) {
            $action2 = 13;
            $amount = 2;
            $type = 1;
          } else if ($action == 6) {
            $action2 = 14;
            $amount = 5;
            $type = 5;
          } else if ($action == 7) {
            $action2 = 15;
            $amount = 10;
            $type = 5;
          } else if ($action == 8) {
            $action2 = 16;
            $amount = 9;
            $type = 15;
          } else if ($action == 9) {
            $action2 = 17;
            $amount = 18;
            $type = 15;
          } else if ($action == 10) {
            $action2 = 18;
            $amount = 15;
            $type = 30;
          } else if ($action == 11) {
            $action2 = 19;
            $amount = 30;
            $type = 30;
          }

          $res = $this->payment_model->checkAuthorBalans((int)$this->session->userdata('uid'));
          $plus = (@$res[0]['plus'])?@$res[0]['plus']:0;
          $minus = (@$res[0]['minus'])?@$res[0]['minus']:0;
          $ads = (@$res[0]['ads'])?@$res[0]['ads']:0;

          if(($plus - ($minus + $ads)) > 9)
          {
            $array = array(
              'amount' => $amount,
              'authorid' => $this->session->userdata('uid'),
              'createdate' => date('Y-m-d H:i:s'),
              'action' => $action2,
              'caradid' => $carad_id,
              'active' => 1
            );

            $result = $this->universal_model->add_item($array, 'car_orders');

            if ($action == 1 || $action == 6 || $action == 8 || $action == 10)
            {
              $array2 = array(
                'vip' => 1,
                'vip_type' => $type,
                'vipdate' => date('Y-m-d H:i:s'),
                'vip_update_date' => date('Y-m-d H:i:s')
              );
              $this->universal_model->item_edit_save('rent_car', array('id' => $carad_id), $array2);
            }
            else
            {
              $array2 = array(
                'premium' => 1,
                'premium_type' => $type,
                'premium_date' => date('Y-m-d H:i:s'),
                'premium_update_date' => date('Y-m-d H:i:s')
              );
              $this->universal_model->item_edit_save('rent_car', array('id' => $carad_id), $array2);
            }

            if ($result) {
              $this->load->view('/site/tez_header');
              echo "Uğurla əlavə edildi";
              $this->load->view('/site/footer');
            } else {
              $this->load->view('/site/tez_header');
              echo "Xəta baş verdi. Yenidən cəhd edin";
              $this->load->view('/site/footer');
            }
          }
          else
          {
            $this->load->view('/site/tez_header');
            echo "Balansda kifayət qədər vəsait yoxdur. Xaiş olunur balansınızı artırasınız";
            $this->load->view('/site/footer');
          }
        }
        else
          echo 'Əvvəlcə giriş edin';
      }
    }
  }

  function do_payment_for_top($amount, $cardType, $action, $carad_id)
  {
    $json = $this->getPaymentKeyJSONRequest(((float) $amount)*100, 'lv', $cardType, '');
    if ($json->status->code == 1) {
      $array = array(
        'user_id' => $this->session->userdata('uid')?$this->session->userdata('uid'):$this->session->userdata('tmp_user'),
        'carad_id' => $carad_id,
        'payment_key' => $json->paymentKey,
        'action_id' => $action,
        'amount' => (float) $amount,
        'status_code' => 0, //pending
        'create_date' => date('Y-m-d H:i:s')
      );

      $this->universal_model->add_item($array, 'payment');
      redirect($json->urlRedirect);
    }
    else
      echo "false";
  }

  public function do_payment()
  {
    $posts = $this->filter_data($this->input->post());
    $res = $this->getFilteredParam($posts);
    if($res){
      $json = $this->getPaymentKeyJSONRequest(((float) $posts['amount'])*100, 'lv', 'v', '');
      if ($json->status->code == 1) {

        $array = array(
          'user_id' => $this->session->userdata('uid')?$this->session->userdata('uid'):$this->session->userdata('tmp_user'),
          'carad_id' => $posts['carad_id'],
          'payment_key' => $json->paymentKey,
          'action_id' => $posts['action'],
          'amount' => (float) $posts['amount'],
          'status_code' => 0, //pending
          'create_date' => date('Y-m-d H:i:s')
        );

        $this->universal_model->add_item($array, 'payment');
        redirect($json->urlRedirect);
      } else {
        echo "false";
      }
    } else {
      echo "false";
    }
  }

  function success_response()
  {
    $this->check_payments();
    $this->load->view('/site/tez_header');
    echo 'Ödəmə uğurla tamamlandı';
    $this->load->view('/site/footer');
  }

  public function error_response()
  {
    $this->check_payments();
    $this->load->view('/site/tez_header');
    echo 'Ödəmə zamanı xəta baş verdi';
    $this->load->view('/site/footer');
  }

  function check_payments()
  {
    $payments = $this->universal_model->get_more_item('payment', 'status_code = 0 or status_code = 813 or status_code = 818');
    foreach ($payments as $row)
    {
      $json = $this->getPaymentResult($row->payment_key);
      $this->universal_model->item_edit_save('payment', array('payment_key' => $json->paymentKey), array('status_code' => $json->status->code));

      if ($json->status->code == 1)
      {
        if ($row->action_id == 3)
        {
          $this->payment_model->increaseBalans($row->user_id, $row->amount, date('Y-m-d H:i:s'));
          $currentBalans = $this->payment_model->currentBalans($row->user_id);
          $plus = $currentBalans->plus;
          $minus = $currentBalans->minus;
          $ads = $currentBalans->ads;
          if(($plus-($minus+$ads)) >= 50 ){
            $this->payment_model->updateSalon($row->user_id);
          }
        }
        else if ($row->action_id == 1 && $row->amount >= 1)
        {
          $array = array(
            'amount' => 1,
            'authorid' => $row->user_id,
            'createdate' => date('Y-m-d H:i:s'),
            'action' => 1,
            'caradid' => $row->carad_id,
            'active' => 1
          );
          $array2 = array(
            'vip' => 1,
            'vip_type' => 1,
            'vipdate' => date('Y-m-d H:i:s'),
            'vip_update_date' => date('Y-m-d H:i:s')
          );
          $this->universal_model->add_item($array, 'car_orders');
          $this->universal_model->item_edit_save('carad', array('id' => $row->carad_id), $array2);
        }
        else if ($row->action_id == 2 && $row->amount >= 2)
        {
          $array = array(
            'amount' => 2,
            'authorid' => $row->user_id,
            'createdate' => date('Y-m-d H:i:s'),
            'action' => 2,
            'caradid' => $row->carad_id,
            'active' => 1
          );
          $array2 = array(
            'premium' => 1,
            'premium_type' => 1,
            'premium_date' => date('Y-m-d H:i:s'),
            'premium_update_date' => date('Y-m-d H:i:s')
          );
          $this->universal_model->add_item($array, 'car_orders');
          $this->universal_model->item_edit_save('carad', array('id' => $row->carad_id), $array2);
        }
        else if ($row->action_id == 6 && $row->amount >= 5)
        {
          $array = array(
            'amount' => 5,
            'authorid' => $row->user_id,
            'createdate' => date('Y-m-d H:i:s'),
            'action' => 6,
            'caradid' => $row->carad_id,
            'active' => 1
          );
          $array2 = array(
            'vip' => 1,
            'vip_type' => 5,
            'vipdate' => date('Y-m-d H:i:s'),
            'vip_update_date' => date('Y-m-d H:i:s')
          );
          $this->universal_model->add_item($array, 'car_orders');
          $this->universal_model->item_edit_save('carad', array('id' => $row->carad_id), $array2);
        }
        else if ($row->action_id == 7 && $row->amount >= 10)
        {
          $array = array(
            'amount' => 10,
            'authorid' => $row->user_id,
            'createdate' => date('Y-m-d H:i:s'),
            'action' => 7,
            'caradid' => $row->carad_id,
            'active' => 1
          );
          $array2 = array(
            'premium' => 1,
            'premium_type' => 5,
            'premium_date' => date('Y-m-d H:i:s'),
            'premium_update_date' => date('Y-m-d H:i:s')
          );
          $this->universal_model->add_item($array, 'car_orders');
          $this->universal_model->item_edit_save('carad', array('id' => $row->carad_id), $array2);
        }
        else if ($row->action_id == 8 && $row->amount >= 9)
        {
          $array = array(
            'amount' => 9,
            'authorid' => $row->user_id,
            'createdate' => date('Y-m-d H:i:s'),
            'action' => 8,
            'caradid' => $row->carad_id,
            'active' => 1
          );
          $array2 = array(
            'vip' => 1,
            'vip_type' => 15,
            'vipdate' => date('Y-m-d H:i:s'),
            'vip_update_date' => date('Y-m-d H:i:s')
          );
          $this->universal_model->add_item($array, 'car_orders');
          $this->universal_model->item_edit_save('carad', array('id' => $row->carad_id), $array2);
        }
        else if ($row->action_id == 9 && $row->amount >= 18)
        {
          $array = array(
            'amount' => 18,
            'authorid' => $row->user_id,
            'createdate' => date('Y-m-d H:i:s'),
            'action' => 9,
            'caradid' => $row->carad_id,
            'active' => 1
          );
          $array2 = array(
            'premium' => 1,
            'premium_type' => 15,
            'premium_date' => date('Y-m-d H:i:s'),
            'premium_update_date' => date('Y-m-d H:i:s')
          );
          $this->universal_model->add_item($array, 'car_orders');
          $this->universal_model->item_edit_save('carad', array('id' => $row->carad_id), $array2);
        }
        else if ($row->action_id == 10 && $row->amount >= 15)
        {
          $array = array(
            'amount' => 15,
            'authorid' => $row->user_id,
            'createdate' => date('Y-m-d H:i:s'),
            'action' => 10,
            'caradid' => $row->carad_id,
            'active' => 1
          );
          $array2 = array(
            'vip' => 1,
            'vip_type' => 30,
            'vipdate' => date('Y-m-d H:i:s'),
            'vip_update_date' => date('Y-m-d H:i:s')
          );
          $this->universal_model->add_item($array, 'car_orders');
          $this->universal_model->item_edit_save('carad', array('id' => $row->carad_id), $array2);
        }
        else if ($row->action_id == 11 && $row->amount >= 30)
        {
          $array = array(
            'amount' => 30,
            'authorid' => $row->user_id,
            'createdate' => date('Y-m-d H:i:s'),
            'action' => 11,
            'caradid' => $row->carad_id,
            'active' => 1
          );
          $array2 = array(
            'premium' => 1,
            'premium_type' => 30,
            'premium_date' => date('Y-m-d H:i:s'),
            'premium_update_date' => date('Y-m-d H:i:s')
          );
          $this->universal_model->add_item($array, 'car_orders');
          $this->universal_model->item_edit_save('carad', array('id' => $row->carad_id), $array2);
        }
      }
    }
  }

  function getPaymentKeyJSONRequest($amount=100, $lang='lv', $cardType='v', $description='') {
        $urlGetPaymentKey    = "https://rest.goldenpay.az/web/service/merchant/getPaymentKey";
        $urlGetPaymentResult = "https://rest.goldenpay.az/web/service/merchant/getPaymentResult";
        $urlRedirect         = "https://rest.goldenpay.az/web/paypage?payment_key=";

        $authKey      = "c3634a5bc47b4c7f8dfd3bc09a798195";//$this->create_key();
        $merchantName = "otomoto";
        $params = array(
            'merchantName' => $merchantName,
            'cardType' => $cardType,
            'amount' => $amount,
            'description' => $description
        );
        $params['hashCode'] = $this->getHashcCode($params, $authKey);

        $params['lang'] = $lang;
        $request = json_encode($params);

        $json = json_decode($this->getJsonContent($urlGetPaymentKey, $request));
        $json->urlRedirect =($urlRedirect).($json->paymentKey);
        return $json;
    }

    function getJsonContent($url, $content) {
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\nAccept: application/json\r\n",
                'method'  => 'POST',
                'content' => $content
            ),
        );
        $context = stream_context_create($options);
        // print_r($content);
        return file_get_contents($url, false, $context);
    }

    function getPaymentResult($payment_key) {
        $params = array(
            'payment_key' => $payment_key
        );
        $params['hash_code'] = $this->getHashcCode($params, 'c3634a5bc47b4c7f8dfd3bc09a798195');

        $options = array(
            'http' => array(
                'header'  => "Accept: application/json\r\n",
                'method'  => 'GET'
            )
        );

        $context = stream_context_create($options);
        $json = file_get_contents($this->urlGetPaymentResult."?".http_build_query($params), false, $context);

        return json_decode($json);
    }

    function getParamsClone() {
       return array_merge(array(), $params);
    }

    function getHashcCode($params,$authKey) {
        return md5($authKey.implode($params));
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
}
