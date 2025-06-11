<?php

namespace Driver;

use RuntimeException,
    MySQLi as MySQLi_Parent;

class MySQLi extends MySQLi_Parent
{
    public function buildStatement($queryWithPlaceholders)
    {
        $placeholders = $this->extractPlaceholders($queryWithPlaceholders);
        $query = $this->replacePlaceholdersWithQuestionMarks($queryWithPlaceholders);

        return new Statement($this, $query, $placeholders);
    }

    protected function extractPlaceholders($queryWithPlaceholders)
    {
        preg_match_all('/:[a-zA-Z0-9_:]+/', $queryWithPlaceholders, $matches);

        if (isset($matches[0]) && is_array($matches[0]))
        {
            return $matches[0];
        }

        return array();
    }

    protected function replacePlaceholdersWithQuestionMarks($queryWithPlaceholders)
    {
        return preg_replace('/:[a-zA-Z0-9_:]+/', '?', $queryWithPlaceholders);
    }
}