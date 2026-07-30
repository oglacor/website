<?php
// $selector: CSS selector for the textarea to enhance, e.g. '#body'.
$selector = $selector ?? '#body';
?>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '<?= esc($selector, 'js') ?>',
  height: 460,
  skin: 'oxide-dark',
  content_css: 'dark',
  menubar: false,
  branding: false,
  block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Blockquote=blockquote',
  plugins: 'link image media table lists code fullscreen',
  toolbar: 'undo redo | blocks | bold italic | bullist numlist | link image media table | code fullscreen',
  images_upload_handler: function (blobInfo) {
    return new Promise(function (resolve, reject) {
      const formData = new FormData();
      formData.append('file', blobInfo.blob(), blobInfo.filename());
      formData.append('<?= esc(csrf_token(), 'js') ?>', document.querySelector('input[name="<?= esc(csrf_token(), 'js') ?>"]').value);

      fetch('<?= site_url('admin/upload-image') ?>', {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
      })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          if (data.location) {
            resolve(data.location);
          } else {
            reject(data.error || 'Upload failed.');
          }
        })
        .catch(function () { reject('Upload failed.'); });
    });
  },
});
</script>
