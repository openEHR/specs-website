<?php


namespace App\Domain;


use App\Configuration;
use App\File;

class ComponentService
{
    /** @var Configuration */
    protected $settings;
    /** @var array */
    protected $data;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
        $file = $this->getCacheFile();
        if (!is_readable($file) || !($data = file_get_contents($file)) || !($this->data = unserialize($data))) {
            $this->build();
        }
    }

    private function getCacheFile(): string
    {
        $file = "{$this->settings->temp}/ComponentService.sdata";
        return $file;
    }

    public function build(): ComponentService
    {
        $this->data = [
            'components' => [],
            'releases' => [],
            'expressions' => [],
        ];
        $releasesRoot = "{$this->settings->sites_root}/releases";
        if (!is_readable($releasesRoot) || !is_dir($releasesRoot)) {
            throw new \DomainException("Bad configuration for [sites_root={$this->settings->sites_root}].");
        }
        foreach (glob("{$releasesRoot}/*/latest/manifest.json") as $file) {
            if (is_readable($file) && ($content = file_get_contents($file)) && ($data = json_decode($content, true))) {
                $component = (new Component($this->settings))($data);
                $component->setLatestRelease();
                $this->data['components'][$component->id] = $component;
                foreach ($component->releases as $i => $release) {
                    if ($release->isReleased()) {
                        $this->data['releases'][] = $release;
                    }
                }
                foreach ($component->expressions as $i => $expression) {
                    if ($expression->isOwned()) {
                        $this->data['expressions'][$expression->id] = $expression;
                    }
                }
            }
        }
        usort(
            $this->data['releases'],
            function ($r1, $r2) {
                if ($r1->date === $r2->date) {
                    return 0;
                }
                return ($r1->date > $r2->date) ? -1 : 1;
            }
        );
        $file = $this->getCacheFile();
        if ((file_exists($file) && !is_writable($file)) || !is_writable(dirname($file))) {
            throw new \DomainException("Bad configuration for cache file [{$file}].");
        }
        if (!file_put_contents($file, serialize($this->data))) {
            throw new \DomainException("Could not save [components] to [{$file}].");
        }
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return Component[]
     */
    public function getComponents(): array
    {
        return $this->data['components'];
    }

    /**
     * @return Release[]
     */
    public function getReleases(): array
    {
        return $this->data['releases'];
    }

    public function getSpecFile(string $component, string $release, string $spec): File
    {
        $filename = "{$this->settings->sites_root}/releases/{$component}/{$release}/docs/{$spec}";
        return new File($filename);
    }

    public function getDiagramFile(string $component, string $release, string $spec, string $diagram): File
    {
        $filename = "{$this->settings->sites_root}/releases/{$component}/{$release}/docs/{$spec}/diagrams/{$diagram}";
        return new File($filename);
    }

}
