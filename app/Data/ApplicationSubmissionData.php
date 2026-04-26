<?php

namespace App\Data;

use Illuminate\Http\UploadedFile;

final readonly class ApplicationSubmissionData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public ?string $linkedinUrl,
        public ?string $portfolioUrl,
        public string $coverLetter,
        public ?UploadedFile $resume = null,
    ) {
    }

    public static function fromValidated(array $validated, ?UploadedFile $resume = null): self
    {
        return new self(
            name: $validated['name'],
            email: $validated['email'],
            phone: $validated['phone'],
            linkedinUrl: $validated['linkedin_url'] ?? null,
            portfolioUrl: $validated['portfolio_url'] ?? null,
            coverLetter: $validated['cover_letter'],
            resume: $resume,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'linkedin_url' => $this->linkedinUrl,
            'portfolio_url' => $this->portfolioUrl,
            'cover_letter' => $this->coverLetter,
        ];
    }
}
