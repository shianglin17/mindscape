# Node.js Dockerfile 解析

## 基礎映像
```dockerfile
FROM node:18-alpine
```
- 使用 Alpine Linux 版本
- 更小的映像體積
- Node.js 18 LTS 版本

## 工作目錄設置
```dockerfile
WORKDIR /app
```
- 設置容器的工作目錄
- Vue.js 專案的根目錄

## 端口暴露
```dockerfile
EXPOSE 5173
```
- Vite 開發服務器的默認端口
- 允許外部訪問開發服務器 