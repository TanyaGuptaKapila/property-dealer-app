<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow'>
	<h1 class='text-2xl font-bold mb-4'>Latest Property Ads</h1>

	<?php if (!empty($ads) && is_array($ads)): ?>
		<?php foreach ($ads as $ad): ?>
			<div class='mb-6 border-b pb-4'>
				<h2 class='text-lg font-semibold'><?= htmlspecialchars($ad['title']) ?></h2>
				<p><?= htmlspecialchars($ad['description']) ?></p>
				<p><strong>Type:</strong> <?= htmlspecialchars($ad['type']) ?> |
					<strong>Category:</strong> <?= htmlspecialchars($ad['category']) ?></p>
				<p><strong>Price:</strong> ₹<?= htmlspecialchars($ad['price']) ?> |
					<strong>Location:</strong> <?= htmlspecialchars($ad['location']) ?></p>

				<?php if (!empty($ad['image'])): ?>
					<img src="/uploads/<?= htmlspecialchars($ad['image']) ?>" class="w-64 my-2" />
				<?php endif; ?>

				<?php if ($_SESSION['dealer_id'] != $ad['dealer_id']): ?>
					<form method="post" action="/interest">
						<input type="hidden" name="ad_id" value="<?= $ad['id'] ?>">
						<button class="text-blue-600 hover:underline">I'm Interested</button>
					</form>
				<?php else: ?>
					<em class="text-sm text-gray-500">Your ad</em>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<p class="text-gray-600">No property ads available at the moment.</p>
	<?php endif; ?>
</div>
