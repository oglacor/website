<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= esc($subject) ?></title>
</head>
<body style="margin:0; padding:0; background:#eef1f4; font-family:Arial,Helvetica,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eef1f4; padding:32px 16px;">
  <tr>
    <td align="center">
      <table role="presentation" width="560" cellpadding="0" cellspacing="0" style="width:560px; max-width:100%; background:#ffffff; border-radius:10px; overflow:hidden; border:1px solid #e2e6ea;">
        <tr>
          <td style="background:#04161e; padding:26px 32px;">
            <img src="<?= esc($logoUrl) ?>" alt="BLUERABBIT" width="170" style="display:block; border:0; max-width:170px; height:auto;">
          </td>
        </tr>
        <tr>
          <td style="padding:36px 32px; color:#22282e; font-size:15px; line-height:1.65;">
            <?= $bodyHtml /* trusted admin-authored or hardcoded transactional content */ ?>
          </td>
        </tr>
        <tr>
          <td style="padding:22px 32px; background:#f6f8fa; border-top:1px solid #e2e6ea; font-size:12px; color:#8a939c; line-height:1.8;">
            <p style="margin:0 0 10px;">
              <a href="<?= esc($siteUrl) ?>" style="color:#1179a8; text-decoration:none;">bluerabbit.io</a>
              &nbsp;&middot;&nbsp;
              <a href="<?= esc($docsUrl) ?>" style="color:#1179a8; text-decoration:none;">Docs</a>
              &nbsp;&middot;&nbsp;
              <a href="<?= esc($contactUrl) ?>" style="color:#1179a8; text-decoration:none;">Contact</a>
            </p>
            <p style="margin:0;">
              You're receiving this because you joined the BLUERABBIT waitlist.
              <?php if (! empty($unsubscribeUrl)): ?>
                <a href="<?= esc($unsubscribeUrl) ?>" style="color:#8a939c; text-decoration:underline;">Unsubscribe</a>
              <?php endif; ?>
            </p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
