<h1>ユーザー一覧</h1>

<table class="table table-bordered">
  <thead class="thead-light">
    <tr><th>id</th><th>ユーザー名</th><th>役割</th><th colspan="2">アクション</th></tr>
  </thead>
  <tbody>
    <?php foreach($users as $user): ?>
        <tr><td><?= $user['User']['id'] ?></td><td><?= $user['User']['username'] ?></td>
        <?php if($user['User']['role'] == 'admin'): ?>
        <th class="text-primary"><?= $user['User']['role']?></td>
        <?php elseif($user['User']['role'] == 'author'):?>
        <th class="text-secondary"><?= $user['User']['role']?></td>
        <?php endif ?>
        <td><a href="/users/edit/<?=$user['User']['id']?>">編集</a></td><td>
        <?= $this->Form->postLink(
        '削除',
        array('controller' => 'users','action' => 'delete', $user['User']['id']),
        array('confirm' => 'ユーザーを削除しますか?')
        )?>
        </td></tr>
    <?php endforeach ?>
  </tbody>
</table>

