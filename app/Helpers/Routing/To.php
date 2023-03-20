<?php

namespace App\Helpers\Routing;

use App\Helpers\Routes;
use App\Http\Controllers\ResultsView;
use App\Models\Author;
use App\Models\Tag;

class To
{
    public Routes $welcome = Routes::welcome;
    public Routes $search = Routes::search;
    public Routes $results = Routes::results;

    public function __construct(
        public AdminRoutes $admin = new AdminRoutes,
        public ApiRoutes   $api = new ApiRoutes,
        public AuthRoutes  $auth = new AuthRoutes,
        public GuestRoutes $guest = new GuestRoutes,
        public WebRoutes   $web = new WebRoutes,
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
     * @see SearchRedirectTest
     */
    public function search(): string
    {
        return route_as($this->search);
    }

    public function results(?Tag $tag = null): string
    {
        if (is_null($tag)) {
            return route_as($this->results);
        }

        return route_as($this->results, [ResultsView::tag => $tag->slug]);
    }
    public function resultsTopics(): string
    {
        return route_as($this->results, [ResultsView::topics => true]);
    }

    public function resultsPopular(): string
    {
        return route_as($this->results, [ResultsView::popular => true]);
    }

    public function resultsAuthor(?Author $author = null): string
    {
        if (is_null($author)) {
            return route_as($this->results);
        }

        return route_as($this->results, [ResultsView::author => $author->slug]);
    }
}