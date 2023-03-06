<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Helpers\Routes;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Upload;

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
        ]);

        if ($request->hasFile(self::logo)) {
            $logo = Upload::file($request->file(self::logo));
            $logo?->tagLogo();
            $tag->files()->sync([$logo?->id]);
        }

        if ($tag->hasLogo()) {
            return redirect()->back()->withErrors([self::logo => 'Missing Image'])->withInput();
        }

        $tag->save();

        DB::commit();

        return redirect()->to(route_as(Routes::admin_tag_edit, $tag));
    }
}
