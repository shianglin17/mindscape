# Git 專案設置指南

## 1. Repository 結構
建立兩個獨立的 repository：

### 前端專案 (mindscape-frontend)
```bash
# 建立前端專案
mkdir mindscape-frontend
cd mindscape-frontend
git init
```

### 後端專案 (mindscape-api)
```bash
# 建立後端專案
mkdir mindscape-api
cd mindscape-api
git init
```

## 2. .gitignore 設置

### 前端 .gitignore
```gitignore:mindscape-frontend/.gitignore
# Dependencies
node_modules
package-lock.json

# Build files
dist
dist-ssr
*.local

# Editor directories and files
.vscode/*
!.vscode/extensions.json
.idea
*.suo
*.ntvs*
*.njsproj
*.sln
*.sw?

# Environment files
.env
.env.*
!.env.example

# Logs
logs
*.log
npm-debug.log*
yarn-debug.log*
yarn-error.log*
```

### 後端 .gitignore
```gitignore:mindscape-api/.gitignore
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.phpunit.result.cache
docker-compose.override.yml
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
/.idea
/.vscode
```

## 3. 初始提交流程

### 前端專案
```bash
cd mindscape-frontend

# 初始化 Vue 專案
npm create vite@latest . -- --template vue

# 安裝依賴
npm install

# 初始提交
git add .
git commit -m "Initial commit: Vue project setup"
git branch -M main
git remote add origin git@github.com:yourusername/mindscape-frontend.git
git push -u origin main
```

### 後端專案
```bash
cd mindscape-api

# 建立 Laravel 專案
composer create-project laravel/laravel .

# 初始提交
git add .
git commit -m "Initial commit: Laravel project setup"
git branch -M main
git remote add origin git@github.com:yourusername/mindscape-api.git
git push -u origin main
```

## 4. 分支策略
建議使用以下分支：

- `main`: 主分支，穩定版本
- `develop`: 開發分支
- `feature/*`: 功能分支
- `bugfix/*`: 錯誤修復分支
- `release/*`: 發布分支

### 開發工作流程
1. 從 `develop` 建立功能分支
```bash
git checkout develop
git checkout -b feature/user-auth
```

2. 開發完成後合併回 `develop`
```bash
git checkout develop
git merge feature/user-auth
```

3. 準備發布時合併到 `main`
```bash
git checkout main
git merge develop
git tag v1.0.0
```

## 5. Commit 規範
使用規範化的 commit message：

- `feat`: 新功能
- `fix`: 錯誤修復
- `docs`: 文檔更新
- `style`: 程式碼格式調整
- `refactor`: 重構
- `test`: 測試相關
- `chore`: 建置/工具相關

範例：
```bash
git commit -m "feat: implement user authentication"
git commit -m "fix: resolve login validation issue"
git commit -m "docs: update API documentation"
``` 