<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\QueryBuilder;

/**
 * For when the results are paginated.
 * Use this object as a param to select the page and the page size.
 *
 * @example param new PaginationParams(2,200)
 */
class PaginationParams
{
    public int $page;

    public int $limit;

    public function __construct(int $page = 1, int $limit = 100)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimitKey(): string
    {
        return 'limit';
    }

    public function getPageKey(): string
    {
        return 'page';
    }

    public function toArray(): array
    {
        return [
            $this->getPageKey() => $this->page,
            $this->getLimitKey() => $this->limit,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
