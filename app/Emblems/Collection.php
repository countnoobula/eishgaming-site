<?php

namespace App\Emblems;

class Collection
{
    protected $array;
    
    public function __construct(array $array = [])
    {
        $this->array = [];
        
        foreach ($array as $e) {
            $this->add($e);
        }
    }

    
    protected function add($e)
    {
        if ($this->valid($e)) {
            $this->array[$this->getKeyRef($e)] = $e;
        }
    }
    
    protected function valid($e): bool
    {
        return $e instanceof CommunityEmblem;
    }
    
    protected function getKeyRef($e): string
    {
        return get_class($e);
    }
    
    public function has($e, int $minLevel = 0): bool
    {
        if (is_object($e)) {
            if (!$this->valid($e)) {
                return false;
            }
            
            $e = $this->getKeyRef($class);
        }
        
        $emblem = $this->get($e);
        
        if ($minLevel > 0 && $emblem->getLevel() < $minLevel) {
            return false;
        }
        
        return true;
        
    }
    
    public function get($class): CommunityEmblem
    {
        if (isset($this->array[$class])) {
            return $this->array[$class];
        }
    }
    
    public function toArray(): array
    {
        return array_values($this->array);
    }
    
    public function count(): int
    {
        return count($this->array);
    }
}
