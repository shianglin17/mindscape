# Docker 服務說明

## 1. Nginx 服務
### 作用
- 作為網頁伺服器
- 處理靜態文件請求
- 反向代理 PHP 請求到 php-fpm
- 處理 URL 重寫（Laravel 路由需要）

### 主要配置
```nginx
server {
    # 監聽 80 端口
    listen 80;
    
    # 將 PHP 請求轉發給 php-fpm
    location ~ \.php$ {
        fastcgi_pass php:9000;
    }
    
    # Laravel 的 URL 重寫規則
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

## 2. PHP-FPM 服務
### 作用
- 執行 PHP 程式
- 處理來自 Nginx 的 PHP 請求
- 運行 Laravel 應用
- 管理 PHP 進程

### 主要配置
```dockerfile
FROM php:8.2-fpm

# 安裝 PHP 擴展
RUN docker-php-ext-install pdo_mysql

# 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 配置 PHP
COPY php.ini /usr/local/etc/php/
```

## 3. MySQL 服務
### 作用
- 提供資料庫服務
- 儲存應用數據
- 管理資料庫連接

### 主要配置
```yaml
mysql:
    image: mysql:8.0
    environment:
        MYSQL_DATABASE: mindscape
        MYSQL_ROOT_PASSWORD: root
    volumes:
        - mysql_data:/var/lib/mysql  # 資料持久化
```

## 4. Node.js 服務
### 作用
- 運行前端開發伺服器 (Vite)
- 處理前端資源編譯
- npm 包管理
- 熱重載支援

### 主要配置
```dockerfile
FROM node:18-alpine

WORKDIR /app
EXPOSE 5173  # Vite 預設端口
```

## 5. 服務間的關係
### 通信流程
1. 瀏覽器請求 → Nginx
2. 靜態文件：Nginx 直接處理
3. PHP 請求：Nginx → PHP-FPM
4. 資料庫操作：PHP-FPM → MySQL
5. 前端開發：Node.js (Vite) 直接服務

### 網路配置
```yaml
networks:
    mindscape-network:
        driver: bridge  # 允許容器間通信
```

## 6. 資料持久化
### 需要持久化的數據
1. MySQL 資料
2. 上傳文件
3. 日誌文件

### 配置方式
```yaml
volumes:
    - ./backend:/var/www/html  # Laravel 程式碼
    - ./frontend:/app          # Vue 程式碼
    - mysql_data:/var/lib/mysql  # 資料庫資料
``` 