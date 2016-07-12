<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @package AppBundle\Controller
 *
 * @RouteResource("tasks")
 */
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
     */
    public function getAction(Task $id)
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
     */
    public function cgetAction()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Task')->findAll();
    }

    /**
     * Create new task
     *
     * @var Request $request
     * @return array
     *
     * @ApiDoc(
     *     output="AppBundle\Entity\Task",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Returned when the form has errors"
     *     }
     * )
     */
    public function postAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
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


    /**
     * Edit all task fields
     * @param Request $request
     * @param Task $id
     * @return array
     *
     * @ApiDoc(
     *     input="AppBundle\Form\Type\TaskType",
     *     output ="AppBundle\Entity\Task",
     *     statusCodes={
     *         200 = "Returned when updated",
     *         400 = "Return when errors",
     *         404 = "Return when not found"
     *     }
     * )
     *
     */
    public function putAction(Request $request, Task $id)
    {
        $task = $this->getDoctrine()->getRepository('AppBundle:Task')->find($id);
        $form = $this->createForm(TaskType::class, $task);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return array("task" => $task);
    }

    /**
     * Edit one task field
     * @param Request $request
     * @param Task $id
     * @return array
     *
     * @ApiDoc(
     *     input="AppBundle\Form\Type\TaskType",
     *     output ="AppBundle\Entity\Task",
     *     statusCodes={
     *         200 = "Returned when updated",
     *         400 = "Return when errors",
     *         404 = "Return when not found"
     *     }
     * )
     *
     */
    public function patchAction(Request $request, Task $id)
    {
        $task = $this->getDoctrine()->getRepository('AppBundle:Task')->find($id);
        $form = $this->createForm(TaskType::class, $task);
        $form->submit($request->request->all(), false);

        if (!$form->isValid()) {
            return $form;
        }
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return array("task" => $task);
    }

    /**
     * Removes a task
     *
     * @param Task $id Task id
     * @return view
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful",
     *     404 = "Returned when the task not found"
     *   }
     * )
     *
     */
    public function deleteAction(Task $id)
    {
        $task =  $this->getDoctrine()->getRepository('AppBundle:Task')->find($id);

        if ($task === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return new View(null, Response::HTTP_ACCEPTED);
    }
}