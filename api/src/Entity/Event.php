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
 * Event entity.
 *
 * @ApiFilter(DateFilter::class, properties={"date"})
 * @ApiFilter(OrderFilter::class, properties={"date"})
 * @ApiFilter(SearchFilter::class, properties={"concert.id": "exact"})
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity
 */
class Event
{
    /**
     * @var UuidInterface The id of the event
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private UuidInterface $id;

    /**
     * @var string The title of the event
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="Interview vooraf & Entrée Cafe"})
     */
    public string $title;

    /**
     * @var string The introduction of the event in HTML format
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="<p>Kom voorafgaand aan het concert naar het interview met Herman Rieken en na het concert naar Entrée Café</p>"})
     */
    public string $introduction;

    /**
     * @var string The body of the event in HTML format
     *
     * @ORM\Column(type="text")
     *
     * @ApiProperty(openapiContext={"example"="<p>Inloop 19.45, start interview 20.00.</p>"})
     */
    public string $body;

    /**
     * @var DateTimeInterface The date of the event
     *
     * @ORM\Column(type="datetime")
     *
     * @ApiProperty(openapiContext={"example"="2020-08-13"})
     */
    public DateTimeInterface $date;

    /**
     * @var string The image of the event
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="https://www.jouwentree.nl/media/junior/7418.jpeg"})
     */
    public string $image;

    /**
     * @var string The Entrée URL
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="http://www.jouwentree.nl/instrumententuin"})
     */
    public string $url;

    /**
     * @var Concert|null The concert related to the event
     *
     * @ORM\ManyToOne(targetEntity="Concert")
     */
    public ?Concert $concert;

    /**
     * @var UuidInterface|null The id of the concert
     *
     */
    public ?UuidInterface $concertId;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return UuidInterface|null
     */
    public function getConcertId(): ?UuidInterface
    {
        if ($this->concert === null) {
            return null;
        }

        return $this->concert->getId();
    }
}
