<?php

namespace App\Helper;

class File
{

    /** @var ?string */
    protected ?string $content = null;

    /** @var ?int */
    protected ?int $lastModified = null;

    /** @var ?string */
    protected ?string $contentType = null;

    /**
     * File constructor.
     * @param string $filename
     */
    public function __construct(protected string $filename = '')
    {
    }

    public function getFileName(): string
    {
        return $this->filename;
    }

    public function isValid(): bool
    {
        return $this->filename && is_readable($this->filename) && is_file($this->filename);
    }

    protected function read(): File
    {
        if ($this->content === null && $this->isValid()) {
            $this->content = file_get_contents($this->filename);
            switch (pathinfo($this->filename, PATHINFO_EXTENSION)) {
                case 'html':
                case 'htm':
                    $this->contentType = 'text/html';
                    break;
                case 'bmm':
                case 'txt':
                case 'jj':
                case 'g':
                case 'robot':
                    $this->contentType = 'text/plain';
                    break;
                case 'js':
                    $this->contentType = 'application/javascript';
                    break;
                case 'json':
                    $this->contentType = 'application/json';
                    break;
                case 'xml':
                case 'xsd':
                    $this->contentType = 'application/xml';
                    break;
                case 'yml':
                case 'yaml':
                    $this->contentType = 'application/yaml';
                    break;
                case 'css':
                    $this->contentType = 'text/css';
                    break;
                default:
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $this->contentType = finfo_file($finfo, $this->filename);
            }
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
