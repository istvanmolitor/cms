<?php

declare(strict_types=1);

namespace Molitor\Cms\Events\Post;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Molitor\Cms\Models\Post;

class PostCreated
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Post $post) {}
}
