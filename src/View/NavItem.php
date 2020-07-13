<?php


namespace App\View;


class NavItem
{
    /** @var Page */
    public $page;

    /** @var NavItem[] */
    public $items = array();

    /**
     * NavItem constructor.
     * @param string $title
     * @param string|array|null $data
     */
    public function __construct(string $title, $data = null)
    {
        if (is_iterable($data)) {
            $this->page = new Page($title);
            foreach ($data as $key => $value) {
                $this->items[] = new NavItem($key, $value);
            }
        } elseif (is_string($data)) {
            $this->page = new Page($title, $data);
        } else {
            $this->page = new Page($title);
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return 'navItem_' . $this->page->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->page->title;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->page->link ?: '#';
    }


    public function isActive(): bool
    {
        return false;
    }

    public function hasSubItems(): bool
    {
        return !empty($this->items);
    }

    public function isDivider(): bool
    {
        return $this->page->isDivider();
    }

    public function isHeader(): bool
    {
        return $this->page->isHeader();
    }


}
