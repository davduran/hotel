<?php

namespace ByHours\HotelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Room
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
     * @ORM\Column(name="price_per_night", type="float")
     */
    protected $pricePerNight;

    /**
     * @ORM\ManyToOne(targetEntity="ByHours\HotelBundle\Entity\Hotel", inversedBy="rooms")
     */
    protected $hotel;

    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="room", cascade={"persist", "remove"})
     */
    protected $bookings;

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
     * @return float
     */
    public function getPricePerNight()
    {
        return $this->pricePerNight;
    }

    /**
     * @param float $pricePerNight
     *
     * @return $this
     */
    public function setPricePerNight($pricePerNight)
    {
        $this->pricePerNight = $pricePerNight;

        return $this;
    }


    /**
     * @return Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * @param Hotel $hotel
     *
     * @return $this
     */
    public function setHotel(Hotel $hotel)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @param Booking $booking
     *
     * @return $this
     */
    public function addRoom(Booking $booking)
    {
        $this->rooms[] = $booking;
        $booking->setRoom($this);

        return $this;
    }
}
