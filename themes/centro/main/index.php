<?php if (!defined('FLUX_ROOT')) exit; ?>

<?php
$fb = new Facebook\Facebook([
	'app_id' => '1299280783766708',
	'app_secret' => '49bdfb35f528c3a0a9fdecac38a66b46',
	'default_graph_version' => 'v9.0',
	'default_access_token' => 'EAASdsGGUdLQBAAjBUIbJET91Dvnwi9QLAsCAUhqcduLUG6lBOkExGTZCGJvGwhrZBKPZADPZBN2yUMrjbiMg95plu0hTneZC636A6nVwuRwXVUMM7baESrV76jStO6VJZCxsK2gBxZBiZCEBZB2ZCiN7hsO4sODL3QrZAOWUyxdBqhIJuMzvKqazsEQ',
]);

try {
  $response = $fb->get('/arsenalragnarok/posts?fields=id,created_time,permalink_url,message,picture,attachments,status_type');
  $body = $response->getDecodedBody();
  $data = array_slice(
    array_filter($body['data'], function($post) {
      return (
        $post['status_type'] === 'added_photos' &&
        count($post['attachments']['data'])
      );
    }),
    0, 5
  );

  if (!empty($data)):
    foreach ($data as $post):
      $date = date('M d, Y g:i A', strtotime($post['created_time']) + 8 * 60 * 60);
?>
  <article class="news-article">
    <div class="date">
      <a
        href="<?= $post['permalink_url'] ?>"
        target="_blank"
        rel="noopener noreferrer"
      ><?= $date; ?></a>
    </div>
    <?php
      if (isset($post['attachments']['data'][0]['subattachments']['data'])) {
        $mediaData = $post['attachments']['data'][0]['subattachments']['data'];
      } else {
        $mediaData = $post['attachments']['data'];
      }
      foreach ($mediaData as $data):
    ?>
    <a
      href="<?= $post['permalink_url'] ?>"
      target="_blank"
      rel="noopener noreferrer"
    >
      <img
        src="<?= $data['media']['image']['src'] ?>"
        class="news-article__img"
      />
    </a>
    <?php endforeach ?>
    <?php foreach (preg_split('/\r\n|\r|\n/', $post['message']) as $line): ?>
    <p><?= htmlspecialchars($line); ?></p>
    <?php endforeach; ?>
  </article>
<?php
    endforeach;
  endif;
} catch(Facebook\Exception\FacebookSDKException $e) {
  exit;
}
?>
<a
  href="https://www.facebook.com/arsenalragnarok/"
  target="_blank"
  rel="noopener noreferrer"
  class="seemore"
>
  See more news and announcements in our Facebook page!
</a>
