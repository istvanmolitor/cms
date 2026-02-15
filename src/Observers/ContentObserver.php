<?php

declare(strict_types=1);

namespace Molitor\Cms\Observers;

use Illuminate\Database\Eloquent\Model;
use Molitor\Cms\Repositories\ContentRepositoryInterface;

class ContentObserver
{
    public function creating(Model $model)
    {
        if (empty($model->content_id)) {
            $model->content_id = app(ContentRepositoryInterface::class)->create()->id;
        }
    }
}
