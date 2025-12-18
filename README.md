# 南开大学互联网数据库开发课程项目

## 项目简介
南开大学计算机学院&网络空间安全学院《互联网数据库开发》课程团队项目。基于Yii2高级框架开发，实现完整的课程管理系统。

## 快速开始

### 环境要求
- Ubuntu 20.04+ / WSL2
- Apache 2.4+
- PHP 7.4+
- MySQL 8.0+
- Composer 2.0+

### 一键部署
```bash
git clone https://github.com/li-xinlong/nkuInternetDb.git
cd nkuInternetDb
sudo bash start.sh
```
### 项目结构
```
nkuInternetDb/
├── data/
│   ├── team/                 # Yii2项目核心代码
│   │   ├── backend/          # 后台
│   │   ├── frontend/         # 前台
│   │   ├── common/           # 共享代码（模型、组件）
│   │   ├── console/          # 命令行应用
│   │   └── vendor/           # Composer依赖包
│   ├── personal/             # 个人作业目录
│   └── install.sql           # 数据库结构文件
├── docs/                     # 项目文档
│   ├── 需求文档/              # 项目需求分析
│   ├── 设计文档/              # 系统设计文档
│   ├── 实现文档/              # 代码实现说明
│   ├── 用户手册/              # 用户操作指南
│   └── 部署文档/              # 部署说明
├── start.sh                  # 一键环境配置脚本
├── .gitignore               
```