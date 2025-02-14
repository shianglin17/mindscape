# Docker 開發環境配置 V2

## 1. 專案結構
```
mindscape/
├── .docker/                # Docker 配置
│   ├── nginx/             # Nginx 配置
│   ├── php/               # PHP 配置
│   └── mysql/            # MySQL 配置
├── backend/              # Laravel API 專案
├── frontend/            # Vue SPA 專案
├── docker-compose.yml   # Docker 配置文件
└── .env                 # 環境變數
```

## 2. Docker 服務配置

### docker-compose.yml
```yaml:docker-compose.yml
version: '3.8'

services:
  # 後端 API 服務
  backend:
    build:
      context: .
      dockerfile: .docker/php/Dockerfile
    container_name: mindscape-api
    volumes:
      - ./backend:/var/www/html
    networks:
      - mindscape-network

  # 前端開發服務
  frontend:
    build:
      context: .
      dockerfile: .docker/node/Dockerfile
    container_name: mindscape-frontend
    volumes:
      - ./frontend:/app
    ports:
      - "5173:5173"
    command: npm run dev
    networks:
      - mindscape-network

  # Nginx 服務
  nginx:
    image: nginx:alpine
    container_name: mindscape-nginx
    ports:
      - "8000:80"
    volumes:
      - ./backend:/var/www/html
      - .docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    networks:
      - mindscape-network

  # MySQL 服務
  mysql:
    image: mysql:8.0
    container_name: mindscape-mysql
    environment:
      MYSQL_DATABASE: mindscape
      MYSQL_ROOT_PASSWORD: root
      MYSQL_USER: mindscape
      MYSQL_PASSWORD: secret
    volumes:
      - .docker/mysql/data:/var/lib/mysql
    networks:
      - mindscape-network

networks:
  mindscape-network:
    driver: bridge
```

## 3. 新增 Node.js Dockerfile
```dockerfile:.docker/node/Dockerfile
FROM node:18-alpine

WORKDIR /app

# 全局安裝 Vue CLI
RUN npm install -g @vue/cli

EXPOSE 5173
```

## 4. 建置步驟

1. **建立目錄結構**
```bash
mkdir mindscape
cd mindscape
mkdir -p .docker/{nginx,php,mysql,node}
mkdir backend frontend
```

2. **初始化專案**
```bash
# 建立 Laravel API 專案
docker run --rm -v $(pwd)/backend:/app composer create-project laravel/laravel .

# 建立 Vue 專案
docker run --rm -v $(pwd)/frontend:/app node:18-alpine sh -c "npm create vue@latest ."
```

3. **啟動環境**
```bash
docker-compose up -d --build
```

## 5. 開發流程

### 後端 API 開發
```bash
# 進入後端容器
docker-compose exec backend bash

# 安裝依賴
composer install

# 執行遷移
php artisan migrate
```

### 前端開發
```bash
# 進入前端容器
docker-compose exec frontend sh

# 安裝依賴
npm install

# 開發服務已在容器啟動時運行
``` 