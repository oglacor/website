<?php
/*
 * Chinese (Simplified) translation of pages/privacy.php (version 2026-10-30), shown
 * inside pages/legal/page.php at /zh-cn/privacy.
 *
 * MACHINE TRANSLATION by an AI (Claude), 2026-11-15, NOT REVIEWED by a lawyer
 * or by a native speaker. Gauden approved publishing it before review on
 * 2026-11-15; the legal and native review is still to follow. The page tells
 * its reader it is an unreviewed A.I. translation.
 * It reuses the app's own translated words where the English is the app's.
 * The English is the reference text; change this whenever it changes.
 *
 * Expects $legal (App\Libraries\Legal::details()), $emailLink and $lang.
 */
?>
    <p><?php if ($legal['name_set']): ?><?= esc($legal['name']) ?> <?php else: ?>BLUERABBIT 的运营方<?php endif ?>负责运营 BLUERABBIT，并对其保存的你的个人数据承担责任。本政策涵盖两个地方：</p>
    <ul>
      <li><strong>BLUERABBIT 应用</strong>，位于 <a href="<?= PLAY_APP_URL ?>">play.bluerabbit.io</a>：冒险、玩家账号和订阅都在这里（第 1 部分）。</li>
      <li><strong>本网站</strong> bluerabbit.io：营销页面、博客、文档、候补名单和联系表单（第 2 部分）。</li>
    </ul>
    <p>二者是相互独立的系统，账号也各自独立：本网站的账号不是应用的账号，两者都不能用来登录对方。根据与我们另行签订的协议、在自己的地址上运行 BLUERABBIT 的机构，适用该协议。</p>

    <h2>第 1 部分：BLUERABBIT 应用</h2>

    <h3>我们保存的内容</h3>
    <ul>
      <li><strong>你的账号：</strong>电子邮箱地址、昵称、你提供的姓名，以及仅以单向哈希形式保存的密码。如果你添加了，还包括可选的个人资料（头像、简介、公司、链接）。</li>
      <li><strong>你在冒险中的活动：</strong>进度、XP、等级、成就和物品，你的答案和上传的文件、消息、留言墙帖子和求助请求，以及构成你历史记录的活动。</li>
      <li><strong>付款：</strong>你的方案、订阅状态和发票。你的银行卡由 Stripe 保存；我们只保存指向你的 Stripe 客户记录的引用。</li>
      <li><strong>安全：</strong>登录日志（每次登录、失败、锁定和密码重置，以及其来源的网络地址和浏览器），以及你的电子邮箱地址验证记录。</li>
      <li><strong>Cookie：</strong>只使用服务所必需的：一个让你保持登录的会话 Cookie，以及一个保护你的表单免遭伪造的 Cookie。用于阻止自动注册的 Cloudflare 及其 Turnstile 验证可能会设置自己的安全 Cookie。我们不使用广告 Cookie。</li>
    </ul>

    <h3>我们为什么保存</h3>
    <ul>
      <li>为了提供你注册的服务：你的账号、你的冒险、你的方案（我们与你之间的合同）。</li>
      <li>为了保障账号和服务的安全：登录日志、锁定、防滥用检查（我们在安全方面的正当利益）。</li>
      <li>为了履行法律义务，例如按照税法要求的期限保存发票。</li>
      <li>为了就你的账号给你发送邮件：验证、密码重置、试用和付款通知。冒险邮件可以通过邮件中的链接关闭。</li>
    </ul>
    <p>我们不出售你的数据，也不将其用于广告。</p>

    <h3>谁能看到</h3>
    <ul>
      <li><strong>在冒险中</strong>，负责运营该冒险的游戏管理员和工作人员可以看到你的进度和你提交的作业。其他玩家可以在排行榜和公会名单上看到你的名字、等级、XP 和成就，但永远看不到你的电子邮箱地址。</li>
      <li><strong>为我们工作的公司</strong>，每家只负责其相应部分：Stripe（付款）、Resend（发送邮件）、Cloudflare（网站分发和抵御攻击）、Anthropic（冒险开启时的 A.I. 功能），以及我们的托管服务商。它们按照我们的指示处理你的数据。</li>
      <li><strong>政府机关</strong>，仅在法律要求时提供。</li>
    </ul>

    <h3>保存多久</h3>
    <ul>
      <li>你的账号和你创建的内容：直到你删除账号。</li>
      <li>登录日志：12 个月，之后自动删除。</li>
      <li>发票和付款记录：按照税务和会计法律要求的期限保存。</li>
      <li>在你删除账号后，为了让其他玩家的成绩保持准确，你的分数可能会以匿名名称保留在冒险的统计数据和排行榜中。其中没有任何能识别你身份的信息。</li>
    </ul>

    <h3>你在应用中的权利</h3>
    <ul>
      <li><strong>查看并带走你的数据：</strong><a href="<?= PLAY_APP_URL ?>/my-account"><em>我的账号 → 你的数据 → 下载</em></a> 会以一个文件的形式提供我们所保存的关于你的全部数据。</li>
      <li><strong>删除你的账号：</strong> <em>我的账号 → 你的数据 → 删除我的账号</em> 会在所有地方移除你的身份信息，删除你的对话和上传的文件，并结束所有会话。请先取消正在进行的订阅。</li>
      <li><strong>更正：</strong>你可以随时编辑个人资料。</li>
      <li><strong>反对、限制处理或提出问题：</strong>请<?php if ($legal['email'] !== ''): ?>发送邮件至 <?= $emailLink ?><?php else: ?>通过<a href="<?= site_url('contact') ?>">我们的联系页面</a>联系我们<?php endif ?>。</li>
    </ul>

    <h2>第 2 部分：本网站</h2>

    <h3>我们收集的内容</h3>
    <p>只收集你正在使用的页面真正需要的信息。完整列表如下：</p>
    <ul>
      <li><strong>候补名单登记</strong>：你的电子邮箱地址，以及你是从哪个页面登记的。除此之外别无其他。</li>
      <li><strong>联系表单</strong>：你的姓名、电子邮箱地址、主题以及你写的留言。</li>
      <li><strong>网站账号</strong>：如果你在本网站注册账号，则包括你的姓名、电子邮箱地址，以及经过安全哈希处理的密码。我们从不保存密码本身，也无法读取它。</li>
      <li><strong>会话 Cookie</strong>：仅一个 Cookie，在你使用本网站期间让你保持登录。</li>
      <li><strong>服务器日志</strong>：标准的网络请求记录（IP 地址、浏览器用户代理、所请求的页面、时间戳），为安全和调试目的而保存。</li>
    </ul>

    <h3>我们不做的事</h3>
    <p>这一点值得明确说明，因为它并不常见，值得你核实：</p>
    <ul>
      <li>没有分析或跟踪脚本。没有 Google Analytics，没有标签管理器，没有会话录制，也没有热图。</li>
      <li>没有广告 Cookie，没有再营销像素，也没有任何形式的第三方跟踪器。</li>
      <li>不出售、出租或交易你的个人信息。不论对象是谁，也不论出价多少。</li>
      <li>不对你进行用户画像，也不对你进行自动化决策。</li>
    </ul>

    <h3>Cookie</h3>
    <ul>
      <li><strong>必要 Cookie（始终开启）。</strong>一个让你保持登录的会话 Cookie、一个防止其他网站以你的名义提交我们表单的安全令牌、一个记录你在下方所作选择的 Cookie，以及一个由 Cloudflare 设置、用于区分真实访客和机器人的 Cookie。这些是网站正常运行所严格必需的，因此无需征得同意，也无法关闭；但它们不包含任何广告数据，也不会被用来对你进行画像。</li>
      <li><strong>分析 Cookie（由你选择）。</strong>关于哪些页面被阅读的匿名统计。<strong>我们目前没有运行任何形式的分析。</strong>如果将来引入，也只会为主动同意的人加载；你的选择会被预先记录并自动得到遵守。</li>
    </ul>
    <p><strong>改变主意。</strong>你可以随时使用任意页面页脚中的 <em>Cookie 设置</em> 链接查看或更改你的选择。撤回同意和当初同意一样容易，并且立即生效。我们也会在十二个月后再次询问，而不是把旧的回答当作永久有效。拒绝分析不会让你失去任何东西：无论你如何选择，本网站的每个部分都完全一样地运行。</p>

    <h3>我们为什么使用这些数据</h3>
    <ul>
      <li><strong>回复你</strong>：联系表单提交的内容，是为了让真人回答你的问题。</li>
      <li><strong>向你介绍 BLUERABBIT</strong>：如果你加入了候补名单，我们会通过邮件告诉你开放时间和发布消息。这就是这份名单存在的全部理由。</li>
      <li><strong>运行你的账号</strong>：验证你的身份并让你保持登录。</li>
      <li><strong>保障网站正常、安全地运行</strong>：日志、防滥用和调试。</li>
    </ul>
    <p>在法律要求具备法律依据的情况下（例如英国或欧盟的 GDPR），我们对候补名单邮件依据的是你的同意；对其他一切，依据的是我们在回复咨询、运营网站以及保障其安全方面的正当利益。</p>

    <h3>还有谁会接触你的数据</h3>
    <ul>
      <li><strong>Resend</strong>：发送我们的事务性邮件和候补名单邮件。会收到你的电子邮箱地址和邮件内容。</li>
      <li><strong>Cloudflare</strong>：位于网站前端，提供安全防护、DDoS 防护和性能优化。会处理包括你的 IP 地址在内的请求元数据。</li>
      <li><strong>我们的托管服务商</strong>：存储网站及其数据库。</li>
      <li><strong>jsDelivr</strong>：提供富文本编辑器库，但只在已登录的管理员页面上使用。普通访客永远不会加载它。</li>
    </ul>

    <h3>保存多久</h3>
    <ul>
      <li><strong>候补名单邮箱地址</strong>：直到你退订或要求我们将你移除。</li>
      <li><strong>联系留言</strong>：直到咨询得到解决，且我们的记录不再需要它。</li>
      <li><strong>网站账号</strong>：只要账号存在就会保存。删除账号，相应记录也随之删除。</li>
      <li><strong>服务器日志</strong>：在一个较短的滚动周期内保存，之后丢弃。</li>
    </ul>

    <h3>你在本网站上的选择</h3>
    <p>要退订候补名单邮件，请使用我们发给你的任意邮件底部的退订链接：它立即生效，无需我们回复。如需查看、更正、删除我们在这里保存的任何其他信息，或获取其副本，请<?php if ($legal['email'] !== ''): ?>发送邮件至 <?= $emailLink ?><?php else: ?>通过<a href="<?= site_url('contact') ?>">我们的联系页面</a>联系我们<?php endif ?>。这一切都不收费，我们也不会要求你说明提出请求的理由。</p>

    <h2>适用于两者</h2>

    <h3>你的权利</h3>
    <p>你可以要求我们向你展示我们所保存的关于你的数据，更正或删除这些数据，或以可携带的格式向你发送一份副本。你也可以反对我们使用这些数据的方式，或撤回你已作出的同意。如果你身在英国或欧盟，并认为我们有不当之处，你有权向你所在国家的数据保护机构投诉。</p>

    <h3>安全</h3>
    <p>两个网站都通过 HTTPS 提供服务。密码以单向哈希的形式保存，绝不以可读形式保存。应用会在多次登录失败后锁定账号，并保留登录日志；两个网站的管理区域都需要身份验证。我们采取合理措施保护你的信息，但没有任何网站能够保证绝对安全。</p>

    <h3>儿童</h3>
    <p>BLUERABBIT 不面向未达到其所在地数字同意年龄的儿童，除非由已获得法律所要求同意的学校、培训师或机构为其报名。本网站面向机构和专业人士；如果你认为有儿童在这里提交了信息，请联系我们，我们会将其删除。</p>

    <h3>国际传输</h3>
    <p>为我们工作的部分公司位于你所在国家之外，其中包括美国。在法律要求的情况下，这些跨境传输受标准合同条款的保护。</p>

    <h3>本政策的变更</h3>
    <p>当本政策发生重要变更时，我们会在此发布带有新日期的新版本，并通知账号持有人。</p>

    <h3>联系方式</h3>
    <p>关于本政策或我们所保存数据的问题：<?php if ($legal['email'] !== ''): ?><?= $emailLink ?><?php else: ?><a href="<?= site_url('contact') ?>">我们的联系页面</a><?php endif ?><?php if ($legal['address'] !== ''): ?>，或邮寄至 <?= esc($legal['address']) ?><?php endif ?>。</p>
