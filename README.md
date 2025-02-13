# Mindscape

現代化的部落格平台，使用 Laravel API + Vue.js SPA 開發。

## 技術棧
### 前端
- Vue 3 + Vite
- Vue Router
- Pinia
- TailwindCSS
- Markdown 編輯器

### 後端
- Laravel 10 (API)
- MySQL
- Sanctum (API 認證)

### 開發環境
- Docker
- Nginx
- PHP-FPM
- Node.js

## 專案結構
```
mindscape/
├── .docker/                # Docker 配置
│   ├── nginx/             # Nginx 配置
│   ├── php/               # PHP 配置
│   └── mysql/            # MySQL 配置
├── backend/              # Laravel API 專案
├── frontend/            # Vue SPA 專案
├── docker-compose.yml   # Docker 配置文件
└── docs/                # 專案文件
```

## 開發設置
1. 複製專案
```bash
git clone git@github.com:yourusername/mindscape.git
cd mindscape
```

2. 啟動 Docker 環境
```bash
docker-compose up -d
```

3. 安裝依賴
```bash
# 後端依賴
docker-compose exec backend composer install
docker-compose exec backend php artisan migrate

# 前端依賴
docker-compose exec frontend npm install
```

4. 開發
- 後端 API: http://localhost:8000
- 前端開發: http://localhost:5173
