<?php

declare(strict_types=1);

namespace Travle\Shared\Application;

use function array_merge;
use function count;
use function defined;

trait CommonProblemDetailsException
{
    private int $status;
    private string $detail;
    private string $title;
    private string $type;

    /** @var array<string, mixed>|null $additional */
    private array|null $additional;

    public static function create(string $details, array|null $additional = []): static
    {
        return new static(
            self::STATUS,
            $details,
            self::TITLE,
            defined('static::TYPE') ? self::TYPE : 'https://httpstatus.es/' . self::STATUS,
            array_merge($additional ?? [], ['code' => self::CODE]),
        );
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDetail(): string
    {
        return $this->detail;
    }

    /** @return array<string, mixed> */
    public function getAdditionalData(): iterable
    {
        return $this->additional ?? [];
    }

    /** @return array<string, mixed> */
    public function toArray(): iterable
    {
        $problem = [
            'status' => $this->status,
            'detail' => $this->detail,
            'title' => $this->title,
            'type' => $this->type,
        ];

        $additionalData = $this->getAdditionalData();

        if (count($additionalData) > 0) {
            $problem = array_merge($additionalData, $problem);
        }

        return $problem;
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): iterable
    {
        return $this->toArray();
    }
}
