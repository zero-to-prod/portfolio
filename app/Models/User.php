<?php

namespace App\Models;

use App\Models\Support\IdColumn;
use App\Models\Support\TimeStampColumns;
use App\Models\Support\User\UserColumns;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use Cachable;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use UserColumns;
    use IdColumn;
    use TimeStampColumns;
    use HasRoles;
    use MustVerifyEmail;

    protected $fillable = [self::name, self::email, self::password, self::github_id, self::github_token, self::github_refresh_token, self::subscribed_at];
    protected $hidden = [self::password, self::github_token];
    protected $casts = [self::email_verified_at => 'datetime'];
}
