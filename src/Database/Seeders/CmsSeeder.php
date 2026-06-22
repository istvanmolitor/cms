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
            $permissionGroupName = 'CMS';

            $aclService->createPermission('cms_page', 'Oldalak kezelése', 'admin', $permissionGroupName);
            $aclService->createPermission('cms_post', 'Bejegytések kezelése', 'admin', $permissionGroupName);
            $aclService->createPermission('cms_region', 'Tartalom régiók kezelése', 'admin', $permissionGroupName);
            $aclService->createPermission('cms_author', 'Szerzők kezelése', 'admin', $permissionGroupName);
            $aclService->createPermission('cms_menu', 'Menük kezelése', 'admin', $permissionGroupName);
            $aclService->createPermission('cms_post_type', 'Poszt típusok kezelése', 'admin', $permissionGroupName);
            $aclService->createPermission('cms_page_type', 'Oldal típusok kezelése', 'admin', $permissionGroupName);
        } catch (PermissionException $e) {
            $this->command->error($e->getMessage());
        }

        // Seed content element types
        $this->call(ContentElementTypeSeeder::class);

        // Seed post types
        $this->call(PostTypeSeeder::class);

        // Seed page types
        $this->call(PageTypeSeeder::class);

        // Seed menu data
        $this->call(MenuSeeder::class);
    }
}
