<?php

namespace App\Forms\Components;

use Filament\Forms\Components\CheckboxList;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission;

class PermissionGroup extends CheckboxList
{
    // protected string $view = 'forms.components.permission-group';

    protected $resolveStateUsing;

    public function resolveStateUsing(callable $resolveStateUsing): static
    {
        $this->resolveStateUsing = $resolveStateUsing;

        return $this;
    }

    public function getRelationship(): BelongsToMany
    {
        return $this->getModelInstance()->permissions();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (self $component, ?array $state): void {
            if (count($state ?? []) > 0) {
                return;
            }

            if ($callback = $this->resolveStateUsing) {
                $component->state($this->evaluate($callback));

                return;
            }

            $relationship = $component->getRelationship();
            $relatedModels = $relationship->getResults();

            if (! $relatedModels) {
                $component->state([]);

                return;
            }

            $component->state(
                $relatedModels
                    ->pluck($relationship->getRelatedKeyName())
                    ->map(fn ($key): string => (string) $key)
                    ->toArray(),
            );
        });

        $this->saveRelationshipsUsing(function (self $component, ?array $state): void {
            $component->getRelationship()->sync($state ?? []);
        });

        $this->options(
            fn () => Permission::query()
                ->where('guard_name', 'web')
                ->pluck('name', 'id')
                ->map(fn (string $name) => __($name))
                ->all(),
        );

        $this->dehydrated(false);
    }
}
