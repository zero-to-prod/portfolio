<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\File;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class AuthorFormRedirect extends Controller
{
    public const id = 'id';
    public const name = 'name';
    public const title = 'title';
    public const avatar = 'avatar';

    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            self::id => 'nullable|integer',
            self::name => Author::rules(Author::name),
            self::title => Author::rules(Author::title),
            self::avatar => 'nullable|image'
        ]);

        DB::beginTransaction();

        $author = Author::updateOrCreate([Author::id => $request->{self::id}], [
            Author::name => $validated[self::name],
            Author::title => $validated[self::title],
        ]);

        if ($request->hasFile(self::avatar)) {
            $avatar = File::upload($request->file(self::avatar));
            $avatar?->tagAvatar();
            $author->files()->sync([$avatar?->id]);
        }

        if ($author->isMissingFile()) {
            return redirect()->back()->withErrors([self::avatar => 'Missing Image'])->withInput();
        }

        $author->save();

        DB::commit();

        return redirect()->to(to()->admin->author->edit($author));
    }
}
