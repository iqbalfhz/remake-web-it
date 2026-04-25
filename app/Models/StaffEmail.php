<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffEmail extends Model
{
    protected $fillable = ['nama', 'pt', 'departemen', 'email', 'email_workspace'];
}
