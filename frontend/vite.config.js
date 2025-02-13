import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vite.dev/config/
export default defineConfig({
  plugins: [vue()],
  server: {
    host: true,           // 修改這裡
    port: 5173,
    strictPort: true,     // 強制使用指定端口，如果被占用就報錯而不是使用新端口
    watch: {
      usePolling: true  // 在 Docker 中使用輪詢監聽文件變化
    }
  }
})
