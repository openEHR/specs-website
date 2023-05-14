<?php


namespace App\View;


class Page
{
    /** @var string */
    public string $id;

    public const DIVIDER = 'DIVIDER';
    public const HEADER = 'HEADER';

    /**
     * Page constructor.
     * @param string $title
     * @param ?string $link
     */
    public function __construct(public string $title, public ?string $link = null)
    {
        $this->id = strtolower(preg_replace('/\W+/', '_', $title));
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
