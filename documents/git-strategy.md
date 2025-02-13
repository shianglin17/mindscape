# Git 倉庫策略分析

## 1. 單一倉庫 (Monorepo)

### 結構
```
mindscape/
├── .docker/
├── backend/
│   ├── .git/           # Git 子模組（可選）
│   └── ...
├── frontend/
│   ├── .git/           # Git 子模組（可選）
│   └── ...
└── docker-compose.yml
```

### 優點
1. **整體性管理**
   - 容易維護版本一致性
   - 便於整體部署
   - Docker 配置集中管理

2. **開發便利性**
   - 單一程式碼庫
   - 容易進行跨項目修改
   - 簡化專案管理

3. **CI/CD 整合**
   - 統一的部署流程
   - 整體測試更容易
   - 環境配置集中

### 缺點
1. **倉庫體積較大**
2. **權限管理較複雜**
3. **版本歷史可能混亂**

## 2. 分離倉庫 (Multiple Repos)

### 結構
```
mindscape-frontend/
└── ...

mindscape-backend/
└── ...

mindscape-docker/
└── ...
```

### 優點
1. **職責分明**
   - 前後端完全分離
   - 版本控制更清晰
   - 團隊分工更容易

2. **部署靈活**
   - 可以獨立部署
   - 版本管理更精確
   - 更容易擴展

3. **程式碼管理**
   - 歷史記錄更清晰
   - 權限控制更精確
   - 倉庫大小適中

### 缺點
1. **環境配置複雜**
2. **整體部署較麻煩**
3. **版本同步需要額外管理**

## 3. 建議方案（適合您的情況）

考慮到您是：
1. 單人開發
2. MVP 快速開發
3. Docker 環境整合
4. 需要學習和實驗

建議採用 **單一倉庫（Monorepo）** 方案：

### 實施步驟
1. **建立主倉庫**
```bash
mkdir mindscape
cd mindscape
git init
```

2. **建立 .gitignore**
```gitignore
# Docker
.docker/mysql/data/

# 依賴
**/node_modules
**/vendor

# 環境文件
**/.env
**/.env.*
!**/.env.example

# 編譯文件
**/dist
**/build
```

3. **目錄結構**
```
mindscape/
├── .docker/
├── backend/
├── frontend/
├── docker-compose.yml
└── README.md
```

4. **分支策略**
- `main`: 穩定版本
- `develop`: 開發分支
- `feature/*`: 功能分支

### 工作流程
1. **功能開發**
```bash
git checkout -b feature/auth
# 開發完成後
git checkout develop
git merge feature/auth
```

2. **版本發布**
```bash
git checkout main
git merge develop
git tag v0.1.0
```

### 部署考量
- 使用 Docker Compose 進行整體部署
- 可以根據需要分別部署前後端
- 環境變數集中管理 