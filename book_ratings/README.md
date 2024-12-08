
## 运行说明

### 环境准备

#### 1. 安装依赖

首先，确保您已经安装了Composer，然后运行以下命令来安装项目依赖：

```bash
composer update
```

#### 2. 配置环境

接下来，您需要配置项目的环境变量。请编辑项目根目录下的 `.env` 文件，设置数据库连接信息：

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_ratings  # 数据库名称，请确保数据库已经创建
DB_USERNAME=root        # 数据库用户名
DB_PASSWORD=phpts       # 数据库密码
```

### 数据库迁移与种子数据

#### 3. 数据库迁移

运行以下命令来创建数据库表结构：

```bash
php artisan migrate
```

#### 4. 填充种子数据

使用以下命令来填充数据库种子数据：

```bash
php artisan db:seed
```

执行完毕后，您可以检查数据库以确认表结构和种子数据是否创建成功。

### 启动开发服务器

#### 5. 启动 Laravel 开发服务器

运行以下命令来启动 Laravel 开发服务器：

```bash
php artisan serve
```

#### 6. 访问应用
服务器启动后，您可以通过浏览器访问 `http://localhost:8000` 来查看应用运行情况。

