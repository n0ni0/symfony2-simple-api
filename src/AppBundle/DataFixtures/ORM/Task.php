<?php
/**
 * Created by PhpStorm.
 * User: Antonio
 * Date: 11/07/16
 * Time: 21:46
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class Tasks extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $task = new Task();
            $task->setTitle($this->getTitle());
            $task->setDescription($this->getDescription());

            $manager->persist($task);
        }
        $manager->flush();
    }

    private function getTitle()
    {
        $title = array(
            'Lorem',
            'Ipsum',
            'Dolor',
            'Sit',
            'Amet',
        );

        return $title[array_rand($title)];
    }

    private function getDescription()
    {
        $description = array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'Pellentesque vitae velit ex.',
            'Mauris dapibus, risus quis suscipit vulputate, eros diam egestas libero, eu vulputate eros eros eu risus.',
            'In hac habitasse platea dictumst.',
            'Morbi tempus commodo mattis.',
        );

        return $description[array_rand($description)];
    }
}
