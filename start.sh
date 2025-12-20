#!/bin/bash
# start.sh - 南开大学数据库项目一键配置启动脚本
# 使用方法: sudo bash start.sh

set -e  # 遇到错误立即退出

# 颜色定义
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # 无颜色

# 日志函数
log_info() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

log_warn() {
    echo -e "${YELLOW}[WARN]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

log_step() {
    echo -e "\n${BLUE}=== $1 ===${NC}"
}

# 检查命令是否已安装
check_command() {
    if command -v $1 &> /dev/null; then
        log_info "$1 已安装"
        return 0
    else
        log_warn "$1 未安装"
        return 1
    fi
}

# 检查软件包是否已安装
check_package() {
    if dpkg -l | grep -q " $1 "; then
        log_info "$1 已安装"
        return 0
    else
        log_warn "$1 未安装"
        return 1
    fi
}

# 检查是否以root运行
check_root() {
    if [[ $EUID -ne 0 ]]; then
        log_error "请使用sudo运行此脚本: sudo bash $0"
        exit 1
    fi
}

# 显示欢迎信息
show_welcome() {
    echo ""
    echo "╔═══════════════════════════════════════════════════╗"
    echo "║   南开大学互联网数据库开发课程项目 - 一键配置      ║"
    echo "║          计算机学院 & 网络空间安全学院            ║"
    echo "║           允公允能 日新月异 - Nankai University   ║"
    echo "╚═══════════════════════════════════════════════════╝"
    echo ""
    echo "本脚本将自动完成以下操作:"
    echo "1. 安装并配置Apache、PHP、MySQL、Composer"
    echo "2. 配置数据库 (Webbase/woo/123456)"
    echo "3. 配置Yii2项目权限和cookie验证密钥"
    echo "4. 配置Apache虚拟主机"
    echo "5. 启动所有服务并显示访问信息"
    echo ""
}

# 获取当前项目路径
get_project_path() {
    SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
    PROJECT_PATH="$SCRIPT_DIR"
    log_info "项目路径: $PROJECT_PATH"
    
    # 验证Yii2项目是否存在
    if [ ! -d "$PROJECT_PATH/data/team" ]; then
        log_error "未找到Yii2项目目录: $PROJECT_PATH/data/team"
        log_error "请确保已正确克隆项目并包含data/team目录"
        exit 1
    fi
}

# 安装基础依赖（检查是否已安装）
install_basic_deps() {
    log_step "检查并安装基础依赖包"
    
    apt update -q
    
    local packages=("curl" "wget" "git" "vim" "unzip" "software-properties-common")
    local to_install=()
    
    # 检查哪些包需要安装
    for pkg in "${packages[@]}"; do
        if ! check_package "$pkg"; then
            to_install+=("$pkg")
        fi
    done
    
    if [ ${#to_install[@]} -eq 0 ]; then
        log_info "所有基础依赖包已安装"
    else
        log_info "安装缺失的包: ${to_install[*]}"
        apt install -y -q "${to_install[@]}"
        log_info "基础依赖安装完成"
    fi
}

# 安装Apache（检查是否已安装）
install_apache() {
    log_step "检查并安装Apache"
    
    if check_package "apache2"; then
        log_info "Apache 已安装"
    else
        apt install -y -q apache2
        
        # 启用必要的模块
        a2enmod rewrite >/dev/null 2>&1
        a2enmod headers >/dev/null 2>&1
        
        log_info "Apache 安装完成"
    fi
    
    # 禁用默认站点（如果存在）
    if [ -f /etc/apache2/sites-enabled/000-default.conf ]; then
        a2dissite 000-default.conf >/dev/null 2>&1 || true
    fi
}

# 安装PHP及相关扩展（检查是否已安装）
install_php() {
    log_step "检查并安装PHP及相关扩展"
    
    # 检查PHP是否已安装
    if check_command "php"; then
        log_info "PHP 已安装"
    else
        # 安装PHP和常用扩展
        apt install -y -q php php-common php-mysql php-xml php-curl php-gd php-mbstring \
            php-zip php-bcmath php-intl php-json php-cli php-fpm
        
        log_info "PHP 安装完成"
    fi
    
    # 检查PHP版本
    if command -v php &> /dev/null; then
        PHP_VERSION=$(php -r "echo PHP_VERSION;" | cut -d'.' -f1,2)
        log_info "PHP 版本: $PHP_VERSION"
    fi
}

# 安装MySQL（检查是否已安装）
install_mysql() {
    log_step "检查并安装MySQL"
    
    if check_package "mysql-server"; then
        log_info "MySQL 已安装"
    else
        apt install -y -q mysql-server mysql-client
        
        log_info "MySQL 安装完成"
    fi
}

# 安装Composer（检查是否已安装）
install_composer() {
    log_step "检查并安装Composer"
    
    # 定义标准的命令存在性判断函数（若脚本其他地方已定义，可删除此处）
    check_command() {
        command -v "$1" >/dev/null 2>&1
    }

    if check_command "composer"; then
        log_info "Composer 已安装"
    else
        # 下载并安装Composer（添加超时+错误退出）
        log_info "开始安装Composer..."
        if ! curl -sS --connect-timeout 10 https://getcomposer.org/installer -o composer-setup.php; then
            log_error "下载Composer安装脚本失败"
            return 1
        fi
        # 执行安装（出错直接退出）
        if ! php composer-setup.php --install-dir=/usr/local/bin --filename=composer; then
            log_error "安装Composer失败"
            rm composer-setup.php
            return 1
        fi
        rm composer-setup.php
        log_info "Composer 安装完成"
    fi

}
# 配置数据库（使用用户指定的密码）
setup_database() {
    log_step "配置数据库"
    
    # 使用用户指定的配置
    DB_PASSWORD="123456"
    DB_USER="woo"
    DB_NAME="Webbase"
    
    log_info "数据库配置: $DB_NAME / $DB_USER / $DB_PASSWORD"
    
    # 启动MySQL服务
    systemctl start mysql >/dev/null 2>&1 || true
    systemctl enable mysql >/dev/null 2>&1 || true
    
    # 检查MySQL服务状态
    if ! systemctl is-active --quiet mysql; then
        log_warn "MySQL服务未运行，尝试启动..."
        systemctl start mysql >/dev/null 2>&1
        
        if ! systemctl is-active --quiet mysql; then
            log_error "无法启动MySQL服务，请手动检查"
            return 1
        fi
    else
        log_info "MySQL服务正在运行"
    fi
    
    # 检查MySQL root用户是否可以访问
    if ! mysql -u root -e "SELECT 1" >/dev/null 2>&1; then
        log_warn "MySQL root用户访问失败，可能需要配置root密码"
        log_info "尝试使用空密码或跳过root权限配置..."
        
        # 尝试直接创建数据库和用户（如果root有权限）
        # 如果不行，则提示用户手动配置
        log_info "请确保MySQL已安装并设置了root密码"
        log_info "如果需要手动配置，请执行以下命令:"
        echo ""
        echo "sudo mysql"
        echo "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
        echo "CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';"
        echo "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';"
        echo "FLUSH PRIVILEGES;"
        echo ""
        
        return 0
    fi
    
    # 检查数据库是否已存在
    log_info "检查数据库是否已存在..."
    # DB_EXISTS=$(mysql -u root -e "SHOW DATABASES LIKE '$DB_NAME'" 2>/dev/null | grep -c "$DB_NAME")
    DB_EXISTS=$(mysql -u root -e "SHOW DATABASES LIKE '$DB_NAME'" 2>/dev/null | grep -c "$DB_NAME" || true)

    
    if [ "$DB_EXISTS" -eq 1 ]; then
        log_info "数据库 $DB_NAME 已存在，跳过创建"
    else
        log_info "创建数据库: $DB_NAME"
        mysql -u root -e "CREATE DATABASE $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null || {
            log_warn "创建数据库失败，可能已存在或权限不足"
        }
    fi
    
    # 检查用户是否已存在
    log_info "检查用户是否已存在..."
    USER_EXISTS=$(mysql -u root -e "SELECT COUNT(*) FROM mysql.user WHERE user = '$DB_USER' AND host = 'localhost'" 2>/dev/null | tail -1)
    
    if [ "$USER_EXISTS" -eq 1 ]; then
        log_info "用户 $DB_USER 已存在，跳过创建"
        
        # 检查用户权限
        log_info "检查用户权限..."
        mysql -u root -e "SHOW GRANTS FOR '$DB_USER'@'localhost'" 2>/dev/null | grep -q "$DB_NAME" || {
            log_warn "用户 $DB_USER 没有 $DB_NAME 数据库的权限"
            mysql -u root -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost'; FLUSH PRIVILEGES;" 2>/dev/null && {
                log_info "已授予用户 $DB_USER 对 $DB_NAME 数据库的权限"
            }
        }
    else
        log_info "创建用户: $DB_USER"
        mysql -u root -e "CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';" 2>/dev/null || {
            log_warn "创建用户失败，可能已存在或权限不足"
        }
        
        # 授予权限
        log_info "授予用户权限..."
        mysql -u root -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';" 2>/dev/null || {
            log_warn "授予权限失败"
        }
    fi
    
    # 刷新权限
    mysql -u root -e "FLUSH PRIVILEGES;" 2>/dev/null && log_info "权限刷新完成"
    
    # 测试数据库连接（使用新创建的用户）
    log_info "测试数据库连接..."
    if mysql -u "$DB_USER" -p"$DB_PASSWORD" -e "USE $DB_NAME; SELECT '连接成功' as Status;" 2>/dev/null; then
        log_info "数据库连接测试成功"
        
        # 测试创建表（检查user表是否存在）
        log_info "检查user表..."
        if mysql -u "$DB_USER" -p"$DB_PASSWORD" "$DB_NAME" -e "SHOW TABLES LIKE 'user';" 2>/dev/null | grep -q "user"; then
            log_info "user表已存在"
        else
            log_info "user表不存在，将在Yii2初始化时创建"
        fi
        
    else
        log_warn "数据库连接测试失败，可能原因:"
        log_warn "1. 用户权限不足"
        log_warn "2. 密码错误"
        log_warn "3. 数据库未正确创建"
        
        # 尝试使用root用户创建数据库和用户（如果上面的步骤失败）
        log_info "尝试使用root用户重新配置..."
        
        # 删除可能创建失败的用户
        mysql -u root -e "DROP USER IF EXISTS '$DB_USER'@'localhost';" 2>/dev/null || true
        
        # 重新创建用户
        mysql -u root -e "CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';" 2>/dev/null || true
        mysql -u root -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';" 2>/dev/null || true
        mysql -u root -e "FLUSH PRIVILEGES;" 2>/dev/null || true
        
        # 再次测试连接
        if mysql -u "$DB_USER" -p"$DB_PASSWORD" -e "SELECT 1" 2>/dev/null; then
            log_info "数据库连接已修复"
        else
            log_error "数据库连接仍然失败，请手动检查MySQL配置"
        fi
    fi
    
    # 创建数据库结构文件（用于备份）
    log_info "创建数据库结构文件..."
    mysqldump -u "$DB_USER" -p"$DB_PASSWORD" --no-data "$DB_NAME" > "$PROJECT_PATH/data/install.sql" 2>/dev/null && {
        log_info "数据库结构已保存到: $PROJECT_PATH/data/install.sql"
    } || {
        log_warn "无法导出数据库结构"
    }
    
    log_info "数据库配置完成"
}
# 配置Yii2项目
setup_yii2() {
    log_step "配置Yii2项目"
    
    # 设置目录权限
    log_info "设置项目目录权限..."
    
    # 确保项目目录存在
    mkdir -p "$PROJECT_PATH/data/team/frontend/runtime"
    mkdir -p "$PROJECT_PATH/data/team/backend/runtime"
    mkdir -p "$PROJECT_PATH/data/team/frontend/web/assets"
    mkdir -p "$PROJECT_PATH/data/team/backend/web/assets"
    
    # 设置目录权限
    chmod -R 755 "$PROJECT_PATH" 2>/dev/null || true
    chmod -R 777 "$PROJECT_PATH/data/team/frontend/runtime" 2>/dev/null || true
    chmod -R 777 "$PROJECT_PATH/data/team/backend/runtime" 2>/dev/null || true
    chmod -R 777 "$PROJECT_PATH/data/team/frontend/web/assets" 2>/dev/null || true
    chmod -R 777 "$PROJECT_PATH/data/team/backend/web/assets" 2>/dev/null || true
    
    # 更新Yii2数据库配置
    log_info "更新Yii2数据库配置..."
    
    # 更新Yii2通用配置
    CONFIG_FILE="$PROJECT_PATH/data/team/common/config/main-local.php"
    if [ -f "$CONFIG_FILE" ]; then
        # 备份原配置
        cp "$CONFIG_FILE" "$CONFIG_FILE.backup" 2>/dev/null || true
        
        # 更新数据库配置
        sed -i "s/'dsn' => 'mysql:host=.*'/'dsn' => 'mysql:host=localhost;dbname=Webbase'/" "$CONFIG_FILE" 2>/dev/null || true
        sed -i "s/'username' => '.*'/'username' => 'woo'/" "$CONFIG_FILE" 2>/dev/null || true
        sed -i "s/'password' => '.*'/'password' => '123456'/" "$CONFIG_FILE" 2>/dev/null || true
        log_info "Yii2数据库配置已更新"
    else
        log_warn "Yii2通用配置文件不存在，使用默认配置"
    fi
    
}

