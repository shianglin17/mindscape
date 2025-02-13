# Git 開發流程 (單人開發版本)

## 1. 簡化分支策略
- `main`: 主分支，保持穩定可部署狀態
- `feature/*`: 功能開發分支

說明：單人開發不需要複雜的分支管理，移除 develop 和 release 分支，直接在 feature 分支開發後合併到 main。

## 2. 工作流程

### 功能開發
```bash
# 從 main 建立功能分支
git checkout main
git checkout -b feature/auth

# 開發完成後合併回 main
git checkout main
git merge feature/auth
git tag v0.1.0  # 如果是重要功能完成
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

## 4. 開發建議

1. **分支使用**
   - 新功能開發時才建立 feature 分支
   - 小改動可直接在 main 分支進行
   - 完成功能立即合併回 main

2. **提交規範**
   - 保持提交訊息清晰簡潔
   - 一個提交專注於一個改動
   - 頻繁小量提交，方便追蹤進度

3. **版本控制**
   - 完成重要功能時使用 tag 標記
   - 使用語意化版本號（如 v0.1.0）
   - 在 README.md 維護簡單的更新日誌

## 5. 實用指令
```bash
# 查看分支狀態
git status

# 建立新功能分支
git checkout -b feature/new-feature

# 儲存當前修改
git stash

# 還原修改
git stash pop

# 查看提交歷史
git log --oneline --graph

# 修改最後一次提交
git commit --amend
```

## 6. 專案結構
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