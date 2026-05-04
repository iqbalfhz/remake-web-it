<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Contact extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'is_read'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges()
            ->setDescriptionForEvent(fn (string $eventName) => "Kontak {$eventName}");
    }

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }
}
