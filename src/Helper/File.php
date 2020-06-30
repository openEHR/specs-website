<?php


namespace App\Helper;


class File
{
    /** @var string */
    protected $filename;

    /** @var string */
    protected $content;

    /** @var int */
    protected $lastModified;

    /** @var string */
    protected $contentType;

    /**
     * File constructor.
     * @param string $filename
     */
    public function __construct(string $filename = '')
    {
        $this->filename = $filename;
    }

    public function isValid(): bool
    {
        return $this->filename && is_readable($this->filename) && is_file($this->filename);
    }

    protected function read(): File
    {
        if ($this->content === null && $this->isValid()) {
            $this->content = file_get_contents($this->filename);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $this->contentType = finfo_file($finfo, $this->filename);
            $this->lastModified = filemtime($this->filename);
        }
        return $this;
    }

    public function hasContents(): bool
    {
        return !empty($this->read()->content);
    }

    public function getContents(): string
    {
        return (string)$this->read()->content;
    }

    public function getLastModified(): int
    {
        return $this->read()->lastModified;
    }

    public function getContentType(): string
    {
        return $this->read()->contentType;
    }

    public function __toString(): string
    {
        return $this->getContents();
    }

}
