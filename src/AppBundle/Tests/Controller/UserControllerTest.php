<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    public function testShowUsers(){
        $client = static::createClient();
        //$this->assertTrue($client->getResponse()->isSuccessful());

        $crawler = $client->request('GET', '/user/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /user/");
    }

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/user/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /user/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());


        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
                'appbundle_user[firstname]'  => 'newFirstname',
                'appbundle_user[lastname]'  => 'newLastname',
                'appbundle_user[username]'  => 'newUsername',
                'appbundle_user[password]'  => 'newPassword', //dynamic password causing problems
                'appbundle_user[email]'  => 'new@gmail.com',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("newFirstname")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
                'appbundle_user[firstname]'  => 'updateFirstname',
                'appbundle_user[lastname]'  => 'updateLastname',
                'appbundle_user[username]'  => 'updateUsername',
                'appbundle_user[password]'  => 'updatePassword',
                'appbundle_user[email]'  => 'update@gmail.com',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="updateFirstname"]')->count(), 'Missing element [value="updateFirstname"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/updateFirstname/', $client->getResponse()->getContent());

    }


}
