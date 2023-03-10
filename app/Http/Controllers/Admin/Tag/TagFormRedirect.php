<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Helpers\Tags;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Tag;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class TagFormRedirect extends Controller
{
    public const id = 'id';
    public const name = 'name';
    public const logo = 'logo';

    /**
     * @throws Throwable
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            self::id => 'nullable|integer',
            self::name => Tag::rules(Tag::name),
            self::logo => 'nullable|image'
        ]);

        DB::beginTransaction();

        $tag = Tag::updateOrCreate([Tag::id => $request->{self::id}], [
            Tag::name => $validated[self::name],
            Tag::type => Tags::post->value
        ]);

        if ($request->hasFile(self::logo)) {
            $logo = File::upload($request->file(self::logo));
            $logo?->tagLogo();
            $tag->files()->sync([$logo?->id]);
        }

        if ($tag->isMissingLogo()) {
            return redirect()->back()->withErrors([self::logo => 'Missing Image'])->withInput();
        }

        $tag->save();

        DB::commit();

        return redirect()->to(to()->admin->tag->edit($tag));
    }
}
