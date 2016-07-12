<?php

namespace AppBundle\Tests\Controller;


use AppBundle\Tests\Fixtures\AbstractTestCase;


class TaskControllerTest extends AbstractTestCase
{
    public function testGetAllTasks()
    {
        $crawler = $this->client->request('GET', '/tasks');

        $this->assertJsonResponse($this->client->getResponse(), 200);
    }

    public function testGetOneTask()
    {
        $crawler = $this->client->request('GET', '/tasks/4');

        $this->assertJsonResponse($this->client->getResponse(), 200);
    }

    public function testCreateTask()
    {
        $crawler = $this->client->request('POST', '/tasks',[
            'title'=>'test task',
            'description' =>'test description'
        ]);

        $this->assertJsonResponse($this->client->getResponse(),200);
    }

    public function testCreateTaskWithErrors()
    {
        $crawler = $this->client->request('POST', '/tasks',[
            'title'=>'test task',
            'xxx'  =>'test description'
        ]);

        $this->assertJsonResponse($this->client->getResponse(),400);
    }

    public function testPutTask()
    {
        $crawler = $this->client->request('PUT', '/tasks/1',[
            'title'=>'test task2',
            'description' =>'test description2'
        ]);

        $this->assertJsonResponse($this->client->getResponse(),200);
    }

    public function testPutTaskThatNotExist()
    {
        $crawler = $this->client->request('PUT', '/tasks/100',[
            'title'=>'test task',
            'description' =>'test description'
        ]);

        $this->assertJsonResponse($this->client->getResponse(),404);
    }

    public function testPutTaskWithErrors()
    {
        $crawler = $this->client->request('PUT', '/tasks/1',[
            'title'=>'test task',
            'xxx'  =>'test description'
        ]);

        $this->assertJsonResponse($this->client->getResponse(),400);
    }
    
    public function testPatchTask()
    {
        $crawler = $this->client->request('PATCH', 'tasks/1',[
            'title' => 'test task 3'
        ]);

        $this->assertJsonResponse($this->client->getResponse(), 200);
    }

    public function testPatchTaskThatNotExist()
    {
        $crawler = $this->client->request('PATCH', 'tasks/100',[
            'title' => 'test task 3'
        ]);

        $this->assertJsonResponse($this->client->getResponse(), 404);
    }

    public function testPatchTaskWithErrors()
    {
        $crawler = $this->client->request('PATCH', 'tasks/1',[
            'xxx' => 'test task 3'
        ]);

        $this->assertJsonResponse($this->client->getResponse(), 400);
    }

    public function testDeleteTask()
    {
        $crawler = $this->client->request('DELETE', '/tasks/1');

        $this->assertJsonResponse($this->client->getResponse(),202);
    }

    public function testDeleteTaskThatNotExist()
    {
        $crawler = $this->client->request('DELETE', '/task/100');

        $this->assertJsonResponse($this->client->getResponse(), 404);
    }


    public function testDeleteNullTask()
    {
        $crawler = $this->client->request('DELETE', '/task/');

        $this->assertJsonResponse($this->client->getResponse(), 404);
    }

    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode,
            $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }
}