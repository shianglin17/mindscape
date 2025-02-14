# PHP 處理方式比較

## 1. 傳統 Apache + mod_php 模式

### 工作流程
1. Apache 收到請求
2. mod_php（Apache的PHP模組）被喚醒
3. 為每個請求：
   - 載入 PHP 解釋器
   - 載入 PHP 配置
   - 初始化 PHP 環境
   - 執行 PHP 代碼
   - 關閉 PHP 環境

### 示意圖
```
Client → Apache (mod_php) → PHP解釋器 → 結果
```

### 缺點
1. **資源浪費**
   - 每個 Apache 進程都會載入完整的 PHP 解釋器
   - 即使是處理靜態文件的請求也會載入 PHP
   - 佔用更多記憶體

2. **性能問題**
   - 每次請求都需要初始化 PHP 環境
   - Apache 進程較重
   - 並發處理能力受限

## 2. PHP-FPM 模式

### 工作流程
1. Nginx 收到請求
2. 通過 FastCGI 協議轉發給 PHP-FPM
3. PHP-FPM 進程池：
   - 維護預先啟動的 PHP 進程
   - 重複使用已初始化的進程
   - 動態調整進程數量

### 示意圖
```
Client → Nginx → FastCGI → PHP-FPM進程池 → PHP進程 → 結果
```

### 優點
1. **資源利用**
   - 進程池管理更高效
   - 只有 PHP 請求才會使用 PHP 進程
   - 靜態文件由 Nginx 直接處理

2. **性能提升**
   - 進程重複使用
   - 避免重複初始化
   - 更好的並發處理

## 3. 實際案例比較

### 傳統模式（Apache + mod_php）
```apache
# Apache 配置
LoadModule php_module modules/libphp.so
AddHandler php-script .php

<FilesMatch \.php$>
    SetHandler application/x-httpd-php
</FilesMatch>
```

### 現代模式（Nginx + PHP-FPM）
```nginx
# Nginx 配置
location ~ \.php$ {
    fastcgi_pass 127.0.0.1:9000;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
```

## 4. 記憶體使用比較

### 傳統模式
- 每個 Apache 進程：約 50MB
- 包含完整 PHP 環境
- 10個並發 = 500MB+

### PHP-FPM 模式
- Nginx 進程：約 2MB
- PHP-FPM 子進程：約 20MB
- 10個並發 = Nginx(2MB) + PHP-FPM(200MB) 