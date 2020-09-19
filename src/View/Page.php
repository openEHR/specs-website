<?php


namespace App\View;


class Page
{
    /** @var string */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $link;

    public const DIVIDER = 'DIVIDER';
    public const HEADER = 'HEADER';

    /**
     * Page constructor.
     * @param string $title
     * @param string $link
     */
    public function __construct(string $title, string $link = null)
    {
        $this->id = strtolower(preg_replace('/[\W]/', '_', $title));
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * @return bool
     */
    public function isDivider(): bool
    {
        return $this->link === self::DIVIDER;
    }

    /**
     * @return bool
     */
    public function isHeader(): bool
    {
        return $this->link === self::HEADER;
    }

}
