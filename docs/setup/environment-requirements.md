# 開發環境需求

## 1. 後端環境
- PHP 8.2
- Laravel 10
- MySQL 8.0
- Composer
- Nginx

## 2. 前端環境
- Node.js 18
- Vue 3
- Vite
- npm

## 3. 開發工具
- Git
- Docker Desktop
- 編輯器（VS Code 建議）

## 4. Docker 服務配置
### 必要服務
- nginx: 網頁伺服器
- php-fpm: PHP 運行環境
- mysql: 資料庫
- node: 前端開發環境

### 端口配置
- 後端 API: localhost:8000
- 前端開發: localhost:5173
- MySQL: localhost:3306

## 5. 開發考量
1. **熱重載支援**
   - 前端 Vite 開發伺服器
   - 後端檔案更新自動重載

2. **開發便利性**
   - 容器間通信配置
   - 資料庫持久化
   - 日誌記錄

3. **效能優化**
   - PHP OpCache 配置
   - Nginx 快取設置
   - 容器資源配置 