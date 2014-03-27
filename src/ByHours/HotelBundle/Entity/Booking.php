<?php


namespace ByHours\HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(
 *  indexes={
 *      @ORM\Index(name="IDX_search_reservation_date", columns={"reservation_date"}),
 *  }
 * )
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $arrival;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $departure;

    /**
     * @ORM\Column(name="number_of_rooms", type="integer")
     */
    protected $numberOfRooms;

    /**
     * @ORM\Column(name="reservation_date", type="datetime")
     */
    protected $reservationDate;

    /**
     * @ORM\ManyToOne(targetEntity="ByHours\HotelBundle\Entity\Room", inversedBy="bookings")
     */
    protected $room;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @param DateTime $arrival
     *
     * @return $this
     */
    public function setArrival(DateTime $arrival)
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param DateTime $departure
     *
     * @return $this
     */
    public function setDeparture(DateTime $departure)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberOfRooms()
    {
        return $this->numberOfRooms;
    }

    /**
     * @param int $numberOfRooms
     *
     * @return $this
     */
    public function setNumberOfRooms($numberOfRooms)
    {
        $this->numberOfRooms = $numberOfRooms;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReservationDate()
    {
        return $this->reservationDate;
    }

    /**
     * @param DateTime $reservationDate
     *
     * @return $this
     */
    public function setReservationDate(DateTime $reservationDate)
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    /**
     * @return Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param mixed $room
     *
     * @return $this
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;

        return $this;
    }
}
