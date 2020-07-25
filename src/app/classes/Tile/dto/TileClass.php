<?php

namespace cw\Tile\dto;

class TileClass
{

    /** @var int */
    private $linkId;

    /** @var string */
    private $title;

    /** @var string */
    private $url;

    /** @var string */
    private $picture;

    /** @var string */
    private $price;

    /** @var string */
    private $targetPrice;

    /**
     * TileClass constructor.
     * @param int $linkId
     * @param null|string $title
     * @param string $url
     * @param null|string $picture
     * @param null|string $price
     * @param null|string $targetPrice
     */
    public function __construct(
        int $linkId,
        ?string $title,
        string $url,
        ?string $picture,
        ?string $price,
        ?string $targetPrice = null
    ) {
        $this->linkId = $linkId;
        $this->title = $title;
        $this->url = $url;
        $this->picture = $picture;
        $this->price = $price;
        $this->targetPrice = $targetPrice;
    }

    /**
     * @return int
     */
    public function getLinkId(): int
    {
        return $this->linkId;
    }

    /**
     * @return string
     */
    public function getTitle():? string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return null|string
     */
    public function getPicture():? string
    {
        return $this->picture;
    }

    /**
     * @return null|string
     */
    public function getPrice():? string
    {
        return $this->price;
    }

    /**
     * @param null|string $price
     */
    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return null|string
     */
    public function getTargetPrice():? string
    {
        return $this->targetPrice;
    }

    /**
     * @param null|string $targetPrice
     */
    public function setTargetPrice(?string $targetPrice): void
    {
        $this->targetPrice = $targetPrice;
    }

}