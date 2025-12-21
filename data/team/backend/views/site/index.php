<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* 以下变量由 SiteController 传入 */
/* @var $todayVisitCount int */
/* @var $yesterdayVisitCount int */
/* @var $todayCommentCount int */
/* @var $yesterdayCommentCount int */
/* @var $todayStoryCount int */
/* @var $yesterdayStoryCount int */

$this->title = '后台管理';
?>
<div class="site-index">
    <div class="jumbotron text-center">
        <h1>欢迎来到后台管理系统</h1>
        <p class="lead">中国抗战胜利80周年纪念网站 · 后台</p>
    </div>

    <div class="body-content container-fluid">
        <div class="row">
            <!-- 今日访问量 -->
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">今日访问量</div>
                    <div class="panel-body text-center">
                        <span class="huge"><?= number_format($todayVisitCount) ?></span>
                    </div>
                </div>
            </div>
            <!-- 今日新增评论量 -->
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">今日新增评论</div>
                    <div class="panel-body text-center">
                        <span class="huge"><?= number_format($todayCommentCount) ?></span>
                    </div>
                </div>
            </div>
            <!-- 今日新增故事量 -->
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">今日新增故事</div>
                    <div class="panel-body text-center">
                        <span class="huge"><?= number_format($todayStoryCount) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 图表 -->
        <div class="row">
            <div class="col-lg-12">
                <canvas id="todayChart" height="90"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
<script>
const todayVisit        = <?= $todayVisitCount ?>,
      yesterdayVisit    = <?= $yesterdayVisitCount ?>,
      todayComment      = <?= $todayCommentCount ?>,
      yesterdayComment  = <?= $yesterdayCommentCount ?>,
      todayStory        = <?= $todayStoryCount ?>,
      yesterdayStory    = <?= $yesterdayStoryCount ?>;

new Chart(document.getElementById('todayChart'), {
    type: 'bar',
    data: {
        labels: ['访问量', '评论量', '故事量'],
        datasets: [
            { label: '今日',   data: [todayVisit, todayComment, todayStory],   backgroundColor: ['#e53935','#1e88e5','#43a047'] },
            { label: '昨日',   data: [yesterdayVisit, yesterdayComment, yesterdayStory], backgroundColor: ['#ffcdd2','#bbdefb','#c8e6c9'] }
        ]
    },
    options: { responsive:true, scales:{ yAxes:[{ ticks:{ beginAtZero:true, precision:0 } }] } }
});
</script>

<style>
.panel{border-radius:4px;box-shadow:0 1px 3px rgba(0,0,0,.1);}
.panel-heading{font-weight:600;}
.huge{font-size:40px;font-weight:bold;}
</style>
