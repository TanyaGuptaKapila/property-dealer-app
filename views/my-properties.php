<?php
$title = 'My Properties';
ob_start();
?>

<section class="max-w-7xl mx-auto p-10">
	<h1 class="text-3xl font-bold mb-6">My Properties</h1>

	<table class="w-full border">
		<thead>
		<tr class="bg-gray-100">
			<th class="border p-2">Title</th>
			<th class="border p-2">Type</th>
			<th class="border p-2">Transaction</th>
			<th class="border p-2">Price</th>
			<th class="border p-2">Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($properties as $property): ?>
			<tr>
				<td class="border p-2"><?= htmlspecialchars($property['title']) ?></td>
				<td class="border p-2"><?= htmlspecialchars($property['property_type']) ?></td>
				<td class="border p-2"><?= htmlspecialchars($property['transaction_type']) ?></td>
				<td class="border p-2">₹ <?= htmlspecialchars($property['expected_price'] ?? '-') ?></td>
				<td class="border p-2">
					<a href="/edit-property?id=<?= $property['id'] ?>" class="text-blue-500 hover:underline">Edit</a> |
					<a href="/delete-property?id=<?= $property['id'] ?>" class="text-red-500 hover:underline" onclick="return confirm('Delete this property?')">Delete</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</section>
