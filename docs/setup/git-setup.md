# Git 開發流程

## 1. 分支策略
- `main`: 主分支，穩定版本
- `develop`: 開發分支
- `feature/*`: 功能分支
- `bugfix/*`: 錯誤修復分支
- `release/*`: 發布分支

## 2. 工作流程

### 功能開發
```bash
# 從 develop 建立功能分支
git checkout develop
git checkout -b feature/auth

# 開發完成後合併回 develop
git checkout develop
git merge feature/auth
```

### 版本發布
```bash
# 準備發布
git checkout main
git merge develop
git tag v1.0.0
```

## 3. Commit 規範
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

## 4. 專案結構
```
mindscape/
├── docs/
│   ├── setup/
│   │   ├── docker-setup.md   # Docker 配置說明
│   │   └── git-setup.md      # Git 開發流程說明
│   └── features/
│       └── mvp-features.md   # MVP 功能清單
├── .docker/                  # Docker 配置文件
├── backend/                  # Laravel API
├── frontend/                 # Vue.js SPA
├── .gitignore
├── README.md
└── docker-compose.yml
```

## 5. 開發建議
1. **分支管理**
   - 功能開發都在 feature 分支進行
   - 定期將 develop 分支合併到功能分支
   - 功能完成才合併回 develop

2. **提交規範**
   - 保持提交訊息清晰簡潔
   - 一個提交只做一件事
   - 經常性小提交優於偶爾大提交

3. **版本控制**
   - 使用語意化版本號
   - 重要節點打上 tag
   - 維護清晰的更新日誌 