<?php

namespace Molitor\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\User\Exceptions\PermissionException;
use Molitor\User\Services\AclManagementService;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            /** @var AclManagementService $aclService */
            $aclService = app(AclManagementService::class);
            $aclService->createPermission('cms_page', 'CMS tartalmak kezelése', 'admin');
            $aclService->createPermission('cms_post', 'CMS tartalmak kezelése', 'admin');
            $aclService->createPermission('cms_region', 'CMS tartalmak kezelése', 'admin');
            $aclService->createPermission('cms_author', 'CMS tartalmak kezelése', 'admin');
            $aclService->createPermission('cms_menu', 'CMS tartalmak kezelése', 'admin');
        } catch (PermissionException $e) {
            $this->command->error($e->getMessage());
        }

        // Seed content element types
        $this->call(ContentElementTypeSeeder::class);

        // Seed menu data
        $this->call(MenuSeeder::class);
    }
}
