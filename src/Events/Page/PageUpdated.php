<?php

declare(strict_types=1);

namespace Molitor\Cms\Events\Page;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Molitor\Cms\Models\Page;

class PageUpdated
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Page $page) {}
}
