<h1 class="mt-4">Phân quyền cho vai trò: <?= $role['name'] ?></h1>

<form action="index.php?act=role-save-permissions" method="POST">

<input type="hidden" name="role_id" value="<?= $role['id'] ?>">

<?php
$modules = [];  // modules[moduleName][action] = permission row
while ($p = $permissions->fetch_assoc()) {

    if (!isset($p['name']) || strpos($p['name'], '.') === false) continue;

    list($module, $action) = explode('.', $p['name']);

    if (!isset($modules[$module])) $modules[$module] = [];

    $modules[$module][$action] = $p;
}
?>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>Chức năng (Module)</th>
                <th>Add</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>See</th>
            </tr>
            </thead>

            <tbody>

            <?php foreach ($modules as $module => $actions) { ?>
                <tr>
                    <td class="text-start">
                        <strong><?= ucfirst($module) ?></strong>
                        <br>
                        <small class="text-muted">
                            <?= $actions['view']['description'] ?? $actions['add']['description'] ?? '' ?>
                        </small>
                    </td>

                    <td>
                        <?php if (isset($actions['add'])): ?>
                            <input type="checkbox"
                                name="permissions[<?= $actions['add']['id'] ?>]"
                                <?= isset($current[$actions['add']['id']]) ? 'checked' : '' ?>>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if (isset($actions['edit'])): ?>
                            <input type="checkbox"
                                name="permissions[<?= $actions['edit']['id'] ?>]"
                                <?= isset($current[$actions['edit']['id']]) ? 'checked' : '' ?>>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if (isset($actions['delete'])): ?>
                            <input type="checkbox"
                                name="permissions[<?= $actions['delete']['id'] ?>]"
                                <?= isset($current[$actions['delete']['id']]) ? 'checked' : '' ?>>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if (isset($actions['view'])): ?>
                            <input type="checkbox"
                                name="permissions[<?= $actions['view']['id'] ?>]"
                                <?= isset($current[$actions['view']['id']]) ? 'checked' : '' ?>>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </div>
</div>

<button class="btn btn-success mt-3">Lưu phân quyền</button>
<a href="index.php?act=roles" class="btn btn-secondary mt-3">Quay lại</a>

</form>
