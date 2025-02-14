# Docker Compose 說明

## 1. 什麼是 Docker Compose？
Docker Compose 是一個工具，用於：
- 定義和運行多個 Docker 容器
- 使用單一配置文件管理所有服務
- 簡化容器間的網絡配置
- 管理服務之間的依賴關係

## 2. docker-compose.yml 的作用
這個文件就像是一個"藍圖"，它：
1. **定義服務**：描述每個需要的服務（容器）
2. **配置網絡**：設定容器間如何通信
3. **管理數據**：設定數據如何持久化
4. **設定環境**：定義環境變數和運行參數

## 3. 文件結構解析

### 版本聲明
```yaml
version: '3.8'  # Docker Compose 文件格式版本
```

### 服務定義
```yaml
services:
  backend:    # 服務名稱
    build:    # 構建配置
      context: .   # 構建上下文
      dockerfile: .docker/php/Dockerfile  # Dockerfile 位置
    volumes:  # 掛載卷
      - ./backend:/var/www/html  # 本地目錄:容器目錄
```

### 網絡配置
```yaml
networks:
  mindscape-network:  # 自定義網絡名稱
    driver: bridge    # 網絡驅動類型
```

## 4. 主要概念解釋

### 服務（Services）
- 每個服務代表一個容器
- 可以從 image 直接創建或通過 Dockerfile 構建
- 可以設定端口映射、環境變數等

### 卷（Volumes）
- 用於數據持久化
- 將容器數據保存在主機上
- 允許容器間共享數據

### 網絡（Networks）
- 允許容器間通信
- 可以創建隔離的網絡環境
- 管理容器間的連接關係

## 5. 常用指令
```bash
# 啟動所有服務
docker-compose up -d

# 停止所有服務
docker-compose down

# 查看服務狀態
docker-compose ps

# 查看服務日誌
docker-compose logs

# 重建服務
docker-compose up -d --build
```

## 6. 實際應用舉例

### 啟動順序
1. MySQL 服務先啟動
2. PHP 後端服務啟動
3. Nginx 服務依賴於 PHP 服務
4. 前端服務獨立運行

### 數據持久化
- MySQL 數據保存在 `.docker/mysql/data`
- 代碼目錄掛載到對應容器
- 配置文件通過 volumes 共享 