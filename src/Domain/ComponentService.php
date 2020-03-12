<?php


namespace App\Domain;


use App\Configuration;

class ComponentService
{

    protected $settings;

    protected $data;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
        $file = $this->getCacheFile();
        if (!is_readable($file) || !($data = file_get_contents($file)) || !($this->data = unserialize($data))) {
            $this->buildComponents();
        }
    }

    private function getCacheFile() {
        $file = "{$this->settings->temp}/ComponentService.sdata";
        return $file;
    }

    public function buildComponents() {
        $this->data = [];
        $releasesRoot = "{$this->settings->sites_root}/releases";
        if (!is_readable($releasesRoot) || !is_dir($releasesRoot)) {
            throw new \DomainException("Bad configuration for [sites_root={$this->settings->sites_root}].");
        }
        foreach (glob("{$releasesRoot}/*/*/manifest.json") as $file) {
            if (is_readable($file) && ($content = file_get_contents($file)) && ($data = json_decode($content, true))) {
                if (($key = $data['id'])) {
                    $this->data[$key] = $data;
                }
            }
        }
        $file = $this->getCacheFile();
        if ((file_exists($file) && !is_writable($file)) || !is_writable(dirname($file))) {
            throw new \DomainException("Bad configuration for cache file [{$file}].");
        }
        if (!file_put_contents($file, serialize($this->data))) {
            throw new \DomainException("Could not save [components] to [{$file}].");
        }
        return $this;
    }

    public function getComponents() {
        return $this->data;
    }

}