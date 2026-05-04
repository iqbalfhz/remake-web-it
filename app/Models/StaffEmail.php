<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class StaffEmail extends Model
{
    use LogsActivity;

    protected $fillable = ['nama', 'pt', 'departemen', 'email', 'email_workspace'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama', 'pt', 'departemen', 'email', 'email_workspace'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges()
            ->setDescriptionForEvent(fn (string $eventName) => "Staff Email {$eventName}");
    }
}
