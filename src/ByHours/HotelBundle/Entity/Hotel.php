<?php


namespace ByHours\HotelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ByHours\HotelBundle\Util\Util;

/**
 * @ORM\Entity(repositoryClass="ByHours\HotelBundle\Entity\HotelRepository")
 */
class Hotel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $slug;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="hotel", cascade={"persist", "remove"})
     */
    protected $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->slug = Util::getSlug($name);

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $slug
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return ArrayCollection
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param Room $room
     *
     * @return $this
     */
    public function addRoom(Room $room)
    {
        $this->rooms[] = $room;
        $room->setHotel($this);

        return $this;
    }
}
