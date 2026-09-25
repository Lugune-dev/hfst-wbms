# Mwongozo wa Docker / Docker Deployment Guide for HFST-WBMS

Mfumo wa **HFST-WBMS** (Hope for Students Tanzania — Web-Based Management System) umewekewa usanidi kamili wa Docker na Docker Compose kwa ajili ya mazingira ya uzalishaji (production) na majaribio (staging/development) ukitumia **PostgreSQL** na **Redis**.

---

## 🏗️ Usanifu wa Kontena (Container Architecture)

| Kontena / Huduma | Picha (Image) | Lango la Ndani | Lango la Host (Default) | Majukumu |
| :--- | :--- | :--- | :--- | :--- |
| **`app`** | Custom `hfst-wbms:latest` (PHP 8.3 FPM + Nginx + Supervisor) | `80` | `8001` | Tovuti ya umma na paneli zote 5 za Filament (Admin, Staff, Donor, Teacher, Student) |
| **`postgres`** | `postgres:16-alpine` | `5432` | `5433` | Hifadhidata ya PostgreSQL ya mfumo na data zote za wanafunzi na michango |
| **`redis`** | `redis:alpine` | `6379` | `6380` | Cache ya mfumo na foleni za kazi (Jobs/Queue) |
| **`adminer`** | `adminer:latest` | `8080` | `8081` | Kiolesura cha wavuti cha kusimamia hifadhidata (GUI ya PostgreSQL) |

---

## 🚀 Jinsi ya Kuanzisha (Quick Start)

### Hatua ya 1: Jenga na Anzisha Makontena
Tekeleza amri hii kwenye folda ya mradi:

```bash
docker compose up -d --build
```

Amri hii itafanya yafuatayo kiotomatiki:
1. Kujenga frontend assets kupitia Node.js (Vite production build).
2. Kusanikisha PHP 8.3 na viendelezi vyote (GD, PostgreSQL `pdo_pgsql`, Redis, Zip, Intl, Opcache).
3. Kusakinisha vitegemezi vya Composer (`composer install --no-dev`).
4. Kuanzisha huduma ya PostgreSQL na kusubiri iwe tayari (healthy).
5. Kuanzisha Redis.
6. Kuunganisha storage symlink (`php artisan storage:link`).
7. Kutekeleza `php artisan migrate --force` kiotomatiki.
8. Kuanzisha Nginx na PHP-FPM kupitia Supervisord.

---

### Hatua ya 2: Panda Data za Awali (Seeding) - Hiari

Ikiwa unataka kuweka data za majaribio au shule washirika na akaunti za awali:

```bash
docker compose exec app php artisan db:seed
```

Kupanda shule washirika pekee:
```bash
docker compose exec app php artisan db:seed --class=SchoolSeeder
```

---

### Hatua ya 3: Fungua Kwenye Kivinjari (Browser)

- **Tovuti Kuu (Public Web):** [http://localhost:8001](http://localhost:8001)
- **Paneli ya Utawala (Admin Panel):** [http://localhost:8001/admin](http://localhost:8001/admin)
- **Paneli ya Mfadhili (Donor Portal):** [http://localhost:8001/donor](http://localhost:8001/donor)
- **Paneli ya Wafanyakazi (Staff):** [http://localhost:8001/staff](http://localhost:8001/staff)
- **Paneli ya Walimu (Teacher):** [http://localhost:8001/teacher](http://localhost:8001/teacher)
- **Paneli ya Wanafunzi (Student):** [http://localhost:8001/student](http://localhost:8001/student)
- **Adminer (Database GUI):** [http://localhost:8081](http://localhost:8081) *(Chagua System: PostgreSQL, Server: postgres)*

---

## 🛠️ Amri Muhimu za Uendeshaji (Useful Commands)

### 1. Kuangalia Hali ya Makontena (Status)
```bash
docker compose ps
```

### 2. Kuangalia Kumbukumbu (Logs)
```bash
# Tazama kumbukumbu zote
docker compose logs -f

# Tazama kumbukumbu za app pekee
docker compose logs -f app

# Tazama kumbukumbu za postgres pekee
docker compose logs -f postgres
```

### 3. Kuendesha Amri za Artisan Ndani ya Kontena
```bash
# Fungua Artisan Tinker
docker compose exec app php artisan tinker

# Safisha cache
docker compose exec app php artisan optimize:clear

# Tengeneza mtumiaji mpya wa Filament
docker compose exec app php artisan make:filament-user
```

### 4. Kuingia Ndani ya Kontena la App (Bash/Shell)
```bash
docker compose exec app sh
```

### 5. Kusimamisha Mfumo
```bash
# Simamisha makontena
docker compose stop

# Simamisha na kuondoa makontena (bila kupoteza data za volume)
docker compose down

# Ikiwa unataka kuondoa na kufuta volumes zote (Tahadhari: Itafuta data za DB)
docker compose down -v
```

---

## 🔒 Usalama na Utendaji (Production Notes)

- **Opcache** na **Nginx FastCGI Caching** zimewashwa kwa utendaji wa kasi ya juu.
- **Faili za siri (`.env`, `.git`)** zimezuiwa moja kwa moja kupitia Nginx.
- **Upakiaji wa faili (Max Upload Size):** Umewekwa hadi `64MB` kwa ajili ya risiti za PDF na picha za wanafunzi.
- **Hifadhi ya Data (Volumes):** Data za PostgreSQL na faili zilizopakiwa za wanafunzi zinahifadhiwa kwenye named volumes (`postgres_data`, `app_storage`), kwa hivyo hazipotei wakati kontena linaposimamishwa au kujengwa upya.
