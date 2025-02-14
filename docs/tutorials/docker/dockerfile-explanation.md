# Dockerfile 說明

## 1. 什麼是 Dockerfile？
Dockerfile 是一個文本文件，它：
- 包含構建 Docker 映像的指令
- 定義容器的運行環境
- 描述如何設置應用程序所需的一切

## 2. Dockerfile 的作用
就像是一個"食譜"或"建築藍圖"：
1. **環境標準化**
   - 確保所有人使用相同的環境
   - 避免"在我電腦上可以運行"的問題

2. **自動化部署**
   - 自動安裝所需依賴
   - 配置系統環境
   - 設置運行時參數

## 3. 常用指令說明
```dockerfile
# 基礎映像
FROM php:8.2-fpm        # 指定基礎映像

# 執行命令
RUN apt-get update      # 在構建過程中執行的命令

# 複製文件
COPY file.php /app/     # 從主機複製文件到容器

# 設置工作目錄
WORKDIR /app            # 設置後續命令的工作目錄

# 暴露端口
EXPOSE 80               # 聲明容器運行時監聽的端口

# 設置環境變量
ENV APP_ENV=production  # 設置環境變量

# 啟動命令
CMD ["php", "app.php"]  # 容器啟動時執行的命令
```

## 4. 實際應用舉例

### PHP 環境（backend）
```dockerfile
FROM php:8.2-fpm

# 安裝依賴
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip

# 安裝 PHP 擴展
RUN docker-php-ext-install pdo_mysql

# 設置工作目錄
WORKDIR /var/www/html
```

### Node.js 環境（frontend）
```dockerfile
FROM node:18-alpine

WORKDIR /app
EXPOSE 5173
```

## 5. Dockerfile vs docker-compose.yml

### Dockerfile
- 定義單個容器的環境
- 描述如何構建映像
- 專注於應用程序的依賴和配置

### docker-compose.yml
- 定義多個服務如何協同工作
- 管理容器間的關係
- 處理網絡和存儲配置 