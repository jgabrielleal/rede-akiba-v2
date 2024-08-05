import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react-swc'
import * as path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, './src'),
      "@hooks": path.resolve(__dirname, './src/hooks'),
      "@views": path.resolve(__dirname, './src/views'),
      "@components": path.resolve(__dirname, './src/components'),
      "@services": path.resolve(__dirname, './src/services'),
      "@routes": path.resolve(__dirname, './src/routes'),
    }
  },
})