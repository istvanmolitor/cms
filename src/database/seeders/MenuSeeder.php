<?php

namespace Molitor\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\Cms\Models\Menu;
use Molitor\Cms\Models\MenuItem;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Create main menu
        $mainMenu = Menu::firstOrCreate(['name' => 'main']);

        // Clear existing items
        $mainMenu->menuItems()->delete();

        // Create top-level menu items
        $homeItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Kezdőlap',
            'url' => '/',
            'sort' => 1,
            'is_external' => false,
        ]);

        $aboutItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Rólunk',
            'url' => '/about',
            'sort' => 2,
            'is_external' => false,
        ]);

        // Create sub-items for About
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $aboutItem->id,
            'label' => 'Csapatunk',
            'url' => '/about/team',
            'sort' => 1,
            'is_external' => false,
        ]);

        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $aboutItem->id,
            'label' => 'Történetünk',
            'url' => '/about/history',
            'sort' => 2,
            'is_external' => false,
        ]);

        $servicesItem = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Szolgáltatások',
            'url' => '/services',
            'sort' => 3,
            'is_external' => false,
        ]);

        // Create sub-items for Services
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $servicesItem->id,
            'label' => 'Webfejlesztés',
            'url' => '/services/web-development',
            'sort' => 1,
            'is_external' => false,
        ]);

        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $servicesItem->id,
            'label' => 'Mobilalkalmazások',
            'url' => '/services/mobile-apps',
            'sort' => 2,
            'is_external' => false,
        ]);

        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $servicesItem->id,
            'label' => 'Tanácsadás',
            'url' => '/services/consulting',
            'sort' => 3,
            'is_external' => false,
        ]);

        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Kapcsolat',
            'url' => '/contact',
            'sort' => 4,
            'is_external' => false,
        ]);

        $this->command->info('Main menu created successfully with multi-level items!');
    }
}

