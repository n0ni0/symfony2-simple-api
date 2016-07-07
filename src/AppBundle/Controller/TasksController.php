<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;


class TasksController extends FOSRestController
{
    /**
     * Gets an task by id
     *
     * @param Task $id
     * @return mixed
     * @ApiDoc(
     *     output="AppBundle\Entity\Task",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found task"
     *     }
     * )
     * @Get("singleTask/{id}")
     */
    public function getSingleTaskAction(Task $id)
    {
        return $this->getDoctrine()->getRepository('AppBundle:Task')->find($id);
    }
}