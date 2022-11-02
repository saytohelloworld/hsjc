/*
 Navicat Premium Data Transfer

 Source Server         : b
 Source Server Type    : MySQL
 Source Server Version : 50568 (5.5.68-MariaDB)
 Source Host           : 8.218.46.168:3306
 Source Schema         : bbs

 Target Server Type    : MySQL
 Target Server Version : 50568 (5.5.68-MariaDB)
 File Encoding         : 65001

 Date: 02/11/2022 18:11:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for msg
-- ----------------------------
DROP TABLE IF EXISTS `msg`;
CREATE TABLE `msg`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'unknown',
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` datetime NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of msg
-- ----------------------------
INSERT INTO `msg` VALUES (1, 'LongJie', '', '2022-10-01 18:08:46', '耗时两天的简陋网站', '经过两天的艰苦“战斗”，终于是把网站基础功能写好了，只能说实力还是太差了，在码代码的过程中，找文档修 BUG 时间占比大于写代码时间，不管是写前端还是后端，都是边调试边修改，而不是一气呵成写完整个功能，所以说能力有待提高。\r\n\r\n还有，我的坏习惯真的太多了，在服务器配置 Nginx + PHP 环境的时候，一气之下，脑子没转过来 `rm -rf bbs/` 强删了网站的根目录导致数据丢失了，而且强删后手快的把浏览器的网站缓存给清除了，真的是，简直是想死了。原本在笔记本是有备份的但都在上传服务器后 `Shift + Del` 删除了，在尝试恢复数据过程里是真的悲痛欲绝。最后发现手机的 Safari 浏览器还保持打开网页还没清缓存，一顿摸索后把网页保存为 `.webarchive` 文件了，有惊无险，除了 JavaScript 数据没了其它还完好无损。\r\n\r\n这也不是我第一次遇到了，以前多多少少都被这坏习惯给整无语了，辛苦写好的代码一瞬间就化为乌有了。\r\n\r\n在配置 Nginx + PHP 环境的路程中并不是一路顺风，而是崎岖不平，不像 Apache + PHP 环境那样容易。PHP 与 Nginx 配合使用需要修改配置文件，这就涉及到我的知识盲区了，以前都是宝塔面板直接一键安装的，这是第一次手动安装配置，遇到了许多问题。\r\n\r\n**在这里记录一下笔记：**\r\n\r\n```bash\r\n# 通过 yum 包管理安装 PHP74 版本\r\nyum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm\r\nyum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm\r\nyum -y install yum-utils\r\nyum-config-manager --enable remi-php74\r\nyum install php php-cli php-fpm php-mysqlnd php-zip php-devel php-gd php-mcrypt \\\r\n php-mbstring php-curl php-xml php-pear php-bcmath php-json  \\\r\n php-xmlrpc php-pdo  php-pecl-zip php-intl php-common php-imap php-odbc\r\n```\r\n\r\n修改 php.ini 的 cgi.fix_pathinfo 配置项为 0。\r\n\r\n```bash\r\n# yum PHP 安装默认目录 /etc 下\r\nvim /etc/php.ini\r\n```\r\n\r\n```\r\n cgi.fix_pathinfo = 0\r\n```\r\n\r\n修改 php-fpm.conf 配置文件，确保 php-fpm 模块使用 nginx 用户和 nginx 用户组的身份运行。\r\n\r\n```bash\r\nvim /etc/php-fpm.d/www.conf\r\n```\r\n\r\n```\r\nuser = nginx\r\ngroup = nginx\r\n```\r\n\r\n启动 php-fpm `systemctl start php-fpm`。\r\n\r\n*坏习惯 +1：不喜欢 enable 开机启动 php-fpm*\r\n\r\n最后给 nginx 的网站配置文件追加内容了。\r\n\r\n```bash\r\nvim /etc/nginx/conf.d/bbs.conf\r\n```\r\n\r\n```\r\nlocation ~* \\.php$ {\r\n	root /www/bbs;	# 就是这个\r\n\r\n    fastcgi_index   index.php;\r\n    fastcgi_pass    127.0.0.1:9000;\r\n    include         fastcgi_params;\r\n    fastcgi_param   SCRIPT_FILENAME    $document_root$fastcgi_script_name;\r\n    fastcgi_param   SCRIPT_NAME        $fastcgi_script_name;\r\n}\r\n```\r\n\r\n*遇到的问题：$document_root 没有正确获取网站根目录导致找不到 php 文件，后来查文档发现它获取的是本身 root 设置的目录*\r\n\r\n**啊啊啊（无能吐槽）**\r\n经过两天的艰苦“战斗”，终于是把网站基础功能写好了，只能说实力还是太差了，在码代码的过程中，找文档修 BUG 时间占比大于写代码时间，不管是写前端还是后端，都是边调试边修改，而不是一气呵成写完整个功能，所以说能力有待提高。\r\n\r\n还有，我的坏习惯真的太多了，在服务器配置 Nginx + PHP 环境的时候，一气之下，脑子没转过来 `rm -rf bbs/` 强删了网站的根目录导致数据丢失了，而且强删后手快的把浏览器的网站缓存给清除了，真的是，简直是想死了。原本在笔记本是有备份的但都在上传服务器后 `Shift + Del` 删除了，在尝试恢复数据过程里是真的悲痛欲绝。最后发现手机的 Safari 浏览器还保持打开网页还没清缓存，一顿摸索后把网页保存为 `.webarchive` 文件了，有惊无险，除了 JavaScript 数据没了其它还完好无损。\r\n\r\n这也不是我第一次遇到了，以前多多少少都被这坏习惯给整无语了，辛苦写好的代码一瞬间就化为乌有了。\r\n\r\n在配置 Nginx + PHP 环境的路程中并不是一路顺风，而是崎岖不平，不像 Apache + PHP 环境那样容易。PHP 与 Nginx 配合使用需要修改配置文件，这就涉及到我的知识盲区了，以前都是宝塔面板直接一键安装的，这是第一次手动安装配置，遇到了许多问题。\r\n\r\n**在这里记录一下笔记：**\r\n\r\n```bash\r\n# 通过 yum 包管理安装 PHP74 版本\r\nyum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm\r\nyum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm\r\nyum -y install yum-utils\r\nyum-config-manager --enable remi-php74\r\nyum install php php-cli php-fpm php-mysqlnd php-zip php-devel php-gd php-mcrypt \\\r\n php-mbstring php-curl php-xml php-pear php-bcmath php-json  \\\r\n php-xmlrpc php-pdo  php-pecl-zip php-intl php-common php-imap php-odbc\r\n```\r\n\r\n修改 php.ini 的 cgi.fix_pathinfo 配置项为 0。\r\n\r\n```bash\r\n# yum PHP 安装默认目录 /etc 下\r\nvim /etc/php.ini\r\n```\r\n\r\n```\r\n cgi.fix_pathinfo = 0\r\n```\r\n\r\n修改 php-fpm.conf 配置文件，确保 php-fpm 模块使用 nginx 用户和 nginx 用户组的身份运行。\r\n\r\n```bash\r\nvim /etc/php-fpm.d/www.conf\r\n```\r\n\r\n```\r\nuser = nginx\r\ngroup = nginx\r\n```\r\n\r\n启动 php-fpm `systemctl start php-fpm`。\r\n\r\n*坏习惯 +1：不喜欢 enable 开机启动 php-fpm*\r\n\r\n最后给 nginx 的网站配置文件追加内容了。\r\n\r\n```bash\r\nvim /etc/nginx/conf.d/bbs.conf\r\n```\r\n\r\n```\r\nlocation ~* \\.php$ {\r\n	root /www/bbs;	# 就是这个\r\n\r\n    fastcgi_index   index.php;\r\n    fastcgi_pass    127.0.0.1:9000;\r\n    include         fastcgi_params;\r\n    fastcgi_param   SCRIPT_FILENAME    $document_root$fastcgi_script_name;\r\n    fastcgi_param   SCRIPT_NAME        $fastcgi_script_name;\r\n}\r\n```\r\n\r\n*遇到的问题：$document_root 没有正确获取网站根目录导致找不到 php 文件，后来查文档发现它获取的是本身 root 设置的目录*\r\n\r\n**啊啊啊（无能吐槽）**\r\n');
INSERT INTO `msg` VALUES (2, 'LongJie', '', '2022-10-01 18:09:15', '关于这个网站', '\\> 由来：老师的作业，学习和实践\r\n\r\n**version：0.1.20221001**\r\n\r\n| 技术栈 |                                                              |\r\n| ------ | ------------------------------------------------------------ |\r\n| 环境   | LNMP (CentOS 7.9 / Nginx + MariaDB + PHP)                    |\r\n| 语言   | HTML / CSS / JS / PHP / MySQL                                |\r\n| 框架   | JQuery 2.1.1 / Bootstrap 3.3.7 / Marked 2.1.3 / KaTeX 0.15.6 |\r\n\r\n| 实现功能                | 问题             |\r\n| ----------------------- | ---------------- |\r\n| 发布内容和显示内容      | SQL 注入危险     |\r\n| Markdown 语法支持       | 重复提交数据攻击 |\r\n| KaTeX 数学公式支持      | 源码不够严谨规范 |\r\n| cookie 保持信息填写状态 | 性能优化差       |\r\n\r\n**第 73 个 101 的日子，祝祖国繁荣昌盛、绿水青山！**');

SET FOREIGN_KEY_CHECKS = 1;
