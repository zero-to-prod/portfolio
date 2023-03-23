<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileResponse;
use App\Http\Controllers\Results;
use App\Models\Author;
use App\Models\File;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class To
{
    public Routes $welcome = Routes::welcome;
    public Routes $read = Routes::read;
    public Routes $search = Routes::search;
    public Routes $results = Routes::results;
    public Routes $file = Routes::file;
    public Routes $tos = Routes::tos;
    public Routes $privacy = Routes::privacy;
    public Routes $newsletter = Routes::newsletter;
    public Routes $subscribe = Routes::subscribe;
    public Routes $subscribe_success = Routes::subscribe_success;
    public Routes $subscribe_addPassword = Routes::subscribe_addPassword;
    public Routes $contact = Routes::contact;
    public Routes $contact_store = Routes::contact_store;

    public function __construct(
        public LoginRoutes    $login = new LoginRoutes,
        public RegisterRoutes $register = new RegisterRoutes,
        public AdminRoutes    $admin = new AdminRoutes,
        public ApiRoutes      $api = new ApiRoutes,
        public AuthRoutes     $auth = new AuthRoutes,
    )
    {
    }

    /**
     * @see WelcomeTest
     */
    public function welcome(): string
    {
        return route_as($this->welcome);
    }

    /**
     * @see ReadTest
     */
    public function read(Post $post): string
    {
        return route_as($this->read, $post);
    }

    /**
     * @see SearchRedirectTest
     */
    public function search(): string
    {
        return route_as($this->search);
    }

    /**
     * @see ResultsTest
     */
    public function results(?Tag $tag = null): string
    {
        if (is_null($tag)) {
            return route_as($this->results);
        }

        return route_as($this->results, [Results::topic => $tag]);
    }

    /**
     * @see ResultsTopicsTest
     */
    public function resultsTopics(): string
    {
        return route_as($this->results, [Results::topics => true]);
    }

    /**
     * @see ResultsPopularTest
     */
    public function resultsPopular(): string
    {
        return route_as($this->results, [Results::popular => true]);
    }

    /**
     * @see ResultsAuthorTest
     */
    public function resultsAuthor(?Author $author = null): string
    {
        if (is_null($author)) {
            return route_as($this->results);
        }

        return route_as($this->results, [Results::author => $author]);
    }

    /**
     * @see FileTest
     * @see File
     */
    public function file(File $file, ?int $width = null, ?int $height = null): string
    {
        return route_as($this->file, [
            FileResponse::file => $file->name,
            FileResponse::width => $width,
            FileResponse::height => $height,
        ]);
    }

    /**
     * @see TosTest
     */
    public function tos(): string
    {
        return route_as($this->tos);
    }

    /**
     * @see PrivacyTest
     */
    public function privacy(): string
    {
        return route_as($this->privacy);
    }

    /**
     * @see NewsletterTest
     */
    public function newsletter(): string
    {
        return route_as($this->newsletter);
    }

    /**
     * @see SubscribeTest
     */
    public function subscribe(): string
    {
        return route_as($this->subscribe);
    }

    /**
     * @see SubscribeTest
     */
    public function subscribe_success(): string
    {
        return route_as($this->subscribe_success);
    }

    public function subscribe_addPassword(User $user): string
    {
        return route_as($this->subscribe_addPassword, $user);
    }

    /**
     * @see ContactTest
     */
    public function contact(): string
    {
        return route_as($this->contact);
    }

    /**
     * @see ContactStoreTest
     */
    public function contact_store(): string
    {
        return route_as($this->contact_store);
    }
}