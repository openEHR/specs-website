<?php


namespace App\Domain\Service;


class SearchService
{

    public function __construct(protected ComponentService $componentService)
    {
    }

    public function query(string $keyword): array
    {
        $keyword = strtolower(trim(preg_replace('/[^\w\s-]/', ' ', $keyword)));
        $results = [
            'components' => [],
            'specifications' => [],
            'expressions' => [],
            'types' => [],
            'keyword' => $keyword,
            'count' => 0,
            'count_types' => 0,
        ];
        if (!$keyword) {
            return $results;
        }
        foreach ($this->componentService->getComponents() as $component) {
            // trying to see if there is a match on Component
            if ($component->is($keyword)) {
                $results['components']['0_'.$component->id] = $component;
            } elseif ((str_contains($component->title, $keyword)) || (str_contains($component->description, $keyword))) {
                $results['components']['1_'.$component->id] = $component;
//            } elseif (strpos($component->keywords, $keyword) !== false) {
//                $results['components']['2_'.$component->id] = $component;
            }
            // searching for specifications
            foreach ($component->specifications as $spec) {
                if ($spec->is($keyword)) {
                    $results['specifications']['0_'.$spec->id] = $spec;
                } elseif (stripos($spec->id, $keyword) !== false) {
                    $results['specifications']['1_'.$spec->id] = $spec;
                } elseif ((stripos($spec->title, $keyword) !== false) || (stripos($spec->title_short, $keyword) !== false) || (stripos($spec->description, $keyword) !== false)) {
                    $results['specifications']['2_'.$spec->id] = $spec;
                } elseif (stripos($spec->summary, $keyword) !== false) {
                    $results['specifications']['3_'.$spec->id] = $spec;
//                } elseif (stripos($spec->keywords, $keyword) !== false) {
//                    $results['specifications']['4_'.$spec->id] = $spec;
                }
            }
            // searching for types
            foreach ($component->types as $type) {
                if (!$type->package || !$type->specification) {
                    continue;
                }
                if ((stripos($type->name, $keyword) !== false)/* || (stripos($type->packageName, $keyword) !== false)*/) {
                    $results['types'][$type->packageName]['package'] = $type->package;
                    $results['types'][$type->packageName]['specification'] = $type->specification;
                    $results['types'][$type->packageName]['types']['0_'.$type->name] = $type;
                    $results['count_types']++;
                }
            }
            // searching for expressions
            foreach ($component->expressions as $expr) {
                // trying to see if there is a match on Expressions
                if (!$expr->isOwned()) {
                    continue;
                }
                if ($expr->is($keyword)) {
                    $results['expressions']['0_'.$expr->id] = $expr;
                } elseif (stripos($expr->id, $keyword) !== false) {
                    $results['expressions']['1_'.$expr->id] = $expr;
                } elseif (stripos($expr->title, $keyword) !== false) {
                    $results['expressions']['2_'.$expr->id] = $expr;
                } elseif (stripos($expr->description, $keyword) !== false) {
                    $results['expressions']['3_'.$expr->id] = $expr;
                }
            }
        }
        ksort($results['components']);
        ksort($results['specifications']);
        ksort($results['types']);
        ksort($results['expressions']);
        $results['count'] = $results['count_types']
            + count($results['components'])
            + count($results['specifications'])
            + count($results['expressions']);
        return $results;
    }
}
