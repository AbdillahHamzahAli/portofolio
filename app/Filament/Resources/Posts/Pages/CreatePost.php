<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\PostStatus;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $status = $data['status'] instanceof PostStatus
            ? $data['status']
            : PostStatus::tryFrom((string) $data['status']);

        $data['published_at'] = $status === PostStatus::Published ? now() : null;

        return $data;
    }
}
