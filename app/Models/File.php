<?php

namespace App\Models;

use App\Helpers\Tags;
use App\Helpers\TagTypes;
use App\Models\Support\File\FileColumns;
use App\Models\Support\File\FileRelationships;
use App\Models\Support\IdColumn;
use App\Models\Support\SoftDeleteColumn;
use App\Models\Support\TimeStampColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Spatie\Tags\HasTags;
use Tests\Feature\Models\File\FileUploadTest;

/**
 * @mixin IdeHelperFile
 */
class File extends Model
{
    use HasFactory;
    use IdColumn;
    use TimeStampColumns;
    use SoftDeletes;
    use SoftDeleteColumn;
    use FileColumns;
    use FileRelationships;
    use HasTags;

    protected $fillable = [self::name, self::path, self::original_name, self::mime_type];

    /**
     * @see FileUploadTest
     */
    public static function upload(UploadedFile $file): ?File
    {
        $bucket_path = config('filesystems.file_disk_path');
        $file_path = $file->store($bucket_path, config('filesystems.file_disk'));

        return self::create([
            self::path => $bucket_path,
            self::name => explode($bucket_path . '/', $file_path)[1],
            self::original_name => $file->getClientOriginalName(),
            self::mime_type => $file->getMimeType(),
        ]);
    }

    public function tagFeaturedImage(): File
    {
        return $this->attachTag(Tags::featured->value, TagTypes::system->value);
    }

    public function tagLogo(): File
    {
        return $this->attachTag(Tags::logo->value, TagTypes::system->value);
    }

    public function tagAvatar(): File
    {
        return $this->attachTag(Tags::avatar->value, TagTypes::system->value);
    }
}
