# Pimcore Product Management Demo

Kompletny system zarządzania produktami w Pimcore z funkcjami importu/eksportu i walidacji danych.

## Funkcjonalności

1. **Demo Pimcore** - Gotowe środowisko developerskie, z działającym demo przykładowej aplikacji 
2. **Produkt** - Składający się z kolumn o następujących właściwościach:
   - SKU [input] (unique, required), RegEx: `[tylko wielkie litery, cyfry i myślnik, 5-20 znaków]`
   - Nazwa [input] (required) 
   - Opis [wysiwyg] (optional) Pole opisowe textarea
   - Cena [numeric] (required)
      - Precyzja cz. ułamkowej: 2 miejsca po przecinku
      - Precyzja cz. całk.: 10 miejsc przed przecinkiem
   - Status [select] - wartości: `Dostepny | Niedostepny | Wycofany`
   - Kategoria [manyToOneRelation] do klasy `CategoryItem`
   - Producent [manyToOneRelation] do klasy `ProducentInfo`
   - Zdjecia [imageGallery] (max 10 zdjęć)
   - Dokumentacja [advancedManyToManyRelation] (dowolna liczba plików)

3. **CategoryItem** - Tabela przechoująca kategorie:
    - Nazwa (required, unique) 
    - Opis

4. **ProducentInfo** - Tabela przechoująca kategorie:
    - Nazwa (required) 
    - NIP [input] - (optional) RegEx: `[10 cyfr]`


## Instalacja i konfiguracja

### Wymagania
- PHP 8.3+
- MySQL 5.7+
- Composer 2.0+
- Symfony 6.4+
- Pimcore version 2024.4

### Kroki instalacyjne

1. **Sklonuj repozytorium:**
```bash
git clone https://github.com/JanBancerewicz/pimcoretask.git
cd pimcoretask
composer install
```

2. **Skonfiguruj połączenie z bazą danych w pliku .env** (definiując dane logowania dla użytkownika mysql):
```bash
DATABASE_URL="mysql://user:password@localhost:3306/pimcore"
```
Pamiętaj o zmianie wartości `user` oraz `password` na własne wartości.


3. **Odpal skrypt instalacyjny pimcore** (pozwoli on na utworzenie konta admina, ustawienie hasła oraz instalację całego projektu):
```bash
php bin/console pimcore:install
```

4. Następnie uruchom serwer za pomocą komendy:
```bash
symfony serve
```
Aplikacja będzie nasłuchiwała połączenia na adresie `http://localhost:8000/`. Panel administratora jest dostępny pod adresem `http://localhost:8000/admin`.

### Przykładowy projekt został właśnie uruchomiony.


W folderze projektu, wewnątrz var/data/import znajduje się plik z przykładowymi danymi w CSV, posiada on następującą formę:
```csv
SKU,Nazwa,Opis,Cena,Status,Kategoria,NIP,Producent,Zdjecia,Dokumentacja
PRD001,Smartfon Alpha,"Nowoczesny smartfon z ekranem OLED",1999.99,0,Elektronika,8567346215,TechCorp,"alpha1.jpg,alpha2.jpg","alpha_manual.pdf"
...
```

### Dokonaj importu danych z CSV za pomocą komendy:

```bash
php bin/console app:import-products
```
Komenda ta importuje dane z pliku CSV znajdującego się wewnątrz var/data/import. Wymaga ona jednak, aby na serwerze były przykładowe dane multimedialne takie jak zdjęcia oraz dokumentacja sprzetu uwzględniona w CSV (pliki .pdf oraz .jpg). Katalog z przykładowymi danymi znajduje się w `assets/import`. Jeśli jest pusty, to trzeba dodać zdjęcia lub usunąć powiązanie z nimi z pliku CSV.

Możliwe, że w celu poprawnego zaimportowania danych będzie potrzebne utworzenie następujących katalogów w zakładce Data Objects w panelu administratora w Pimcore:

```ngnix
Produkcja
├── Kategorie
├── Producenci
└── Produkty
```
Jeśli jest to konieczne, to aby to zrobić należy kliknąć PPM na "Home" -> Add folder, a następnie odtwórz strukturę katalogów z rysunku powyżej.

