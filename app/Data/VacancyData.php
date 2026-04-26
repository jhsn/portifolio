<?php

namespace App\Data;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final readonly class VacancyData
{
    public function __construct(
        public string $title,
        public string $slug,
        public string $company,
        public string $location,
        public string $workModel,
        public string $contractType,
        public ?string $salaryRange,
        public string $summary,
        public string $description,
        public array $requirements,
        public array $benefits,
        public bool $isPublished,
        public mixed $publishedAt,
    ) {
    }

    public static function fromValidated(array $validated): self
    {
        return new self(
            title: $validated['title'],
            slug: Str::slug($validated['title']),
            company: $validated['company'],
            location: $validated['location'],
            workModel: $validated['work_model'],
            contractType: $validated['contract_type'],
            salaryRange: Arr::get($validated, 'salary_range'),
            summary: $validated['summary'],
            description: $validated['description'],
            requirements: self::normalizeList((string) Arr::get($validated, 'requirements', '')),
            benefits: self::normalizeList((string) Arr::get($validated, 'benefits', '')),
            isPublished: (bool) Arr::get($validated, 'is_published', false),
            publishedAt: Arr::get($validated, 'published_at'),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'company' => $this->company,
            'location' => $this->location,
            'work_model' => $this->workModel,
            'contract_type' => $this->contractType,
            'salary_range' => $this->salaryRange,
            'summary' => $this->summary,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'benefits' => $this->benefits,
            'is_published' => $this->isPublished,
            'published_at' => $this->publishedAt,
        ];
    }

    private static function normalizeList(string $items): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $items) ?: [])
            ->map(fn (string $item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
