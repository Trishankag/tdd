<?php
require_once('simpletest/autorun.php');
require_once('simpletest/web_tester.php');


class SimpleFormTests extends WebTestCase {

  function testDoesContactPageExist() {
    $this->get('http://localhost/unittesting/contact.php');
    $this->assertResponse(200); 
  }
  
  
  function testIsProperFormSubmissionSuccessful() {
  $this->get('http://localhost/unittesting/contact.php');
  $this->assertResponse(200);

  $this->setField("first_name", "Jason");
  $this->setField("email", "wj@example.com");
  $this->setField("comments", "I look forward to hearing from you!");

  $this->clickSubmit("Submit");

  $this->assertResponse(200);
  $this->assertText("We will be in touch within 24 hours.");

}




function testInvalidEmailAddress() {
  $this->get('http://localhost/unittesting/contact.php');
  $this->assertResponse(200);

  $this->setField("first_name", "Jason");
  $this->setField("email", "wjexample.com");
  $this->setField("comments", "I look forward to hearing from you!");

  $this->clickSubmit("Submit");

  $this->assertResponse(200);
  $this->assertText("Please provide a valid email address.");
}

function testInvalidName() {
  $this->get('http://localhost/unittesting/contact.php');
  $this->assertResponse(200);

  $this->setField("first_name", "");
  $this->setField("email", "wj@example.com");
  $this->setField("comments", "I look forward to hearing from you!");

  $this->clickSubmit("Submit");

  $this->assertResponse(200);
  $this->assertText("Please provide your name.");
}
}

?>