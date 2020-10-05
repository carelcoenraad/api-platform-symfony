<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * Ticket entity.
 *
 * @ApiFilter(DateFilter::class, properties={"event.date"})
 * @ApiFilter(OrderFilter::class, properties={"event.date","row","seatNumber"})
 * @ApiFilter(SearchFilter::class, properties={"event.id": "exact"})
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity
 */
class Ticket
{
    /**
     * @var UuidInterface The id of the ticket
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private UuidInterface $id;

    /**
     * @var string The room name of the ticket
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="Grote zaal"})
     */
    public string $roomName;

    /**
     * @var string The row of the ticket
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="C"})
     */
    public string $row;

    /**
     * @var string The seat number of the ticket
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="171"})
     */
    public string $seatNumber;

    /**
     * @var string The area name of the ticket
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="Balkon (boven)"})
     */
    public string $areaName;

    /**
     * @var string The price level of the ticket
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="Rang 1"})
     */
    public string $priceLevel;

    /**
     * @var string The barcode of the ticket
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="1234567890123"})
     */
    public string $barcode;

    /**
     * @var ConcertgebouwEvent The related event to the ticket
     *
     * @ORM\ManyToOne(targetEntity="ConcertgebouwEvent")
     */
    public ConcertgebouwEvent $event;

    /**
     * @var UuidInterface The id of the event
     *
     */
    public UuidInterface $eventId;

    /**
     * @var DateTimeInterface The date of the event
     */
    public DateTimeInterface $eventDate;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getEventId(): int
    {
        return $this->event->getId();
    }

    /**
     * @return DateTimeInterface
     */
    public function getEventDate(): DateTimeInterface
    {
        return $this->event->getDate();
    }
}