W przypadku, gdy pliki do zaimportowania już się znajdują w bazie danych Pimcore, komenda `php bin/console app:import-products` zwróci ilość pominiętych plików.


### Zapisz dane do eksportu do formatu JSON
```bash
php bin/console app:export-products --output=var/exports/products.json
```

Opcje filtrowania:
```
| Opcja       | Przykład             | Opis                |
|-------------|----------------------|---------------------|
| --status    | --status=Dostepny    | Filtruj po statusie |
| --category  | --category=Elektronika | Filtruj po nazwie kategorii |
| --min-price | --min-price=100      | Minimalna cena      |
| --pretty    | --pretty             | Formatowane wyjście JSON |
```

```bash
php bin/console app:export-products \
  --status=Dostepny \
  --category=Elektronika \
  --min-price=100 \
  --output=var/exports/filtered_products.json
```
Wyeksportowany plik JSON pojawi się w katalogu /var/exports.

### Struktura Projektu:

```bash
/var
  /data/import     # Pliki CSV do importu
  /exports         # Wyeksportowane pliki JSON
/src
  /Command         # Skrypty CLI
    ImportCsvProductsCommand.php
    ExportProductsCommand.php
  /Model           # Definicje klas
    /DataObject
      Product.php
      CategoryItem.php
      ProducentInfo.php
```


### Przykładowe problemy w projekcie oraz jak zostały rozwiązane

1. **Problem: Brakujące foldery docelowe dla obiektów**
   - Rozwiązanie: Implementacja metody `initializeFolders()` która:
     - Rekurencyjnie tworzy brakującą strukturę folderów (`/Produkcja/Kategorie`, `/Produkcja/Producenci`)
     - Weryfikuje prawidłowość ścieżek przed zapisem obiektów
     - Loguje proces tworzenia folderów dla przejrzystości

2. **Problem: Duplikowanie istniejących kategorii/producentów**
     - Rozwiązanie: Implementacja metod `getOrCreateCategory()` i `getOrCreateProducer()`
     - Wymuszone świeże wyszukiwanie z opcją `'force' => true` (pomijanie cache)
     - Weryfikacja lokalizacji obiektów i automatyczne przenoszenie do właściwych folderów

3. **Problem: Nieprawidłowe dane w pliku CSV**
    - Rozwiązanie: Kompleksowa walidacja pliku w metodzie `validateCsvFile()`
    - Sprawdzanie zgodności liczby kolumn z nagłówkami
    - Pomijanie błędnych wierszy zamiast przerywania całego importu
    - Szczegółowe logowanie błędów

4. **Problem: Konflikty nazw/kluczy obiektów**
    - Rozwiązanie: Użycie `Service::getValidKey()` do generowania bezpiecznych nazw
    - Normalizacja nazw kategorii/producentów przed utworzeniem obiektów
    - Automatyczna aktualizacja istniejących wpisów (np. dla NIP producentów)

5. **Problem: Brakujące zasoby multimedialne**
    - Rozwiązanie: Implementacja metod `addImagesToProduct()` i `addDocumentToProduct()`
    - Elastyczna obsługa listy plików oddzielonych przecinkami
    - Ostrzeżenia o brakujących zasobach zamiast błędów krytycznych
    - Automatyczne tworzenie struktur galerii obrazków

6. **Problem: Kolejność tworzenia obiektów i relacji**
    - Rozwiązanie - Podział procesu importu na dwa wyraźne etapy:
       1. **Etap przygotowania relacji**:
          - Przeglądanie wszystkich rekordów CSV i identyfikacja wymaganych kategorii/producentów
          - Tworzenie brakujących obiektów `ProducentInfo` i `CategoryItem`
          - Mapowanie nazw do ID istniejących obiektów
       2. **Etap tworzenia produktów**:
          - Korzystanie z wcześniej przygotowanej mapy relacji (`$categories` i `$producers`)
          - Gwarancja że obiekty relacji istnieją przed próbą powiązania
   - Korzyścią z takiego rozwiązania jest:
     - Eliminacja błędów "relation target not found"
     - Optymalizacja - każda kategoria/producent tworzony tylko raz
     - Możliwość reużycia istniejących obiektów w wielu produktach
