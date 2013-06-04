<?php

require_once('lib/bootstrap.php');

class EmailTest extends PHPUnit_Framework_TestCase {

  public function testEmail() {

    return true;

    c::set('email.services', array(
      'postmark' => array(
        'service' => 'postmark',
        'key'     => 'non existing key',
        'test'    => true
      )
    ));

    $email = new Email('postmark');

    $email->to      = 'bastian@getkirby.com';
    $email->from    = 'bastian@getkirby.com';
    $email->replyTo = 'bastian@getkirby.com';
    $email->subject = 'This is a test';
    $email->body    = 'This is the test body';

    $email->send();

    $result = json_decode($email->response()->content());

    $this->assertTrue($email->passed());
    $this->assertEquals(0, $result->ErrorCode);

  }
  
}