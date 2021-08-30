<?php

namespace arrays;

class Arrays implements ArraysInterface
{
    public function repeatArrayValues(array $input): array
    {
        $arr = [];
        foreach ($input as $itm) {
            $i = 0;
            do {
                $arr[] = $itm;
                $i++;
            } while ($i < $itm);
        }
        return $arr;
    }

    public function getUniqueValue(array $input): int
    {
        $uniq = [];
        foreach ($input as $item) {
            $count = 0;
            foreach ($input as $itm) {
                if ($item == $itm) {
                    $count++;
                }
            }
            if ($count == 1) {
                $uniq[] = $item;
            }
        }
        if (count($uniq) > 0) {
            return min($uniq);
        }
        return 0;
    }

    public function groupByTag(array $input): array
    {
        $uniqs = [];
        foreach ($input as $inp) {
            foreach ($inp['tags'] as $tag) {
                if (!in_array($tag, $uniqs)) {
                    $uniqs[] = $tag;
                }
            }
        }
        $result = [];
        foreach ($uniqs as $key => $uniq) {
            $names = [];
            foreach ($input as $inp) {
                if (in_array($uniq, $inp['tags'])) {
                    $names[] = $inp['name'];
                }
            }
            sort($names);
            $result[$uniq] = $names;
        }
        return $result;
    }
}