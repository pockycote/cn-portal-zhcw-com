<?php
/**
 * 站点元信息管理示例文件
 * 用于组织和生成站点描述文本
 */

// 站点元信息配置数组
$siteMeta = array(
    'base_url' => 'https://cn-portal-zhcw.com',
    'site_name' => '中彩网',
    'description' => '提供丰富彩票资讯与服务的综合门户平台',
    'keywords' => array('中彩网', '彩票', '开奖信息', '走势分析', '彩种介绍'),
    'language' => 'zh-CN',
    'charset' => 'UTF-8',
    'author' => '中彩网团队',
    'version' => '2.1.0',
    'last_updated' => '2025-03-21',
    'contact_email' => 'support@cn-portal-zhcw.com',
    'additional_info' => array(
        'platform' => '综合服务平台',
        'category' => '彩票资讯',
        'region' => '中国'
    )
);

// 生成简短描述文本的函数
function generateShortDescription(array $meta): string {
    $parts = array();
    
    // 拼接站点名称
    if (!empty($meta['site_name'])) {
        $parts[] = $meta['site_name'];
    }
    
    // 拼接核心描述
    if (!empty($meta['description'])) {
        $parts[] = '-' . $meta['description'];
    }
    
    // 添加关键词摘要（最多取前3个）
    if (!empty($meta['keywords']) && is_array($meta['keywords'])) {
        $keywordStr = implode('、', array_slice($meta['keywords'], 0, 3));
        $parts[] = '关键词：' . $keywordStr;
    }
    
    // 添加版本和更新时间
    if (!empty($meta['version']) && !empty($meta['last_updated'])) {
        $parts[] = '版本' . $meta['version'] . '（更新于' . $meta['last_updated'] . '）';
    }
    
    return implode(' ', $parts);
}

// 生成HTML兼容的描述文本
function generateHtmlDescription(array $meta): string {
    $escapedName = htmlspecialchars($meta['site_name'] ?? '未知站点', ENT_QUOTES, 'UTF-8');
    $escapedDesc = htmlspecialchars($meta['description'] ?? '', ENT_QUOTES, 'UTF-8');
    $escapedUrl = htmlspecialchars($meta['base_url'] ?? '', ENT_QUOTES, 'UTF-8');
    
    $htmlParts = array();
    $htmlParts[] = '<meta name="description" content="' . $escapedName . ' - ' . $escapedDesc . '">';
    $htmlParts[] = '<meta name="keywords" content="' . htmlspecialchars(implode(',', $meta['keywords'] ?? array()), ENT_QUOTES, 'UTF-8') . '">';
    $htmlParts[] = '<meta name="author" content="' . htmlspecialchars($meta['author'] ?? '', ENT_QUOTES, 'UTF-8') . '">';
    $htmlParts[] = '<meta name="language" content="' . htmlspecialchars($meta['language'] ?? 'zh-CN', ENT_QUOTES, 'UTF-8') . '">';
    
    return implode("\n    ", $htmlParts);
}

// 输出示例
$shortDesc = generateShortDescription($siteMeta);
$htmlDesc = generateHtmlDescription($siteMeta);

echo "=== 站点元信息 ===" . PHP_EOL;
echo "站点名称: " . $siteMeta['site_name'] . PHP_EOL;
echo "基础URL: " . $siteMeta['base_url'] . PHP_EOL;
echo "描述: " . $siteMeta['description'] . PHP_EOL;
echo "关键词: " . implode(', ', $siteMeta['keywords']) . PHP_EOL;
echo "版本: " . $siteMeta['version'] . PHP_EOL;
echo PHP_EOL;

echo "=== 简短描述 ===" . PHP_EOL;
echo $shortDesc . PHP_EOL;
echo PHP_EOL;

echo "=== HTML兼容描述 ===" . PHP_EOL;
echo $htmlDesc . PHP_EOL;
echo PHP_EOL;

// 额外的用法示例：生成用于搜索引擎的元标签
function getSearchEngineMeta(array $meta): string {
    $lines = array();
    $lines[] = '<!-- Site Meta Information -->';
    $lines[] = '<title>' . htmlspecialchars($meta['site_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</title>';
    $lines[] = generateHtmlDescription($meta);
    $lines[] = '<meta charset="' . htmlspecialchars($meta['charset'] ?? 'UTF-8', ENT_QUOTES, 'UTF-8') . '">';
    $lines[] = '<link rel="canonical" href="' . htmlspecialchars($meta['base_url'] ?? '', ENT_QUOTES, 'UTF-8') . '">';
    return implode("\n", $lines);
}

echo "=== 搜索引擎元标签 ===" . PHP_EOL;
echo getSearchEngineMeta($siteMeta) . PHP_EOL;