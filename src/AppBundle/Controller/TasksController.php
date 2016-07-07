<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;


class TasksController extends FOSRestController
{
    /**
     * Gets an task by id
     *
     * @param Task $id Task id
     * @return mixed
     * @ApiDoc(
     *     output="AppBundle\Entity\Task",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     * @Get("tasks/{id}")
     */
    public function getSingleTaskAction(Task $id)
    {
        return $this->getDoctrine()->getRepository('AppBundle:Task')->find($id);
    }

    /**
     * Gets all tasks
     * @return Task
     * @ApiDoc(
     *     output="AppBundle\Entity\Task",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     * @Get("tasks/")
     */
    public function getTaskAction()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Task')->findAll();
    }

    /**
     * Create new task
     * @var Request $request
     * @return array
     * @ApiDoc(
     *     output="AppBundle\Entity\Task",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Returned when the form has errors"
     *     }
     * )
     * @Post("tasks/")
     */
    public function postAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(new TaskType(), $task);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return array("task" => $task);
        }
        return array(
            'form' => $form,
        );
    }
}