# PHP Dockerfile 解析

## 基礎映像
```dockerfile
FROM php:8.2-fpm
```
- 使用官方 PHP 8.2 版本
- FPM（FastCGI Process Manager）版本
- 專門為 Nginx 配合使用優化

## 系統依賴安裝
```dockerfile
RUN apt-get update && apt-get install -y \
    git \         # 版本控制
    curl \        # 網路請求工具
    libpng-dev \  # GD 庫依賴
    libonig-dev \ # 多字節字符支持
    libxml2-dev \ # XML 支持
    zip \         # 壓縮工具
    unzip         # 解壓工具
```
- 安裝 Laravel 需要的系統庫
- 開發工具和依賴
- 圖片處理相關庫

## PHP 擴展安裝
```dockerfile
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
```
- pdo_mysql: 資料庫連接
- mbstring: 多字節字符處理
- exif: 圖片元數據處理
- pcntl: 進程控制
- bcmath: 高精度計算
- gd: 圖片處理

## Composer 安裝
```dockerfile
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
```
- 使用多階段構建
- 從 composer 映像複製可執行文件
- 用於管理 PHP 依賴

## 工作目錄設置
```dockerfile
WORKDIR /var/www/html
```
- 設置容器的工作目錄
- Laravel 專案的根目錄 