# Mindscape Docker + Vue 開發方案

## 1. 開發環境設置

### 前置需求
- 安裝 Docker Desktop
- 安裝 Git

### 使用 Laravel Sail (Laravel 的 Docker 開發環境)
```bash
# 1. 建立專案
curl -s "https://laravel.build/mindscape" | bash

# 2. 進入專案目錄
cd mindscape

# 3. 啟動 Docker 容器
./vendor/bin/sail up -d
```

### Sail 常用指令
```bash
# 啟動環境
./vendor/bin/sail up -d

# 關閉環境
./vendor/bin/sail down

# 執行 composer 指令
./vendor/bin/sail composer require laravel/breeze

# 執行 artisan 指令
./vendor/bin/sail artisan migrate

# 執行 npm 指令
./vendor/bin/sail npm install
```

## 2. 前端設置 (Vue 3 + Vite)

### 安裝必要套件
```bash
# 安裝 Laravel Breeze (API 版本)
./vendor/bin/sail composer require laravel/breeze
./vendor/bin/sail artisan breeze:install api

# 安裝前端依賴
./vendor/bin/sail npm install
./vendor/bin/sail npm install @vitejs/plugin-vue vue-router pinia @headlessui/vue @heroicons/vue
```

### 前端目錄結構
```
resources/js/
├── App.vue              # 根組件
├── app.js              # 入口文件
├── components/         # 共用組件
├── views/             # 頁面組件
├── router/            # 路由配置
└── stores/            # Pinia 狀態管理
```

## 3. 一週開發計劃

### Day 1: 環境建置
- 設置 Docker 環境
- 配置 Vue 3 + Vite
- 建立基本頁面結構

### Day 2: 認證系統
- 實現 API 認證
- 登入/註冊頁面
- 用戶資料頁面

### Day 3-4: 文章功能
- 文章 CRUD API
- 文章列表頁面
- Markdown 編輯器整合

### Day 5-6: 互動功能
- 評論功能
- 按讚功能
- 標籤系統

### Day 7: 優化和部署
- 樣式優化
- 錯誤處理
- Docker 部署

## 4. 核心檔案示例

### API 路由設置
```php:routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::post('posts/{post}/comments', CommentController::class);
    Route::post('posts/{post}/like', LikeController::class);
});
```

### Vue 路由配置
```javascript:resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: () => import('../views/Home.vue')
    },
    {
      path: '/posts/create',
      component: () => import('../views/posts/Create.vue')
    },
    // 其他路由...
  ]
})
```

### 主要 Vue 組件
```vue:resources/js/App.vue
<template>
  <div class="min-h-screen bg-gray-100">
    <nav><!-- 導航欄 --></nav>
    <router-view></router-view>
  </div>
</template>
```

## 5. Docker 相關提示

### 常見問題解決
1. 權限問題
```bash
# 如果遇到權限問題，執行：
chmod -R 777 storage bootstrap/cache
```

2. 端口衝突
```bash
# 修改 .env 檔案中的端口
APP_PORT=8000
VITE_PORT=5173
```

### 開發流程
1. 啟動開發環境
```bash
./vendor/bin/sail up -d
./vendor/bin/sail npm run dev
```

2. 進入容器執行指令
```bash
./vendor/bin/sail shell
```

3. 資料庫操作
```bash
./vendor/bin/sail artisan migrate
```

## 6. 開發建議

1. **Docker 相關**
   - 使用 Sail 指令代替直接使用 Docker 指令
   - 遇到問題先檢查容器狀態
   - 善用 Sail 提供的快捷指令

2. **Vue 開發**
   - 組件化開發
   - 使用 Composition API
   - 保持簡單的狀態管理

3. **API 開發**
   - 使用 Resource 類
   - 實作基本的 API 認證
   - 保持 API 回應一致性 