<?php

namespace App\Domain\Data;

class Expression extends AbstractModel implements \JsonSerializable
{
    /** @var string */
    public $id;
    /** @var string */
    public $type;
    /** @var string */
    public $title;
    /** @var string */
    public $description;
    /** @var string */
    public $link;
    /** @var Dependency */
    public $dependency;

    /** @var Component */
    public $component;

    public function setId(string $value = null): Expression
    {
        $this->id = $value;
        return $this;
    }

    public function is(string $id): bool
    {
        return strcasecmp($this->id, $id) === 0;
    }

    public function setTitle(string $value = null): Expression
    {
        $this->title = $value;
        return $this;
    }

    public function setType(string $value = null): Expression
    {
        $this->type = $value;
        return $this;
    }

    public function isUML(): bool {
        return $this->type === 'uml';
    }

    public function setDescription(string $value = null): Expression
    {
        $this->description = $value;
        return $this;
    }

    public function setLink(string $value = null): Expression
    {
        $this->link = $value;
        return $this;
    }

    public function setDependency(array $value = []): Expression
    {
        $this->dependency = (new Dependency())($value);
        $this->dependency->expression = $this;
        return $this;
    }

    public function isOwned(): bool
    {
        return empty($this->dependency);
    }

    public function depends(Expression $supplier): Expression
    {
        $this->setType('dependency');
        $this->setTitle($supplier->title);
        $this->setDescription($supplier->description);
        $this->setLink($supplier->getLink());
        return $this;
    }

    public function getLink(): string
    {
        if ($this->id && $this->component && $this->component->release) {
            $file = $this->link ?: $this->id;
            switch ($this->type) {
                case 'uml':
                    return "{$this->component->release->getLink()}/UML/{$file}";
                    break;
                case 'file':
                    return "{$this->component->release->getLink()}/docs/{$file}";
                    break;
                case 'url':
                case 'dependency':
                    return $this->link;
                    break;
            }
        }
        return '';
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'dependency' => $this->dependency,
            '_component' => $this->component->id,
            '_getLink()' => $this->getLink(),
        ];
    }
}
