<?php

declare(strict_types=1);

namespace Core\Modules\Database\Builders;

use Core\Modules\Database\Interfaces\QueryBuilderInterface;

class SelectQueryBuilder implements QueryBuilderInterface
{
    private array $select = [];

    private string $from;

    private array $where;

    public function select(array|string $fields): self
    {
        if (is_string($fields)) {
            $this->select[] = $fields;
        } else {
            $this->select = array_merge($this->select, $fields);
        }

        return $this;
    }

    public function addSelect(array|string $fields): self
    {
        if (is_array($fields)) {
            $this->select = array_merge($this->select, $fields);
        } else {
            $this->select[] = $fields;
        }

        return $this;
    }

    public function from(string $table): self
    {
        $this->from = $table;

        return $this;
    }

    public function where(array|string $condition): self
    {
        if (isset($this->where)) {
            $this->andWhere($condition);
        }

        if (is_string($condition)) {
            $this->where[] = $condition;
        } else {
            foreach ($condition as $key => $value) {
                if (is_string($key)) {
                    if (empty($this->where)) {
                        $this->where[] = "$key=$value";
                    } else {
                        $this->where[] = "AND $key=$value";
                    }
                }
            }
        }

        return $this;
    }

    public function andWhere(array|string $condition): self
    {
        if (is_string($condition)) {
            $this->where[] = "AND $condition";
        } else {
            foreach ($condition as $key => $value) {
                if (is_string($key)) {
                    $this->where[] = "AND $key=$value";
                }
            }
        }

        return $this;
    }

    public function orWhere(array|string $condition): self
    {
        if (is_string($condition)) {
            $this->where[] = "OR $condition";
        } else {
            foreach ($condition as $key => $value) {
                if (is_string($key)) {
                    $this->where[] = "OR $key=$value";
                }
            }
        }

        return $this;
    }

    public function getQuery(): string
    {
        $query = "SELECT ";
        $selectFields = [];

        foreach ($this->select as $key => $value) {
            if (is_string($key)) {
                $selectFields[] = "$value AS $key";
            } else {
                $selectFields[] = $value;
            }
        }

        $query.= implode(',', $selectFields)." FROM $this->from";

        if (isset($this->where)) {
            $query.=" WHERE ";
            $query.= implode(" ", $this->where);
        }

        return $query;
    }
}