import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react-swc'
import * as path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  resolve: {
    alias: {
      "@": path.resolve(__dirname, './src'),
      "@views": path.resolve(__dirname, './src/views'),
      "@components": path.resolve(__dirname, './src/components'),
      "@layouts": path.resolve(__dirname, './src/layouts'),
      "@services": path.resolve(__dirname, './src/services'),
      "@routes": path.resolve(__dirname, './src/routes'),
    }
  },
  plugins: [react()],
})
