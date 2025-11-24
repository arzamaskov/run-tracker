FROM node:22-alpine

# Enable corepack and install pnpm
RUN corepack enable && corepack prepare pnpm@latest --activate

# Set working directory
WORKDIR /app

# Set CI environment variable for pnpm
ENV CI=true

# Expose Vite dev server port
EXPOSE 5173

CMD ["sh", "-c", "pnpm install && pnpm dev --host"]
