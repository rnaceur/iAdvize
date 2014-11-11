<div class="posts index">
	<h2><?php echo __('Enregistrements du site VDM'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tbody>
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['author']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['content']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array(), __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Recuperer les posts'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Supprimer les posts'), array('action' => 'supprimer')); ?></li>
	</ul>
</div>
