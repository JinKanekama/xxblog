<?php
// Controller/TwitterController.php
App::import('Vendor', 'OAuth/OAuthClient');

class TwitterController extends AppController {
  public $components = array(
    'Session',
  );
  
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'callback', 'createClient');
  }

  public function index() {
    $client = $this->createClient();
    $requestToken = $client->getRequestToken('https://api.twitter.com/oauth/request_token', 'http://' . $_SERVER['HTTP_HOST'] . '/twitter/callback');

    if ($requestToken) {
      $this->Session->write('twitter_request_token', $requestToken);
      $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
    } else {
      // an error occured when obtaining a request token
    }
  }

  public function callback() {
    $requestToken = $this->Session->read('twitter_request_token');
    $client = $this->createClient();
    $accessToken = $client->getAccessToken('https://api.twitter.com/oauth/access_token', $requestToken);

    if ($accessToken) {
      $client->post($accessToken->key, $accessToken->secret, 'https://api.twitter.com/1.1/statuses/update.json', array('status' => 'hello world!'));
    }
    exit;
  }

  private function createClient() {
    return new OAuthClient('zv42kZ3sL0C6jmEddVZf0MXMQ', '7bx0kfVjgVjvpqnOnqAXk4KmXyAUW0cQpUUTVM6MSdetRG0mT0');
  }
}