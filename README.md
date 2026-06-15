# CMS

## Leírás

Ez a CMS csomag Filament 4 alkalmazásokhoz készült, amely lehetővé teszi oldalak és tartalmak kezelését.

## Telepítés

### Konfiguráció publikálása

A CMS csomag konfigurációs fájlját publikálhatod a főprojektbe:

```bash
php artisan vendor:publish --tag=cms-config
```

Ez létrehozza a `config/cms.php` fájlt, ahol testreszabhatod a rendelkezésre álló layoutokat és az alapértelmezett layoutot.

### Konfiguráció

A `config/cms.php` fájlban a következőket állíthatod be:

- **layouts**: A rendelkezésre álló layoutok listája (kulcs-érték párok)
- **default_layout**: Az alapértelmezett layout, amit új oldalak kapnak

Példa konfiguráció:

```php
return [
    'layouts' => [
        'default' => 'Default Layout',
        'full-width' => 'Full Width',
        'sidebar-left' => 'Sidebar Left',
        'sidebar-right' => 'Sidebar Right',
    ],
    'default_layout' => 'default',
];
```

## Funkciók

- **Page (Oldal) kezelés**: Oldalak létrehozása, szerkesztése, törlése
- **Layout választás**: Oldalakhoz különböző layoutok rendelhetők
- **Content (Tartalom) kezelés**: Tartalmak kezelése
- **ContentElement (Tartalom elem) kezelés**: Különböző típusú tartalmi elemek (text, html, stb.)
- **Frontend megjelenítés**: Nyilvános végpont az oldalak megjelenítéséhez

## Frontend végpont

A csomag tartalmaz egy nyilvános végpontot az oldalak megjelenítéséhez:

### Route

```php
GET /page/{slug}
```

### Példa használat

Ha létrehozol egy oldalt `slug` = `"rolunk"` névvel, akkor elérhető lesz a következő URL-en:

```
http://your-domain.com/page/rolunk
```

### Controller

A `PageController` felelős az oldalak megjelenítéséért:
- Slug alapján lekérdezi az oldalt
- Betölti a hozzá tartozó tartalmakat és elemeket
- Megjeleníti a `cms::page.show` view-t

### View testreszabás

A view testreszabható a Laravel szokásos módon. A csomag által használt view:

```
packages/cms/resources/views/page/show.blade.php
```

Az alkalmazásban felülírhatod ezt a view-t a következő helyen:

```
resources/views/vendor/cms/page/show.blade.php
```

### Layout testreszabás

Az oldalak különböző layoutokat használhatnak. A csomag alapértelmezetten a következő layoutokat tartalmazza:

- `default` - Alapértelmezett layout konténerrel
- `full-width` - Teljes szélességű layout
- `sidebar-left` - Layout bal oldali sidebarral
- `sidebar-right` - Layout jobb oldali sidebarral

A layout fájlok helye:

```
packages/cms/resources/views/layouts/{layout-name}.blade.php
```

Saját layoutokat is létrehozhatsz:

1. Adj hozzá egy új layout bejegyzést a `config/cms.php` fájlhoz
2. Hozz létre egy új layout fájlt a megfelelő néven:
   - A csomagban: `packages/cms/resources/views/layouts/{layout-name}.blade.php`
   - Az alkalmazásban (felülírás): `resources/views/vendor/cms/layouts/{layout-name}.blade.php`

Példa layout:

```blade
@extends('cms::layouts.base')

@section('body')
    <div class="custom-layout">
        @yield('content')
    </div>
@endsection
```

## API végpontok

A csomag JSON API végpontokat is biztosít:

### Összes oldal listázása

```
GET /api/cms/pages
```

**Válasz példa:**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Rólunk",
      "slug": "rolunk",
      "created_at": "2025-11-29T10:00:00+00:00",
      "updated_at": "2025-11-29T10:00:00+00:00"
    }
  ]
}
```

### Egy oldal lekérése slug alapján

```
GET /api/cms/pages/{slug}
```

**Válasz példa:**
```json
{
  "data": {
    "id": 1,
    "title": "Rólunk",
    "slug": "rolunk",
    "content": {
      "id": 1,
      "elements": [
        {
          "id": 1,
          "type": "html",
          "content": "<h2>Bemutatkozás</h2><p>Lorem ipsum...</p>"
        },
        {
          "id": 2,
          "type": "text",
          "content": "További információk..."
        }
      ]
    },
    "created_at": "2025-11-29T10:00:00+00:00",
    "updated_at": "2025-11-29T10:00:00+00:00"
  }
}
```

## Telepítés

A csomag automatikusan regisztrálja magát a Laravel alkalmazásban a service provider segítségével.

## Modellek

- **Page**: Oldal model (title, slug, content_id)
- **Content**: Tartalom model (user_id)
- **ContentElement**: Tartalom elem model (content_id, type, content)

## Repositories

A csomag repository pattern-t használ:
- `PageRepository` / `PageRepositoryInterface`
- `ContentRepository` / `ContentRepositoryInterface`
- `ContentElementRepository` / `ContentElementRepositoryInterface`


## Seeder regisztrálása

A jogosultságok és kezdeti adatok beállításához regisztráld a seedert a `database/seeders/DatabaseSeeder.php` fájlban:

```php
use Molitor\Cms\Database\Seeders\CmsSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CmsSeeder::class,
        ]);
    }
}
```
