# CMS

## Leírás

Ez a CMS csomag Filament 4 alkalmazásokhoz készült, amely lehetővé teszi oldalak és tartalmak kezelését.

## Funkciók

- **Page (Oldal) kezelés**: Oldalak létrehozása, szerkesztése, törlése
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

