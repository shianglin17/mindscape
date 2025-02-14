# Docker 路徑結構說明

## 1. `/var/www/html` 的由來
這個路徑結構來自傳統的 Linux Web 服務器配置：

- `/var`: 存放變動數據
  - `/var/www`: Web 相關文件的標準目錄
    - `/var/www/html`: Web 根目錄

### 歷史原因
1. **Apache 傳統**
   - Apache 默認使用這個目錄
   - 成為了行業標準
   - 大多數 Web 服務器沿用此慣例

2. **安全考慮**
   - `/var` 目錄專門用於可變數據
   - Web 文件與系統文件分離
   - 便於權限管理

## 2. 在 Docker 中的應用

### Nginx 配置
```nginx
server {
    root /var/www/html/public;  # Laravel 公共目錄
}
```

### PHP-FPM 配置
```dockerfile
WORKDIR /var/www/html  # 工作目錄設置
```

## 3. 目錄結構的優勢
1. **標準化**
   - 遵循行業慣例
   - 便於維護和遷移
   - 減少配置錯誤

2. **安全性**
   - 文件權限明確
   - 與系統文件隔離
   - 便於訪問控制

3. **兼容性**
   - 與大多數工具兼容
   - 減少配置修改
   - 便於部署 