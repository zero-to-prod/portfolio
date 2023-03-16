<?php

namespace Database\Seeders;

use App\Helpers\Tags;
use App\Helpers\TagTypes;
use App\Models\Author;
use Database\Seeders\Support\UploadsFile;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    use UploadsFile;
    public function run(): void
    {
        Author::unguard();
        $author = Author::firstOrCreate(config('author.default'));
        $avatar = $this->uploadFile('avatar.jpg', 'image/jpeg');
        $author->update([Author::file_id => $avatar->id]);
        $author->files()->sync([$avatar->id]);
    }
}