# 配置Apache虚拟主机
setup_apache_vhost() {
    log_step "配置Apache虚拟主机"
    
    # 获取本机IP（用于WSL）
    LOCAL_IP=$(hostname -I | awk '{print $1}')
    
    # 创建前台虚拟主机配置
    cat > /etc/apache2/sites-available/nku-frontend.conf << EOF
<VirtualHost *:80>
    ServerName nku-frontend.test
    ServerAlias localhost
    DocumentRoot $PROJECT_PATH/data/team/frontend/web
    
    <Directory $PROJECT_PATH/data/team/frontend/web>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        
        # Yii2 URL重写
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
    </Directory>
    
    ErrorLog \${APACHE_LOG_DIR}/nku-frontend-error.log
    CustomLog \${APACHE_LOG_DIR}/nku-frontend-access.log combined
    
    # 环境变量
    SetEnv YII_ENV development
    SetEnv YII_DEBUG true
</VirtualHost>
EOF
    
    # 创建后台虚拟主机配置
    cat > /etc/apache2/sites-available/nku-backend.conf << EOF
<VirtualHost *:80>
    ServerName nku-backend.test
    DocumentRoot $PROJECT_PATH/data/team/backend/web
    
    <Directory $PROJECT_PATH/data/team/backend/web>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        
        # Yii2 URL重写
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
    </Directory>
    
    ErrorLog \${APACHE_LOG_DIR}/nku-backend-error.log
    CustomLog \${APACHE_LOG_DIR}/nku-backend-access.log combined
    
    # 环境变量
    SetEnv YII_ENV development
    SetEnv YII_DEBUG true
</VirtualHost>
EOF
    
    # 启用站点
    a2ensite nku-frontend.conf >/dev/null 2>&1
    a2ensite nku-backend.conf >/dev/null 2>&1
    
    # 配置hosts文件（如果不存在）
    if ! grep -q "nku-frontend.test" /etc/hosts; then
        echo "127.0.0.1 nku-frontend.test" >> /etc/hosts
        echo "127.0.0.1 nku-backend.test" >> /etc/hosts
        log_info "hosts文件已配置"
    fi
    
    # 如果是WSL，添加额外配置
    if [[ "$LOCAL_IP" =~ ^172\. ]]; then
        if ! grep -q "$LOCAL_IP nku-frontend.test" /etc/hosts; then
            echo "$LOCAL_IP nku-frontend.test" >> /etc/hosts
            echo "$LOCAL_IP nku-backend.test" >> /etc/hosts
        fi
    fi
}

