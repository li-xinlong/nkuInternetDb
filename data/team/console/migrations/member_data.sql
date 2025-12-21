-- =============================================
-- 前台会员测试数据
-- =============================================

-- 注意：密码都是 123456
-- 密码哈希使用 Yii2 的 generatePasswordHash() 生成

-- 前台会员测试数据
-- 密码都是 123456
INSERT INTO `member` (`username`, `auth_key`, `password_hash`, `email`, `status`, `created_at`, `updated_at`, `nickname`) VALUES
('testuser1', 'wN9EyLtU3ejE-NOzj89KNylQVhYcg29v', '$2y$13$XW5jyHtIIyhTYCm0Jo5.LOE5OThH9ZF1YNUOL0B8t0gdLdTxGLShy', 'testuser1@example.com', 10, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), '测试用户1'),
('testuser2', 'E-gkxU4QaisPcjpLpuq1_Hz2St2sZ9fE', '$2y$13$XW5jyHtIIyhTYCm0Jo5.LOE5OThH9ZF1YNUOL0B8t0gdLdTxGLShy', 'testuser2@example.com', 10, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), '测试用户2');

