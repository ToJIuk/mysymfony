<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="pages")
 */
class Pages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @return mixed
     * @ORM\Column(type="string", nullable=true)
     */
    private $someText;

    /**
     * @ORM\Column(type="integer")
     */
    private $old;

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSomeText()
    {
        return $this->someText;
    }

    /**
     * @param mixed $someText
     */
    public function setSomeText($someText)
    {
        $this->someText = $someText;
    }

    /**
     * @return mixed
     */
    public function getOld()
    {
        return $this->old;
    }

    /**
     * @param mixed $old
     */
    public function setOld($old)
    {
        $this->old = $old;
    }
    public function getUpdatedAt()
    {
        return new \DateTime('-'.rand(0, 100).' days');
    }

}