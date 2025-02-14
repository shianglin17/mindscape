# PHP-FPM 說明

## 1. 什麼是 PHP-FPM？
PHP-FPM 是 PHP FastCGI Process Manager 的縮寫，它是一個：
- PHP FastCGI 的實現
- 主要用於處理 PHP 請求
- 管理 PHP 進程池
- 提供更好的 PHP 性能和穩定性

## 2. 為什麼需要 PHP-FPM？
### 傳統模式的問題
早期 PHP 是作為 Apache 的模組運行：
- 每個請求都會啟動一個新的 PHP 解釋器
- 資源使用效率低
- 性能較差

### PHP-FPM 的優勢
1. **進程管理**
   - 預先啟動多個 PHP 進程
   - 根據需求動態調整進程數
   - 更有效地利用系統資源

2. **性能提升**
   - 避免重複初始化 PHP 環境
   - 更快的請求處理速度
   - 更好的並發處理能力

## 3. 工作流程
1. Nginx 接收到 PHP 請求
2. 通過 FastCGI 協議轉發給 PHP-FPM
3. PHP-FPM 從進程池分配一個進程
4. 進程執行 PHP 代碼
5. 結果返回給 Nginx
6. Nginx 響應給客戶端

## 4. 在 Docker 中的應用
```yaml
# docker-compose.yml 中的配置
services:
  php:
    image: php:8.2-fpm
    volumes:
      - ./backend:/var/www/html
```

```nginx
# Nginx 配置中的 PHP-FPM 連接
location ~ \.php$ {
    fastcgi_pass php:9000;  # 連接 PHP-FPM 容器
    fastcgi_index index.php;
    include fastcgi_params;
}
``` 