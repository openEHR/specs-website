<?php

namespace App\Domain\Service;

use App\Helper\File;

class TypeService
{

    /** @var string */
    protected $filename;

    /** @var array */
    public $types = array();

    /**
     * TypeService constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return $this
     */
    public function build(): TypeService
    {
        $indexFile = new File($this->filename);
        if ($indexFile->hasContents()) {
            $content = $indexFile->getContents();
            preg_match_all('/=== Model org\.openehr\.(\w+)\s+(.*?)(?==== Model|\Z)/s', $content, $modelParts, PREG_PATTERN_ORDER);
            foreach ($modelParts[2] as $mIndex => $modelPart) {
                $model = $modelParts[1][$mIndex];
                preg_match_all('/==== Package (\w+)\s+(.*?)(?====|\Z)/s', $modelPart, $packageParts, PREG_PATTERN_ORDER);
                foreach ($packageParts[2] as $pIndex => $packagePart) {
                    $package = $packageParts[1][$pIndex];
                    preg_match_all('/\/(\w+)\/([\w.{}]+)\/(\w+)\.html\#(\w+)\[(\w+)\^\]/', $packagePart, $types, PREG_PATTERN_ORDER);
                    foreach ($types[0] as $tIndex => $match) {
                        $this->types[] = [
                            'componentId' => $types[1][$tIndex],
                            'releaseId' => is_numeric($types[2][$tIndex]) ? $types[2][$tIndex] : 'latest',
                            'specificationId' => $types[3][$tIndex],
                            'fragment' => $types[4][$tIndex],
                            'name' => $types[5][$tIndex],
                            'packageName' => $package,
                        ];
                    }
                }
            }
        }
        return $this;
    }

}
