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
 * Concert entity.
 *
 * @ApiFilter(DateFilter::class, properties={"date", "startDate", "endDate"})
 * @ApiFilter(OrderFilter::class, properties={"date", "startDate", "endDate"})
 * @ApiFilter(SearchFilter::class, properties={"isSprintable": "exact", "concertgebouwEventId": "exact"})
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity
 */
class Concert
{
    /**
     * @var UuidInterface The id of the concert
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private UuidInterface $id;

    /**
     * @var string The title of the concert. "title" in CG API.
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="Star Wars: Return of the Jedi - Live in Concert"})
     */
    public string $title;

    /**
     * @var string The subtitle of the concert
     *
     * @ORM\Column(type="text")
     *
     * @ApiProperty(openapiContext={"example"="Begin je zondag heerlijk ontspannen"})
     */
    public string $subtitle;

    /**
     * @var string The introduction of the concert in HTML format
     *
     * @ORM\Column(type="text")
     */
    public string $introduction;

    /**
     * @var string The body of the concert in HTML format. "production_intro" in CG API.
     *
     * @ORM\Column(type="text")
     *
     * @ApiProperty(openapiContext={"example"="<strong>Star Wars: Live in Het Concertgebouw</strong>"})
     */
    public string $body;

    /**
     * @var string The image of the concert
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="https://www.jouwentree.nl/media/events/starwars-tomekdersuaaron-1903x660-1.jpg"})
     */
    public string $image;

    /**
     * @var DateTimeInterface The date of the concert. "event_date" in CG API.
     *
     * @ORM\Column(type="datetime")
     *
     * @ApiProperty(openapiContext={"example"="2020-10-03"})
     */
    public DateTimeInterface $date;

    /**
     * @var DateTimeInterface The start date of the concert. "event_start_date" in CG API.
     *
     * @ORM\Column(type="datetime")
     */
    public DateTimeInterface $startDate;

    /**
     * @var DateTimeInterface The end date of the concert. "event_end_date" in CG API.
     *
     * @ORM\Column(type="datetime")
     */
    public DateTimeInterface $endDate;

    /**
     * @var array|null List of genres of the concert. "tag_genre" in CG API.
     *
     * @ORM\Column(nullable=true, type="array")
     *
     * @ApiProperty(openapiContext={"example"="['Overig', 'Orkest']"})
     */
    public ?array $genres;

    /**
     * @var array|null List of instruments of the concert. "tag_instrument" in CG API.
     *
     * @ORM\Column(nullable=true, type="array")
     *
     * @ApiProperty(openapiContext={"example"="['Cello', 'Piano']"})
     */
    public ?array $instruments;

    /**
     * @var array|null List of composers of the concert. "tag_composer" in CG API.
     *
     * @ORM\Column(nullable=true, type="array")
     *
     * @ApiProperty(openapiContext={"example"="['Rachmaninoff', 'Bach']"})
     */
    public ?array $composers;

    /**
     * @var array|null List of musicians of the concert. "programme_musicians" in CG API.
     *
     * @ORM\Column(nullable=true, type="array")
     *
     * @ApiProperty(openapiContext={"example"="[{name: 'Krystian Zimerman', role: 'Piano'}]"})
     */
    public ?array $musicians;

    /**
     * @var array|null List of works of the concerts. "programme_works" in CG API.
     *
     * @ORM\Column(nullable=true, type="array")
     *
     * @ApiProperty(openapiContext={"example"="[{name: 'Pianoconcert nr. 1 in C, op. 15', composer: 'Beethoven'}]"})
     */
    public ?array $works;

    /**
     * @var string The room of the concert. "tag_room" in CG API.
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="Grote Zaal"})
     */
    public string $room;

    /**
     * @var string The Entrée URL.
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="https://www.jouwentree.nl/agenda/concert/kleuter-sinfonietta-wie-zet-s-nachts-de-sterren-aan-4-5-jaar-04-10-2020-4"})
     */
    public string $url;

    /**
     * @var string The Concertgebouw URL. "url" in CG API.
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="https://www.concertgebouw.nl/concerten/kleutersinfonietta-wie-zet-s-nachts-de-sterren-aan-4-5-jaar/04-10-2020-3"})
     */
    public string $concertgebouwUrl;

    /**
     * @var string The Preludium URL
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="https://www.preludium.nl/kristian-zimerman-speelt-beethovens-pianoconcerten"})
     */
    public string $preludiumUrl;

    /**
     * @var string The Spotify URL
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="https://open.spotify.com/playlist/4FAbugZpzOUTjG8RlFcNYr"})
     */
    public string $spotifyUrl;

    /**
     * @var string The URL for buying tickets. "saleflow_url" in CG API.
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="https://www.concertgebouw.nl/x/111947/entree-saleflow"})
     */
    public string $saleflowUrl;

    /**
     * @var string Code for the availability of the concert. "availability_code" in CG API.
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="sold_out"})
     */
    public string $availabilityCode;

    /**
     * @var string The price level of the concert
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="Rang 1"})
     */
    public string $priceLevel;

    /**
     * @var string The normal price of the concert
     *
     * @ORM\Column(type="string")
     *
     * @ApiProperty(openapiContext={"example"="€100"})
     */
    public string $priceNormal;

    /**
     * @var object|null The tickets for 0-25 range
     *
     * @ORM\Column(nullable=true, type="object")
     *
     * @ApiProperty(openapiContext={"example"="{availability: 5, price: '€25'}"})
     */
    public ?object $tickets_0_25;

    /**
     * @var object|null The tickets for 26-30 range
     *
     * @ORM\Column(nullable=true, type="object")
     *
     * @ApiProperty(openapiContext={"example"="{availability: 3, price: '€50'}"})
     */
    public ?object $tickets_26_30;

    /**
     * @var object|null The tickets for 31-35 range
     *
     * @ORM\Column(nullable=true, type="object")
     *
     * @ApiProperty(openapiContext={"example"="{availability: 1, price: '€75'}"})
     */
    public ?object $tickets_31_35;

    /**
     * @var bool Flag to indicate whether concert can be sprinted
     *
     * @ORM\Column(type="boolean")
     */
    public bool $isSprintable = false;

    /**
     * @var Event|null The event related to the concert
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
     * @var int The Concertgebouw event id
     *
     * @ORM\Column(type="integer")
     */
    public int $concertgebouwEventId;

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
     * @return DateTimeInterface
     */
    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getEndDate(): DateTimeInterface
    {
        return $this->endDate;
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

    /**
     * @return int
     */
    public function getConcertgebouwEventId(): int
    {
        return $this->concertgebouwEventId;
    }
}
