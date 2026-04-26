<?php

namespace App\Data;

final readonly class ApplicationReviewData
{
    public function __construct(
        public string $status,
        public ?string $notes,
    ) {
    }

    public static function fromValidated(array $validated): self
    {
        return new self(
            status: $validated['status'],
            notes: $validated['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }
}
