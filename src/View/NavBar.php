<?php


namespace App\View;


use App\Configuration;

class NavBar
{

    /** @var NavItem[] */
    public array $items = [];

    /**
     * NavBar constructor.
     * @param Configuration $navbar
     */
    public function __construct(Configuration $navbar)
    {
        foreach ($navbar as $key => $value) {
            $this->items[] = new NavItem((string)$key, $value);
        }
    }

}
