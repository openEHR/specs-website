<?php

namespace App\Helper;

use App\Domain\Data\Component;
use Generator;
use FilesystemIterator;
use SplFileInfo;

class ITSAsset extends SplFileInfo
{

    /** @var Component */
    public Component $component;

    public function setComponent(Component $component): ITSAsset
    {
        $this->component = $component;
        return $this;
    }

    public function getName(): string
    {
        $path = $this->getPathname();
        return rtrim(substr($path, stripos($path, 'components')), '/');
    }

    public function getContents(): Generator
    {
        if ($this->isReadable() && $this->isDir()) {
            $whitelist = match ($this->component->id) {
                'ITS-XML' => ['xsd'],
                'ITS-JSON' => ['json'],
                'ITS-BMM' => ['bmm'],
                default => [],
            };
            foreach (new FilesystemIterator($this->getPathname()) as $fsItem) {
                if (!$fsItem->isDir() && !in_array($fsItem->getExtension(), $whitelist, true)) {
                    continue;
                }
                $item = new self($fsItem->getPathname());
                $item->setComponent($this->component);
                yield $item;
            }
        }
    }

    public function getLink(): string
    {
        return "{$this->component->release->getLink()}/{$this->getName()}";
    }

}
