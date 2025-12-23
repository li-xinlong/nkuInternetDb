<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class DownloadController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true, 'roles' => ['@']],
                ],
            ],
        ];
    }

    /**
     * 显示下载列表页面
     */
    public function actionIndex()
    {
        // 定义可下载的文件夹列表
        $files = [
            [
                'id' => 'lixinlong',
                'name' => '2212599 李欣龙',
                'path' => 'data/personal/2212599 李欣龙',
                'description' => '李欣龙的个人作业',
                'category' => 'personal'
            ],
            [
                'id' => 'fangshurui',
                'name' => '2213459 房书睿',
                'path' => 'data/personal/2213459 房书睿',
                'description' => '房书睿的个人作业',
                'category' => 'personal'
            ],
            [
                'id' => 'anyiran',
                'name' => '2213393 安怡然',
                'path' => 'data/personal/2213393 安怡然',
                'description' => '安怡然的个人作业',
                'category' => 'personal'
            ],
            [
                'id' => 'yansong',
                'name' => '2211555 延嵩',
                'path' => 'data/personal/2211555 延嵩',
                'description' => '延嵩的个人作业',
                'category' => 'personal'
            ],
            [
                'id' => 'team-code',
                'name' => '团队作业代码',
                'path' => 'data/team',
                'description' => '团队作业代码',
                'category' => 'team'
            ],
            [
                'id' => 'team-docs',
                'name' => '团队作业文档',
                'path' => 'docs',
                'description' => '团队作业文档',
                'category' => 'team'
            ],
        ];

        return $this->render('index', ['files' => $files]);
    }

    /**
     * 下载指定文件夹（打包成ZIP）
     */
    public function actionDownload($id)
    {
        while (ob_get_level()) {
            ob_end_clean();
        }
        // 增加执行时间和内存限制
        set_time_limit(600); // 10分钟
        ini_set('memory_limit', '512M');
        
        // 定义允许下载的文件夹映射
        $allowedFiles = [
            'lixinlong' => [
                'path' => 'data/personal/2212599李欣龙',
                'name' => '2212599 李欣龙'
            ],
            'fangshurui' => [
                'path' => 'data/personal/2213459房书睿',
                'name' => '2213459 房书睿'
            ],
            'anyiran' => [
                'path' => 'data/personal/2213393安怡然',
                'name' => '2213393 安怡然'
            ],
            'yansong' => [
                'path' => 'data/personal/2211555延嵩',
                'name' => '2211555 延嵩'
            ],
            'team-code' => [
                'path' => 'data/team',
                'name' => '团队作业代码'
            ],
            'team-docs' => [
                'path' => 'docs',
                'name' => '团队作业文档'
            ],
        ];

        if (!isset($allowedFiles[$id])) {
            throw new NotFoundHttpException('文件不存在');
        }

        // 获取项目根目录（nkuInternetDb）
        $projectRoot = dirname(dirname(dirname(dirname(__DIR__)))); 
        
        // 拼接完整路径
        $sourcePath = $projectRoot . '/' . $allowedFiles[$id]['path'];

        // 检查目录是否存在
        if (!is_dir($sourcePath)) {
            Yii::$app->session->setFlash('error', '目录不存在: ' . $sourcePath);
            return $this->redirect(['index']);
        }

        try {
            // 创建临时ZIP文件
            $tempDir = Yii::getAlias('@runtime/downloads');
            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            // 使用 name 字段命名文件，添加时间戳避免冲突
            $zipFileName = $allowedFiles[$id]['name'] . '_' . date('YmdHis') . '.zip';
            $zipFilePath = $tempDir . '/' . $zipFileName;

            // 创建ZIP压缩包
            $this->createZip($sourcePath, $zipFilePath, $id);

            // 发送文件给用户下载
            if (file_exists($zipFilePath)) {
                $response = Yii::$app->response->sendFile($zipFilePath, $zipFileName);
                
                // 下载后删除临时文件
                register_shutdown_function(function() use ($zipFilePath) {
                    if (file_exists($zipFilePath)) {
                        unlink($zipFilePath);
                    }
                });

                return $response;
            }

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', '下载失败: ' . $e->getMessage());
            return $this->redirect(['index']);
        }
    }

    /**
     * 创建ZIP压缩包（优化版，排除大文件夹）
     */
    private function createZip($sourceDir, $zipFile, $id = null)
    {
        // 尝试使用系统 zip 命令（更快）
        $hasZipCommand = !empty(shell_exec('which zip 2>/dev/null'));
        
        if ($hasZipCommand) {
            return $this->createZipByCommand($sourceDir, $zipFile, $id);
        }
        
        // 使用 PHP ZipArchive
        return $this->createZipByPhp($sourceDir, $zipFile, $id);
    }
    
    /**
     * 使用系统命令创建ZIP
     */
    private function createZipByCommand($sourceDir, $zipFile, $id = null)
    {
        $baseName = basename($sourceDir);
        $parentDir = dirname($sourceDir);

        // 确保 zipFile 是绝对路径
        if ($zipFile[0] !== '/') {
            $zipFile = getcwd() . '/' . $zipFile;
        }
        
        // 创建 zip 文件所在目录
        $zipDir = dirname($zipFile);
        if (!is_dir($zipDir)) {
            mkdir($zipDir, 0777, true);
        }
        
        // 只对团队代码排除大文件夹
        $excludeOptions = '';
        if ($id === 'team-code') {
            $excludeOptions = '-x "*/vendor/*" "*/runtime/*" "*/node_modules/*" "*/.git/*" "*/web/assets/*"';
        }
        
        if (file_exists($zipFile)) {
            @unlink($zipFile);
        }

        $command = sprintf(
            'cd %s && zip -r %s %s %s 2>&1',
            escapeshellarg($parentDir),
            escapeshellarg($zipFile),
            escapeshellarg($baseName),
            $excludeOptions
        );
        
        exec($command, $output, $returnVar);
        
        if ($returnVar !== 0) {
            throw new \Exception('压缩失败 (返回码: ' . $returnVar . '): ' . implode("\n", $output));
        }
        
        if (!file_exists($zipFile)) {
            throw new \Exception('压缩文件未生成: ' . $zipFile . "\n命令输出: " . implode("\n", $output));
        }
    }
    
    /**
     * 使用PHP ZipArchive创建ZIP
     */
    private function createZipByPhp($sourceDir, $zipFile, $id = null)
    {
        if (!extension_loaded('zip')) {
            throw new \Exception('ZIP扩展未安装');
        }

        $zip = new \ZipArchive();
        
        if ($zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            throw new \Exception('无法创建ZIP文件');
        }

        $baseName = basename($sourceDir);
        
        // 只对团队代码排除大文件夹
        $excludeDirs = [];
        if ($id === 'team-code') {
            $excludeDirs = ['vendor', 'runtime', 'node_modules', '.git', 'web/assets'];
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourceDir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        $fileCount = 0;
        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($sourceDir) + 1);
                
                $shouldExclude = false;
                
                // 检查是否在排除目录中
                foreach ($excludeDirs as $excludeDir) {
                    if (strpos($relativePath, $excludeDir . '/') === 0 || 
                        strpos($relativePath, $excludeDir . DIRECTORY_SEPARATOR) === 0) {
                        $shouldExclude = true;
                        break;
                    }
                }
                
                if (!$shouldExclude) {
                    $zipPath = $baseName . '/' . $relativePath;
                    $zip->addFile($filePath, $zipPath);
                    $fileCount++;
                    
                    // // 每添加100个文件刷新一次
                    // if ($fileCount % 100 === 0) {
                    //     @ob_flush();
                    //     @flush();
                    // }
                }
            }
        }

        $zip->close();

        if ($fileCount === 0) {
            throw new \Exception('目录为空，没有文件可下载');
        }
    }
}