# 初始化Yii2项目
init_yii2() {
    log_step "初始化Yii2项目"
    
    cd "$PROJECT_PATH/data/team"
    
    # 运行数据库迁移
    log_info "运行数据库迁移..."
    if php yii migrate --interactive=0 2>/dev/null; then
        log_info "数据库迁移完成"
    else
        log_warn "数据库迁移失败，可能需要手动运行"
    fi
    
    # 创建管理员用户（如果不存在）
    log_info "检查管理员用户..."
    
    # 检查user表是否存在
    if mysql -u woo -p123456 Webbase -e "SHOW TABLES LIKE 'user'" 2>/dev/null | grep -q "user"; then
        # 检查admin用户是否存在
        USER_EXISTS=$(mysql -u woo -p123456 Webbase -e "SELECT COUNT(*) FROM user WHERE username='admin'" 2>/dev/null | tail -1)
        
        if [ "$USER_EXISTS" -eq 0 ]; then
            log_info "创建管理员用户 admin/admin"
            
            # 使用PHP创建用户
            php -r "
require './vendor/autoload.php';
require './vendor/yiisoft/yii2/Yii.php';
\$config = require './common/config/main.php';
new yii\web\Application(\$config);

\$hash = Yii::\$app->security->generatePasswordHash('admin');
\$authKey = Yii::\$app->security->generateRandomString();

\$result = Yii::\$app->db->createCommand()->insert('user', [
    'username' => 'admin',
    'auth_key' => \$authKey,
    'password_hash' => \$hash,
    'email' => 'admin@nankai.edu.cn',
    'status' => 10,
    'created_at' => time(),
    'updated_at' => time(),
])->execute();

if (\$result) {
    echo '管理员用户创建成功！\\n';
}
" 2>/dev/null || true
        else
            log_info "管理员用户已存在"
        fi
    else
        log_warn "user表不存在，可能需要先运行数据库迁移"
    fi
}

