<div class="post">
	    <p><?= getDateFormat($article['creation_date']) ?> par <a href="#"><?= getName($article['name']) ?></a></p>

	    <blockquote>
	      <p><?= getContent($article['content']) ?></p>
	    </blockquote>
</div>