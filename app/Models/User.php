<?php

namespace App\Models;

use App\Models\Support\IdColumn;
use App\Models\Support\TimeStampColumns;
use App\Models\Support\User\UserColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use UserColumns;
    use IdColumn;
    use TimeStampColumns;

    protected $fillable = [self::name, self::email, self::password, self::github_id, self::github_token, self::github_refresh_token];
    protected $hidden = [self::password, self::github_token];
    protected $casts = [self::email_verified_at => 'datetime'];
}
