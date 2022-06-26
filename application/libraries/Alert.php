<?php

class Alert
{
  public function __construct()
  {
    $this->CI = &get_instance();
    $this->CI->load->library('session');
  }

  function SetAlert($typeAlert, $message, $url = null)
  {
    $this->CI = &get_instance();
    if ($typeAlert == 'success') {
      $this->CI->session->set_flashdata([
        'flash' => 'success',
        'message' => $message
      ]);
      if ($url) {
        redirect($url);
      } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    } else if ($typeAlert == 'error') {
      $this->CI->session->set_flashdata([
        'flash' => 'error',
        'message' => $message
      ]);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else if ($typeAlert == 'success_order') {
      $this->CI->session->set_flashdata([
        'flash' => 'success_order',
        'message' => $message
      ]);
      if ($url) {
        redirect($url);
      } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
}
