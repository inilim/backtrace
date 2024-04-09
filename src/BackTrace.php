<?php

namespace Inilim\Trace;

class BackTrace
{
    /**
     * @return list<array{file:string|null,line:int|null,method:string|null,type:string|null,class:string|null}>|array{}
     */
    public static function getBacktraces(int $limit = 0, int $offset = 0, bool $reverse = false): array
    {
        $limit += $offset;

        $res = [];
        foreach (\debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS, $limit) as $idx => $frame) {
            if ($idx > $offset) {
                $res[] = [
                    'file'   => $frame['file'] ?? null,
                    'line'   => $frame['line'] ?? null,
                    'method' => $frame['function'] ?? null,
                    'type'   => $frame['type'] ?? null,
                    'class'  => $frame['class'] ?? null,
                ];
            }
        }

        if ($reverse) {
            return \array_reverse($res);
        }
        return $res;
    }
}