# 启动所有服务
start_services() {
    log_step "启动所有服务"
    
    # 启动MySQL
    systemctl start mysql >/dev/null 2>&1 && log_info "MySQL 已启动" || log_warn "MySQL 启动失败"
    
    # 启动Apache
    systemctl start apache2 >/dev/null 2>&1 && log_info "Apache 已启动" || log_warn "Apache 启动失败"
    
    # 重启Apache使虚拟主机生效
    systemctl restart apache2 >/dev/null 2>&1 && log_info "Apache 配置已生效" || log_warn "Apache 重启失败"
}

# 显示完成信息
show_completion() {
    echo ""
    echo "╔══════════════════════════════════════════════════════════════╗"
    echo "║                 南开大学数据库项目配置完成                   ║"
    echo "╠══════════════════════════════════════════════════════════════╣"
    echo "║ 访问地址:                                                   ║"
    echo "║  • 前台: http://nku-frontend.test                          ║"
    echo "║  • 后台: http://nku-backend.test                           ║"
    echo "╠══════════════════════════════════════════════════════════════╣"
    echo "║ 管理员账号:                                                 ║"
    echo "║  • 用户名: admin                                           ║"
    echo "║  • 密码: admin                                             ║"
    echo "╠══════════════════════════════════════════════════════════════╣"
    echo "║ 数据库信息:                                                 ║"
    echo "║  • 数据库名: Webbase                                       ║"
    echo "║  • 用户名: woo                                             ║"
    echo "║  • 密码: 123456                                            ║"
    echo "╠══════════════════════════════════════════════════════════════╣"
    echo "║ 项目信息:                                                   ║"
    echo "║  • 项目路径: $PROJECT_PATH                    ║"
    echo "║  • Yii2位置: data/team                                     ║"
    echo "║  • 所有服务已自动启动                                      ║"
    echo "╚══════════════════════════════════════════════════════════════╝"
    echo ""
    
    # 如果是WSL环境，显示额外说明
    if [[ "$(hostname -I)" =~ ^172\. ]]; then
        echo "检测到WSL环境:"
        echo "请在Windows的hosts文件中添加以下行:"
        echo "C:\\Windows\\System32\\drivers\\etc\\hosts"
        echo "127.0.0.1 nku-frontend.test"
        echo "127.0.0.1 nku-backend.test"
        echo ""
        echo "然后在Windows浏览器中访问以上地址"
    else
        echo "请在浏览器中访问以上地址"
    fi
    
    echo ""
    echo "项目已启动完成！"
    echo ""
}

# 主函数
main() {
    show_welcome
    check_root
    get_project_path
    
    log_step "开始环境配置"
    
    # 执行安装步骤（每个步骤都会检查是否已安装）
    install_basic_deps
    install_apache
    install_php
    install_mysql
    install_composer
    setup_database
    setup_yii2
    setup_apache_vhost
    init_yii2
    start_services
    show_completion
}

# 执行主函数
main "$@"