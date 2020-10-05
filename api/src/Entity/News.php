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
 * News entity.
 *
 * @ApiFilter(DateFilter::class, properties={"date"})
 * @ApiFilter(OrderFilter::class, properties={"date"})
 * @ApiFilter(SearchFilter::class, properties={"concert.id": "exact", "event.id": "exact"})
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity
 */
class News
{
    /**
     * @var UuidInterface The id of the news
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private UuidInterface $id;

    /**
     * @var string The title of the news
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="Wandeling Herman"})
     */
    public string $title;

    /**
     * @var string The introduction of the news in HTML format
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="<p>Ons eerste niet digitale event</p>"})
     */
    public string $introduction;

    /**
     * @var string The body of the news in HTML format
     *
     * @ORM\Column(type="text")
     *
     * @ApiProperty(openapiContext={"example"="<p>Kom wandelen met Herman door de Concertgebouwbuurt!</p>"})
     */
    public string $body;

    /**
     * @var DateTimeInterface The date of the news
     *
     * @ORM\Column(type="datetime")
     *
     * @ApiProperty(openapiContext={"example"="2020-07-28"})
     */
    public DateTimeInterface $date;

    /**
     * @var string The image of the news
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="https://www.jouwentree.nl/media/76194946_3122439777830185_8844943258678198272_o2.jpg"})
     */
    public string $image;

    /**
     * @var string The Entrée URL
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="http://www.jouwentree.nl/wandeling-herman"})
     */
    public string $url;

    /**
     * @var Concert|null The concert related to the news
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
     * @var Event|null The event related to the news
     *
     * @ORM\ManyToOne(targetEntity="Event")
     */
    public ?Event $event;

    /**
     * @var UuidInterface|null The id of the event
     *
     */
    public ?UuidInterface $eventId;

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

    /**
     * @return UuidInterface|null
     */
    public function getEventId(): ?UuidInterface
    {
        if ($this->event === null) {
            return null;
        }

        return $this->event->getId();
    }
}
